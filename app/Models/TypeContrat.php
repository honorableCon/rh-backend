<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeContrat extends Model
{
    protected $fillable = ['label'];
    use HasFactory;

    public function contrats(){
        return $this->hasMany(Contrat::class);
    }
}
