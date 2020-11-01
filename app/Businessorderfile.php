<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Businessorderfile extends Model
{

    public function businessorders()
    {
        return $this->belongsToMany('App\BusinessOrder','businessorderfile_businessorders','businessorderfile_id','businessorder_id');
    }

   
}
