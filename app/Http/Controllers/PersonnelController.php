<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Personnel;
use Illuminate\Http\Request;
use App\Models\PersonnelFonction;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePersonnelRequest;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Personnel::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cni' => 'required|string|max:64',
            'nom' => 'required|string|max:64',
            'prenom' => 'required|string|max:64',
            'dateDeNaissance' => 'required|date',
            'sexe' => 'required|string|max:8',
            'nationalite' => 'required|string|max:64',
            'tel' => 'required|string|max:14',
            'email' => 'required|email|max:64',
            'enfant' => 'required|numeric',
            'conjoint' => 'required|numeric',
            'filiereId' => 'required|numeric',
            'debut' => 'required|date',
            'fin' => 'required|date',
            'statutId' => 'required|numeric',
            'typeContratId' => 'required|numeric',
        ]);

        if($validator->fails()){
            return ["errors"=>$validator->errors()];
        }

        $fields = $request->all();        
        $personnel = [
            "cni" => $fields["cni"],
            "prenom" => $fields["prenom"],
            "nom" => $fields["nom"],
            "naissance" => $fields["dateDeNaissance"],
            "sexe" => $fields["sexe"],
            "nationalite" => $fields["nationalite"],
            "telephone" => $fields["tel"],
            "email" => $fields["email"],
            "enfant" => $fields["enfant"],
            "conjoint" => $fields["conjoint"],
            // "matrimoniale" => $fields["matrimoniale"],
            "filiere_id" => $fields["filiereId"],
        ];
        $personnel = Personnel::create($personnel);

        $personnel->contrats()->create([
            "debut" => $fields["debut"],
            "fin" => $fields["fin"],
            "statut_id" => $fields["statutId"],
            "type_contrat_id" => $fields["typeContratId"],
            "personnel_id" => $personnel->id,
        ]);

        PersonnelFonction::create([
            "debut" => $fields["debut"],
            "fin" => $fields["fin"],
            "personnel_id" => $personnel->id,
            "fonction_id" => $fields["fonctionId"],
        ]);
    
        return response()->json($personnel, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Personnel $personnel)
    {
        return Personnel::find($personnel->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personnel $personnel)
    {
        $personnel = Personnel::find($personnel->id);
        return  $personnel->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personnel $personnel)
    {
        return Personnel::destroy($personnel->id);
    }
}