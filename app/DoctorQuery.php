<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorQuery extends Model
{
    protected $fillable = ['email', 'phone', 'question'];
}
