<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ProductDetail extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'product_details';

    protected $appends = [
        'ck-media',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'overview',
        'features',
        'requirements',
        'instructions',
        'product_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
