<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model{
    protected $fillable = ["label"];

    use HasFactory;

    public function depart(){
        return $this->belongsTo(Depart::class);
    }
}
