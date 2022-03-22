<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormDetail extends Model
{
    public $timestamps = false;
    protected $table = 'form_subject_area_parameter';
    
    protected $fillable = [
        'form_subject_area_id',
        'parameter_id',
        'remarks',
        'marks',
        'option_id'
    ];

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function selected_subjectarea()
    {
        return $this->belongsTo(FormSubjectArea::class, 'form_subject_area_id');
    }
    

    
}
