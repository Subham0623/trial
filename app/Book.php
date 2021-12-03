<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
class Book extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'books';

    protected $appends = [
        'book',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function getPgetTempUrl()
    {

    }
}
