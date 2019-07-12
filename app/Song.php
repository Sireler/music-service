<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public $incrementing = false;

    protected $fillable = ['id', 'title', 'length', 'path', 'cover'];
}
