<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $fillable = ["label"];
    use HasFactory;

    public function filiere(){
        $this->belongsTo(Filiere::class);
    }
}
