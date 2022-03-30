<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depart extends Model
{
    use HasFactory;

    public function cause(){
        return $this->belongsTo(Cause::class);
    }
    public function personnel(){
        return $this->belongsTo(Personnel::class);
    }
}
