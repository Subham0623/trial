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
        'created_at',
        'updated_at',
    ];

    public function options()
    {
        return $this->belongsToMany(Option::class)->withPivot('marks','remarks');
    }
}
