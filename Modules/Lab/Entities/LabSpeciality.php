<?php

namespace Modules\Lab\Entities;

use Illuminate\Database\Eloquent\Model;

class LabSpeciality extends Model
{
    protected $fillable = ['speciality_name', 'speciality_slug', 'photo', 'status'];

    protected $table='lab_specialities';

    public function products()
    {
        return $this->belongsToMany('Modules\Lab\Entities\LabProduct','lab_speciality_lab_products');
    }
}
