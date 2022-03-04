<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class FormDetail extends Model
{
    public $table = 'form_subject_area_option';

    protected $dates = [
        'created_at',
        'updated_at',
        
    ];

    protected $fillable = [
        'form_subject_area_id',
        'option_id',
        'remarks',
        'marks',
        'created_at',
        'updated_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function formSubjectAreas()
    {
        return $this->belongsToMany(FormSubjectArea::class)->withPivot('marks','remarks');
    }
}
