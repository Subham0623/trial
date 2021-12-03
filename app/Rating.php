<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Rating extends Model
{
    public $table = 'ratings';

    protected $dates = [
        'created_at',
        'updated_at',
        
    ];

    protected $fillable = [
        'rate',
        'user_id',
        'product_id',
        'created_at',
        'updated_at',
        
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}


