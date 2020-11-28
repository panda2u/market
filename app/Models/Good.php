<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    public function materials()
    {
        return $this->belongsToMany('App\Models\Material', 'good_material');
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Models\Size', 'good_size');
    }
}
