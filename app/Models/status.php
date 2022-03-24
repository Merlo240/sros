<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;

    public function bacheos()
    {
        return $this->hasMany(Bacheos::class, 'id');
    }

    public function cloacas()
    {
        return $this->hasMany(Cloacas::class, 'id');
    }
    public function cordones()
    {
        return $this->hasMany(Cordones::class, 'id');
    }
}
