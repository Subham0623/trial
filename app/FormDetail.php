<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class FormDetail extends Model implements HasMedia
{
    use HasMediaTrait;

    public $timestamps = false;
    protected $table = 'form_subject_area_parameter';
    
    protected $fillable = [
        'form_subject_area_id',
        'parameter_id',
        'remarks',
        'is_applicable',
        'marks',
        'marksByVerifier',
        'marksByAuditor',
        'marksByFinalVerifier',
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
