<?php

namespace App;

use App\Organization;
use \DateTimeInterface;
use App\Models\Authorization\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Form extends Model
{
    use SoftDeletes;

    public $table = 'forms';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'verified_at',
        'audited_at',
        'final_verified_at',
    ];

    protected $fillable = [
        'user_id',
        'organization_id',
        'year',
        'total_marks',
        'total_marks_verifier',
        'total_marks_auditor',
        'total_marks_finalVerifier',
        'grade',
        'remarks',
        'created_at',
        'updated_at',
        'verified_at',
        'audited_at',
        'final_verified_at',
        'updated_by',
        'audited_by',
        'verified_by',
        'final_verified_by',
        'status',
        'is_verified',
        'is_audited',
        'final_verified',
        'deleted_at',
    ];

    protected $casts = ['total_marks_finalVerifier' => 'float'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class,'verified_by');
    }

    public function auditedBy()
    {
        return $this->belongsTo(User::class,'audited_by');
    }

    public function finalVerifiedBy()
    {
        return $this->belongsTo(User::class,'final_verified_by');
    }

    // public function options()
    // {
    //     return $this->belongsToMany(Option::class);
    // }

    public function subjectAreas()
    {
        return $this->belongsToMany(SubjectArea::class)->where('status',1)->withPivot('marks','id','marksByVerifier','marksByAuditor','marksByFinalVerifier','status_verifier','status_auditor','status_final_verifier');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function scopeFinalVerified($query)
    {
        return $query->where('final_verified',1);
    }


    // form's relation with pivot model form-subject-area
    public function form_subjectareas()
    {
        $active_SA = $this->subjectAreas()->pluck('subject_area_id');
        return $this->hasMany(FormSubjectArea::class)->whereIn('subject_area_id',$active_SA);
    }

    public function scopePublish($query)
    {
        return $query->where('publish',1);
    }

    public function scopeOfUser($query)
    {
        $auth_user = auth()->user();
        $auth_user_roles = $auth_user->roles()->pluck('id');
        $auth_user_organizations = $auth_user->organizations()->pluck('id');

        $organizations = Organization::whereIn('id',$auth_user_organizations)->with('childOrganizations.childOrganizations.childOrganizations')->get();

        $ids = collect();
        foreach ($organizations as $organization) {
            $ids = $ids->merge($organization->id);
            if ($organization->childOrganizations->count()) {
                foreach ($organization->childOrganizations as $subCategory) {
                    $ids = $ids->merge($subCategory->id);
                    if ($subCategory->childOrganizations->count()) {
                        foreach ($subCategory->childOrganizations as $cat) {
                            $ids = $ids->merge($cat->id);
                            if ($cat->childOrganizations->count()) {
                                $ids = $ids->merge($cat->childOrganizations->pluck('id'));
                            }
                        }
                    }
                }

            }
        }

        $auth_user_organizations_with_child_organizations = $ids;

        if($auth_user_roles->contains('1') || $auth_user_roles->contains('2'))  //System-Admin OR IT-Admin
        {
            return $query;
        }
        elseif($auth_user_roles->contains('4') || $auth_user_roles->contains('6'))  //Auditor OR Final Verifier
        {
            return $query->whereIn('organization_id',$auth_user_organizations);
        }
        else
        {
            return $query->whereIn('organization_id',$auth_user_organizations_with_child_organizations);
        }
    }
}
