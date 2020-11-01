<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['cat_name', 'cat_slug','priority_no','featured','photo'];
    public $timestamps = false;


    public function subs()
    {
    	return $this->hasMany('App\Subcategory');
    }

    public function childs()
    {
        return $this->hasManyThrough('App\Childcategory', 'App\Subcategory');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function getPhotoUrlAttribute()
    {
        return "https://merohealthcare.com/assets/images/"+$this->photo;
    }
}
