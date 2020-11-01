<?php

namespace Modules\Lab\Entities;

use Illuminate\Database\Eloquent\Model;

class LabCategory extends Model
{
    protected $fillable = ['cat_name', 'cat_slug', 'photo', 'status'];    

    public function products()
    {
        return $this->belongsToMany('Modules\Lab\Entities\LabProduct','lab_category_product');
    }
}
