<?php

namespace Modules\Lab\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LabProduct extends Model
{
    protected $fillable = ['name', 'photo', 'description', 'status','type'];
    
    public function categories()
    {
        return $this->belongsToMany('Modules\Lab\Entities\LabCategory', 'lab_category_product');
    }

    public function options()
    {
        return $this->hasMany('Modules\Lab\Entities\LabProductUser','product_id');       
    }

    public function conditions(){
        return $this->belongsToMany('Modules\Lab\Entities\LabCondition', 'lab_condition_lab_products');
    }

    public function specialities(){
        return $this->belongsToMany('Modules\Lab\Entities\LabSpeciality', 'lab_speciality_lab_products');
    }
}
