<?php

namespace App\Http\Controllers\Admin\Authorization;

use Gate;
use Illuminate\Http\Request;
use App\Models\Authorization\Role;
use App\Models\Authorization\Group;
use App\Http\Controllers\Controller;
use App\Models\Authorization\Permission;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Authorization\Role\StoreRoleRequest;
use App\Http\Requests\Authorization\Role\UpdateRoleRequest;
use App\Http\Requests\Authorization\Role\MassDestroyRoleRequest;

class RolesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::ofAllowedRoles()->with('permissions')->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $permissions = Permission::ofAllowedPermissions()->pluck('title', 'id');
        $groups = Group::all();
        // dd($groups);
        return view('admin.roles.create', compact('groups'));
    }

    public function store(StoreRoleRequest $request)
    {
        $data = [
            'title' =>$request->title,
            'can_shareable' =>$request->can_shareable,
            'created_by' => auth()->user()->id,
            ];
        $role = Role::create($data);
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');

    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::ofAllowedPermissions()->pluck('title', 'id');

        $role->load('permissions');
        $groups = Group::all();
        return view('admin.roles.edit', compact('permissions', 'role', 'groups'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = [
            'title' =>$request->title,
            'can_shareable' =>$request->can_shareable,
            'updated_by' => auth()->user()->id,
            ];
        $role->update($data);
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');

    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($role->delete()) { // If softdeleted

            $role->update(array('deleted_by' => auth()->user()->id));
        }
        
        return back();

    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
