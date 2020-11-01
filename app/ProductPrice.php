<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $fillable = ['min_qty', 'type', 'value','product_free_quantity','product_category','product_bonus_price','is_bonus_price'];
    
}
