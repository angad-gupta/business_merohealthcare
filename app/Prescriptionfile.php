<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescriptionfile extends Model
{
    public function prescriptions()
    {
        return $this->belongsToMany('App\Prescription','prescriptionfile_prescription','prescriptionfile_id','prescription_id');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order','prescriptionfile_orders','prescriptionfile_id','order_id');
    }

    public function folder()
    {
        return $this->belongsTo('App\Folder');
    }
    
 
}
