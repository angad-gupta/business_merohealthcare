<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    protected $fillable = ['title', 'text','discount_type','discount_value','min_purchase_amount'];
    
    public $timestamps = false;
}
