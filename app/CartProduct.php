<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $primaryKey = ['cart_id', 'product_id'];
    public $incrementing = false;
    public $table = 'cart_product';
    protected $guarded = [];
}
