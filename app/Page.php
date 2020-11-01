<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'text','meta_tag','meta_description'];
    public $timestamps = false;
}
