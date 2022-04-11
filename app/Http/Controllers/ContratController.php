<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrat;
use DateTime;

class ContratController extends Controller
{
    public function getInterimaireEffectifsForYear($year){
        $contrats = Contrat::whereYear('debut', $year)->where('type_contrat_id', 4);
        $data = [
            "janvier" => $contrats->whereMonth('debut', '01')->get()->count(),
            "fevrier" => $contrats->whereMonth('debut', '02')->get()->count(),
            "mars" => $contrats->whereMonth('debut', '03')->get()->count(),
            "avril" => $contrats->whereMonth('debut', '04')->get()->count(),
            "mai" => $contrats->whereMonth('debut', '05')->get()->count(),
            "juin" => $contrats->whereMonth('debut', '06')->get()->count(),
            "juillet" => $contrats->whereMonth('debut', '07')->get()->count(),
            "aout" => $contrats->whereMonth('debut', '08')->get()->count(),
            "septembre" => $contrats->whereMonth('debut', '09')->get()->count(),
            "octobre" => $contrats->whereMonth('debut', '10')->get()->count(),
            "novembre" => $contrats->whereMonth('debut', '11')->get()->count(),
            "decembre" => $contrats->whereMonth('debut', '12')->get()->count(),
            "Total" => $contrats->get()->count(),
        ];

        return response()->json($data);
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