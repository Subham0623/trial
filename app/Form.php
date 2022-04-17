<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Authorization\User\User;


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
        return $this->belongsToMany(SubjectArea::class)->withPivot('marks','id','marksByVerifier','marksByAuditor','marksByFinalVerifier');
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
        return $this->hasMany(FormSubjectArea::class);
    }
}
