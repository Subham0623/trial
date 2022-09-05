<?php

namespace App\Models\Authorization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use App\Models\Authorization\User\User;

class Permission extends Model
{
    use SoftDeletes;

    public $table = 'permissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'display_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function scopeOfAllowedPermissions()
    {
        $user = User::with('roles.permissions')->find(auth()->user()->id);
        
        if (!$user->isMainAdmin) {
            // $roles = $user->roles;
            $permissions = $user->roles->map(function($role, $key) {
                return $role->permissions;
             });
             
             $datas = [];

            if(isset($permissions) && !empty($permissions)){
                foreach($permissions as $permission){
                    foreach($permission as $p){
                        $datas[] = $p;
                    }
                }
            }
            $datas = collect($datas);
            
            return $datas;
        }
        return $this;
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);

    }

    
}
