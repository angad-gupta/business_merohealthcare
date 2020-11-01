<?php

namespace Modules\Lab\Entities;

use Illuminate\Database\Eloquent\Model;

class LabProductUser extends Model
{
    protected $table = 'lab_product_user';

    protected $fillable = ['user_id','product_id','cprice','pprice','timing','report_delivery_time','status','specimen','method'];

    public function type()
    {
        return $this->belongsTo('Modules\Lab\Entities\LabProduct', 'product_id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
