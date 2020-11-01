<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['top1','top2','top3','top4','bottom1','bottom2','top1l','top2l','top3l','top4l','bottom1l','bottom2l'];
    public $timestamps = false;
}
