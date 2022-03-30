<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Fonction;
use App\Models\TypeContrat;
use App\Models\Statut;
use Illuminate\Http\Request;

class AllContrantController extends Controller
{
   
    function index(){
        $data = [
           "filiere" => Filiere::all(),
           "fonction" => Fonction::all(),
           "typeContrat" => TypeContrat::all(),
           "statut" => Statut::all(),
        ];
        
        return $data;
    }
    function store(Request $request){
        $data = $request->all();
        return $data;
    }
}

