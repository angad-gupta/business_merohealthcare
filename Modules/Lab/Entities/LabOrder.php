<?php

namespace Modules\Lab\Entities;

use Illuminate\Database\Eloquent\Model;

class LabOrder extends Model
{
    protected $fillable = [];

    public function items()
    {
        return $this->hasMany('Modules\Lab\Entities\LabOrderItem');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function vendor()
    {
        return $this->belongsTo('App\User','vendor_id');
    }
}
