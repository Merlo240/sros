<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cordones extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'updated_at', 'created_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(status::class, 'status_id');
    }
}
