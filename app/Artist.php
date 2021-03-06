<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = ['name', 'image'];

    public function albums()
    {
        return $this->hasMany('App\Album');
    }

    public function songs()
    {
        return $this->hasManyThrough('App\Song', 'App\Album');
    }
}
