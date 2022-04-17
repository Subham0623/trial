<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;


class SubjectArea extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'subject_areas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'sort',
        'slug',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function parameters()
    {
        return $this->hasMany(Parameter::class);
    }

    public function forms()
    {
        return $this->belongsToMany(Form::class)->withPivot('marks','id','marksByVerifier','marksByAuditor','marksByFinalVerifier');
    }
}
