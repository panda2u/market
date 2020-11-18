<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    public function goods()
    {
        return $this->belongsToMany('App\Good');
    }

    public function materials()
    {
        return $this->belongsToMany('App\Material');
    }
}
