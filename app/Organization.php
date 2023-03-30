<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Authorization\User\User;


class Organization extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'organizations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'province_id',
        'district_id',
        'type_id',
        'organization_id',
        'governance_id',
        'audit_type',
        'contact',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeOfUsers($query)
    {
        $user = User::find(auth()->user()->id);

        if (!$user->isMainAdmin) {
            $user_org = $user->organizations;
            $allowed_org = collect();

            foreach($user_org as $org) {
                $allowed_org = $allowed_org->merge($org->id);
                if ($org->childOrganizations->count()) {
                    $allowed_org = $allowed_org->merge($org->childOrganizations->pluck('id'));
                }
            }

            return $query->whereIn('id',$allowed_org);
        }

        return $query;
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function parentOrganization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function childOrganizations()
    {
        return $this->hasMany(Organization::class, 'organization_id');
    }

    public function governance()
    {
        return $this->belongsTo(Governance::class);
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }

    public function scopeOfUser($query)
    {
        $user = User::find(auth()->user()->id);

        if (!$user->isMainAdmin) {
            $user_org = $user->organizations;
            $allowed_org = collect();

            foreach($user_org as $org) {
                $allowed_org = $allowed_org->merge($org->id);
                if ($org->childOrganizations->count()) {
                    $allowed_org = $allowed_org->merge($org->childOrganizations->pluck('id'));
                }
                if ($org->parentOrganization && $org->parentOrganization->count()) {
                    $parent = $org->parentOrganization->load('parentOrganization');
                    $allowed_org = $allowed_org->merge($parent->id);
                    if($parent->parentOrganization)
                    {

                        $allowed_org = $allowed_org->merge($parent->parentOrganization->id);
                    }
                }
            }
            // dd($allowed_org);
            return $query->whereIn('id',$allowed_org);
        }

        return $query;
    }
}
