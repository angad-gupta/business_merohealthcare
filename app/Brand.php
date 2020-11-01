<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['photo','url'];
    public $timestamps = false;

    public function getPhotoUrlAttribute()
    {
        return "https://merohealthcare.com/assets/images/"+$this->photo;
    }
}

