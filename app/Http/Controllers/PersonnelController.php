<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Personnel;
use App\Models\PersonnelFonction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

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