<?php

namespace Modules\Lab\Entities;

use Illuminate\Database\Eloquent\Model;

class LabCondition extends Model
{
    protected $fillable = ['condition_name', 'condition_slug', 'photo', 'status'];
    protected $table='lab_conditions';

    public function products()
    {
        return $this->belongsToMany('Modules\Lab\Entities\LabProduct','lab_condition_lab_products');
    }
}
