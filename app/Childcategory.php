<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Childcategory extends Model
{
    protected $fillable = ['subcategory_id','child_name','child_slug','priority_no','featured'];
    public $timestamps = false;

    public function subcategory()
    {
    	return $this->belongsTo('App\Subcategory');
    }
    public function products()
    {
        return $this->belongsToMany('App\Product','category_product');       
    }
}
