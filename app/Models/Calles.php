<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calles extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'updated_at', 'created_at'];


    public function barrios()
    {
        return $this->belongsTo(Barrios::class, 'barrio_id');
    }
    public function bacheos()
    {
        return $this->hasMany(Bacheos::class, 'id');
    }
}
