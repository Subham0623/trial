<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authorization\User\MassDestroyUserRequest;
use App\Http\Requests\Authorization\User\StoreUserRequest;
use App\Http\Requests\Authorization\User\UpdateUserRequest;
use App\Models\Authorization\Role;
use App\Models\Authorization\User\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Mail\CanReadBook;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Organization;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::ofUser()->with('user_detail')->latest()->paginate(100);
        
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::ofAllowedRoles()->pluck('title', 'id');
        $organizations = Organization::pluck('name','id');

        return view('admin.users.create', compact('roles','organizations'));
    }

    public function store(StoreUserRequest $request)
    {
        
        $data = [
            'name' =>$request->name,
            'email' => $request->email,
            'email_verified_at' => Carbon::now(),
            'password' => $request->password,
            'created_by' => auth()->user()->id,
            ];
           
            
        $user = User::create($data);
        $user->roles()->sync($request->input('roles', []));
        $user->organizations()->sync($request->input('organizations', []));
        return redirect()->route('admin.users.index');

    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::ofAllowedRoles()->pluck('title', 'id');

        $organizations = Organization::pluck('name','id');

        $user->load('roles','organizations');

        return view('admin.users.edit', compact('roles', 'user','organizations'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        
        $data = [
            'title' =>$request->title,
            'updated_by' => auth()->user()->id,
            ];
            
        $user->update($data);
        $user->roles()->sync($request->input('roles', []));
        $user->organizations()->sync($request->input('organizations', []));

        return redirect()->route('admin.users.index');

    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles','organizations');
        // dd($user->user_detail);
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($user->delete()) { // If softdeleted
            
            $user->update(array('deleted_by' => auth()->user()->id));
        }

        return back();

    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function manageAccessToBook(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $levels = Level::all()->pluck('title','id');
        
        $user->load('roles','user_detail','levels','tags');
        // dd($user->tags);
        return view('admin.users.read-book', compact('user','levels'));
    }

    public function canReadBook(User $user, Level $level, ProductTag $tag, $flag)
    {
        $user->levels()->wherePivot('product_tag_id', $tag->id)
            ->updateExistingPivot(
                $level->id,
                ['status' => $flag]
        );

        if($flag==1) {
            Mail::to($user)->send(new CanReadBook($user,$flag));
        } else {
            Mail::to($user)->send(new CanReadBook($user,$flag));
        }
        return back();
    }

    public function addMoreSubject(Request $request, User $user)
    {
        $levels = collect($request['teaching_level']);
        $levels->map(function($level,$i) use ($user, $request) {
            $subjects = collect($request['subject-'.$i]);
            $subjects->map(function($subject) use ($user, $level) {
                $user->levels()->wherePivot('product_tag_id', $subject)->detach($level);
                $user->levels()->attach([ $level => ['product_tag_id' => $subject, 'status' => 1] ]);
            });
        });

        return back();
    }
}
