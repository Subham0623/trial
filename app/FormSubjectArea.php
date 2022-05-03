<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormSubjectArea extends Model
{
    protected $table = 'form_subject_area'; 

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'form_id',
        'subject_area_id',
        'marks',
        'marksByVerifier',
        'marksByAuditor',
        'marksByFinalVerifier',
        'status_verifier',
        'status_auditor',
        'status_final_verifier',
        'created_at',
        'updated_at',
    ];

    public function parameters()
    {
        return $this->belongsToMany(Parameter::class)->withPivot('marks','remarks','option_id','marksByVerifier','marksByAuditor','marksByFinalVerifier','is_applicable');
    }

    public function selected_subjectareas()
    {
        return $this->hasMany(FormDetail::class, 'form_subject_area_id');
    }
}
