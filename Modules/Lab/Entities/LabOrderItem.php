<?php

namespace Modules\Lab\Entities;

use Illuminate\Database\Eloquent\Model;

class LabOrderItem extends Model
{
    protected $fillable = [];

    public function test()
    {
        return $this->belongsTo('Modules\Lab\Entities\LabProductUser', 'test_id');
    }

    public function order()
    {
        return $this->belongsTo('Modules\Lab\Entities\LabOrder','lab_order_id');
    }
}
