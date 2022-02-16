<?php

namespace App\Models\Authorization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use App\Models\Authorization\User\User;

class Role extends Model
{
    use SoftDeletes;

    public $table = 'roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'can_shareable',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);

    }

    public function products()
    {
        return $this->belongsToMany(Product::class);

    }

    public function scopeOfAllowedRoles($query)
    {
        $user = User::find(auth()->user()->id);
        
        if (!$user->isMainAdmin) {
            return $query->where('created_by', $user->id)->orWhere('can_shareable',1);
        }
        return $query;
    }
}
