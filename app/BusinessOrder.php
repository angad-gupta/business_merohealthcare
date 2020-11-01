<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessOrder extends Model
{
  
   // protected $fillable = ['name','address','reg_no','pan_vat','email','status','reg_certificate_file','created_at','updated_at','phone','product_id','quantity'];

   public function files()
    {
        return $this->belongsToMany('App\Businessorderfile','businessorderfile_businessorders','businessorder_id','businessorderfile_id');
    }

}
