<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormSubjectArea extends Model
{
    public $table = 'form_subject_area'; 

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'form_id',
        'subject_area_id',
        'marks',
        'created_at',
        'updated_at',
    ];

    public function formDetails()
    {
        return $this->belongsToMany(FormDetail::class)->withPivot('marks','remarks');
    }
}
