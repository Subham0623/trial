<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Sluggable, SearchableTrait;

    public $table = 'products';

    protected $appends = [
        'photo',
        'resource',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'framework',
        'published_date',
        'slug',
        'compatible_browsers',
        'software_version',
        'price',
        'featured',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.name' => 10,
            'products.description' => 5,
            'authors.name' => 8,
        ],
        'joins' => [
            'author_product' => ['products.id', 'author_product.product_id'],
            'authors' => ['author_product.author_id', 'authors.id']
        ],
        'groupBy' => 'products.id'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    // public function book()
    // {
    //     return $this->belongsTo(Book::class);
    // }

    public function manual()
    {
        return $this->belongsTo(Manual::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function wishlists()
    {
        return $this->belongsToMany(wishlist::class);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function getResourceAttribute()
    {
        $files = $this->getMedia('resource');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
        });

        return $files;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function productdetail()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function licenses()
    {
        return $this->belongsToMany(License::class)->withPivot('price');
    }

    public function supports()
    {
        return $this->belongsToMany(Support::class);
    }
}
