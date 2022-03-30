<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Personnel extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function contrats(){
        return $this->hasMany(Contrat::class);
    }
    public function filiere(){
        return $this->belongsTo(Filiere::class);
    }
    public function depart(){
        return $this->belongsTo(Depart::class);
    }
    public function fonctions(){
        return $this->belongsToMany(Fonction::class);
    }

    
}
