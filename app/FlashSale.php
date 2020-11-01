<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    protected $fillable = ['title','photo','discount_type','discount_value','max_discount','starts_at','ends_at'];
    
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
