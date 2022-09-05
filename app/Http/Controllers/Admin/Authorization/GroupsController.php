<?php

namespace App\Http\Controllers\Admin\Authorization;

use Illuminate\Http\Request;
use App\Models\Authorization\Group;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Authorization\Permission;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Authorization\Group\StoreGroupRequest;
use App\Http\Requests\Authorization\Group\UpdateGroupRequest;
use App\Http\Requests\Authorization\Group\MassDestroyGroupRequest;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::with('permissions')->get();
        
        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::ofAllowedPermissions()->pluck('display_name', 'id');

        return view('admin.groups.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->all());
        $group->permissions()->sync($request->input('permissions', []));
        return redirect()->route('admin.groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        abort_if(Gate::denies('group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        abort_if(Gate::denies('group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::ofAllowedPermissions()->pluck('display_name', 'id');
        $group->load('permissions');

        return view('admin.groups.edit', compact('group','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->all());
        $group->permissions()->sync($request->input('permissions', []));
        return redirect()->route('admin.groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        abort_if(Gate::denies('group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->delete();

        return back();

    }

    public function massDestroy(MassDestroyGroupRequest $request)
    {
        Group::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
