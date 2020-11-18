<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public function goods()
    {
        return $this->belongsToMany('App\Good');
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Size');
    }
}
