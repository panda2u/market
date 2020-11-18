<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    public function materials()
    {
        return $this->belongsToMany('App\Material');
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Size');
    }
}
