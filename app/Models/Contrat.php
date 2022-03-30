<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function statuts(){
        return $this->hasMany(Statut::class);
    }
    public function type_contrat(){
        return $this->belongsTo(TypeContrat::class);
    }
    public function personnel(){
        return $this->belongsTo(Personnel::class);
    }
}
