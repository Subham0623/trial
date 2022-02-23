<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class FormDetail extends Model
{
    public $table = 'form_option';

    protected $dates = [
        'created_at',
        'updated_at',
        
    ];

    protected $fillable = [
        'form_id',
        'option_id',
        'created_at',
        'updated_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }
}
