<?php

namespace App\Models\Authorization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    //
    use SoftDeletes;

    public $table = 'groups';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);

    }
    
    public function getGroupPermissionAttribute()
    {
        $group_permission_id = $this->permissions()->pluck('id');
        // $user_roles = auth()->user()->roles()->with(['permissions' => function($query) use ($group_permission_id) {
        //     $query->whereIn('id', $group_permission_id);
        // }])->get();
        // dd($group_permission_id);
            $user = auth()->user();
            
            if($user->roles->contains(1)){
                return $this->permissions;
            }
            $user_permissions = collect();
            foreach($user->roles as $role) {
                $user_permissions = $user_permissions->merge($role->permissions()->whereIn('id',$group_permission_id)->get());
            }
            // dd($user_permissions);
            // $group_permission = $user_permissions->filter(function($permission) use ($group_permission_id) {
            //     return $permission->contains()
            // });
        // $permissions = auth()->user()->roles->filter(function($role, $key) use($group_permission_id) {
        //         $group_permission_id->filter(function($permission) {
        //             if($role->permission = $permission) 
        //                 dd();
        //         });
        //     dd($role_permission);
        //     return $role_permission->contains(1);
        //  });
        // dd($permissions);
        // $user = User::with('roles.permissions')->find(auth()->user()->id);
        return $user_permissions;
    }
    
}
