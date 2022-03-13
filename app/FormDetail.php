<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormDetail extends Model
{
    public $timestamps = false;
    protected $table = 'form_subject_area_option';
    
    protected $fillable = [
        'form_subject_area_id',
        'option_id',
        'remarks',
        'marks'
    ];

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    

    
}
