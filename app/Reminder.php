<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['duration','start_date','status'];

    public function notifiable()
    {
        return $this->morphTo();
    }
}
