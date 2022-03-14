<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Cviebrock\EloquentSluggable\Sluggable;

class Option extends Model
{
    use SoftDeletes;

    public $table = 'options';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'sort',
        'parameter_id',
        'points',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function parameter()
    {
        return $this->belongsTo(Parameter::class);
    }

    public function forms()
    {
        return $this->belongsToMany(Form::class);
    }

    
}
