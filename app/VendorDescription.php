<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorDescription extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
