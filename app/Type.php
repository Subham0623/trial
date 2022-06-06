<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Type extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'type_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function parentType()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function childTypes()
    {
        return $this->hasMany(Type::class, 'type_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }
}
