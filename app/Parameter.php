<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Parameter extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'parameters';

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
        'description',
        'subject_area_id',
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

    public function subjectArea()
    {
        return $this->belongsTo(SubjectArea::class);
    }


    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function activeOptions()
    {
        return $this->options()->where('status',1);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function activeDocuments()
    {
        return $this->documents()->where('status',1);
    }

    public function formSubjectAreas()
    {
        return $this->belongsToMany(FormSubjectArea::class)->withPivot('marks','remarks','option_id','marksByVerifier','marksByAuditor','marksByfinalVerifier','is_applicable');
    }
}
