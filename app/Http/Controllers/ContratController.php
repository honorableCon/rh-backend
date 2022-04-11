<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Contrat;
use App\Models\TypeContrat;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    public function getInterimaireEffectifsForYear($slug, $year){
        $typecontrat = TypeContrat::where('slug', $slug)->first();

        $contrats = Contrat::where('type_contrat_id', $typecontrat->id)
            ->whereYear('debut', $year)
            ->get()
            ->groupBy(function($contrat) { 
                return Carbon::parse($contrat->debut)->format('M');
            });
        
        foreach ($contrats as $key => $contrat) {
            $contrats[$key] = $contrat->count();
        }

        return response()->json($contrats);
    }

    public function getInterimaireEffectifsForYearAndMonth($year, $monthNumber){
        $monthName = DateTime::createFromFormat('!m', $monthNumber)->format('F');
        $contrats = Contrat::whereYear('debut', $year)
            ->where('type_contrat_id', 4)
            ->whereMonth('debut', $monthNumber);
        $data = [
            $monthName => $contrats->whereMonth('debut', $monthNumber)->get()->count(),
        ];

        return response()->json($data);
    }

    public function getPermanentEffectifsForYear($year){
        $contrats = Contrat::whereYear('debut', $year)->get();

        $cdd = $contrats->where('type_contrat_id', 1)->count();
        $cdi = $contrats->where('type_contrat_id', 2)->count();
        $stage = $contrats->where('type_contrat_id', 3)->count();

        $data = [
            "year" => $year,
            "CDD" => $cdd,
            "CDI" => $cdi,
            "Stage" => $stage,
            "Total" => $cdd + $cdi + $stage,
        ];

        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contrat::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contrat = Contrat::find($request->id);
        return  $contrat->update($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return Contrat::find($request->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Contrat::create($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($contrat)
    {
        return Contrat::destroy($contrat);
    }
}