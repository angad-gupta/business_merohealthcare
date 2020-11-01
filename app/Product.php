<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    protected $fillable = ['name', 'company_name', 'adv_price', 'highlights','generic_name', 'sub_title', 'photo', 'size', 'color', 'description','cprice','pprice','stock','policy','featured','status', 'views','tags','best','top','hot','latest','big','features','colors','user_id','product_condition','ship','meta_tag','meta_description','youtube','type','file','license','license_qty','link','platform','region','licence_type','measure',
    'sale_percentage','sale_from','sale_to','sale_stock','purchase_limit','product_quantity','vat_status','approval','priority_order','medicine_type','adv_bonus_price'];

    protected $appends = ['sale_value'];
    
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_product');
    }

    public function subcategories()
    {
        return $this->belongsToMany('App\Subcategory', 'category_product', 'product_id', 'subcategory_id');
    }

    public function childcategories()
    {
        return $this->belongsToMany('App\Childcategory', 'category_product', 'product_id', 'childcategory_id');
    }

    public function prices()
    {
        return $this->hasMany('App\ProductPrice');
    }

    public function pricesbonus()
    {
        return $this->hasMany('App\ProductPrice');
    }
    
    public function combo_prices()
    {
        return $this->hasMany('App\ProductPrice')->orderBy('min_qty','desc');
    }

    // public function attributes()
    // {
    //     return $this->hasMany('App\ProductAttribute');
    // }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function galleries()
    {
        return $this->hasMany('App\Gallery');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function wishlists()
    {
        return $this->hasMany('App\Wishlist');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function clicks()
    {
        return $this->hasMany('App\ProductClick');
    }

    public function flash_sales()
    {
        return $this->belongsToMany('App\FlashSale');
    }

    public function getDiscountPercentAttribute()
    {
        if($this->pprice && $this->pprice != 0 && $this->pprice > $this->cprice)
            return round((($this->pprice - $this->cprice)/$this->pprice)*100);
        else 
            return 0;
    }

    public function getStockAttribute($value)
    {
        $now = Carbon::now()->format('Y/m/d h:i A');

        if($this->sale_from && ($this->sale_from <= $now && $this->sale_to >= $now) && ($this->sale_stock !== null && $this->sale_stock >= 0)){
            return $this->sale_stock;
        }

        return $value;
    }


    public function getPrice($qty = 1)
    {
        $discount = 1;
        $now = Carbon::now()->format('Y/m/d h:i A');

        if($this->sale_from && ($this->sale_from <= $now && $this->sale_to >= $now)){
            $discount = 1 - ($this->sale_percentage/100);
        }

        if($qty == 1 || !$this->adv_price) return round($discount * $this->cprice,2);
        if($qty == 2 || !$this->adv_price) return round($discount * $this->cprice,2);
        if($qty == 3 || !$this->adv_price) return round($discount * $this->cprice,2);
        if($qty == 4 || !$this->adv_price) return round($discount * $this->cprice,2);



        $price = $this->prices()->where('min_qty','<=',$qty)->orderBy('min_qty','desc')->first();

        if($price->type == 0) return round($discount * $this->cprice * (1 - ($price->value / 100)),2);

        return round($discount * $price->value,2);
    }

    public function getPriceBonus($qty = 1)
    {
        $discount = 1;
        $now = Carbon::now()->format('Y/m/d h:i A');

        if($this->sale_from && ($this->sale_from <= $now && $this->sale_to >= $now)){
            $discount = 1 - ($this->sale_percentage/100);
        }
        
        // if($qty == 1 || !$this->adv_price) return round($discount * $this->cprice,2);

        $price = $this->prices()->where('min_qty','<=',$qty)->orderBy('min_qty','desc')->first();

        // if($price->type == 0) return round($discount * $this->cprice * (1 - ($price->value / 100)),2);

        return round($discount * ($price->product_bonus_price / $price->min_qty),2);
    }
    
    public function getSaleValueAttribute(){
        $discount = 1;
        $now = Carbon::now()->format('Y/m/d h:i A');

        if($this->sale_from && ($this->sale_from <= $now && $this->sale_to > $now)){
            $discount = 1 - ($this->sale_percentage/100);
        }
        
        return $discount;
    }

    public function getTotalPrice($qty = 1)
    {
        if($qty == 1 || !$this->adv_price) return $qty * round($this->cprice,2);

        $price = $this->prices()->where('min_qty','<=',$qty)->orderBy('min_qty','desc')->first();

        if($price->type == 0) return $qty * round($this->cprice * (1 - ($price->value / 100)),2);

        return $qty * round($price->value,2);
    }

    public function getTotalPriceBonus($qty = 1)
    {
        if($qty == 1 || !$this->adv_price) return $qty * round($this->cprice,2);

        $price = $this->prices()->where('min_qty','<=',$qty)->orderBy('min_qty','desc')->first();

        // if($price->type == 0) return $qty * round($this->cprice * (1 - ($price->value / 100)),2);

      
        return round($price->product_bonus_price,2);
    }

    public function getRequiresPrescriptionAttribute()
    {
        return $this->categories()->where('cat_name','Medicines')->exists();
    }

    public function getPhotoUrlAttribute()
    {
        return "https://merohealthcare.com/assets/images/"+$this->photo;
    }

    public function getVariantKeyAttirbute()
    {
        return $this->subtitle; 
    }
}
