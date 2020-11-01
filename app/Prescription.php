<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function family(){
        return $this->belongsTo('App\Family');
    }

    public function invoice()
    {
        return $this->hasOne('App\PrescriptionInvoice');
    }

    public function reminder()
    {
        return $this->morphOne('App\Reminder', 'notifiable');
    }

    public function files()
    {
        return $this->belongsToMany('App\Prescriptionfile','prescriptionfile_prescriptions','prescription_id','prescriptionfile_id');
    }


    
}
