<?php

namespace App\Http\Services;

use App\Models\Contrat;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EffectifService extends Controller
{
    public function getEffectifTotalForYear($year){
        $contrats = Contrat::whereYear('debut', $year)->get();

        $cdd = $contrats->where('type_contrat_id', 1)->count();
        $cdi = $contrats->where('type_contrat_id', 2)->count();
        $stage = $contrats->where('type_contrat_id', 3)->count();
        $interimaire = $contrats->where('type_contrat_id', 4)->count();
        
        $data = [
            "year" => $year,
            "cdd" => $cdd,
            "cdi" => $cdi,
            "stage" => $stage,
            "interimaire" => $interimaire,
            "permanent" => $cdd + $cdi + $stage,

        ];
        return response()->json($data);
    }

    public function getInterimaireEffectifsForYear($slug, $year){
        $lastYear = $year-1;

        function effectifInterimaireForYear($year, $slug){
            $data = DB::table('contrats')
                ->join('personnels', 'personnels.id', '=', 'contrats.personnel_id')
                ->join('type_contrats', 'type_contrats.id', '=', 'contrats.type_contrat_id')
                ->where('type_contrats.slug', $slug)
                ->select(DB::raw("MONTHNAME(contrats.debut) 'mois', 
                    YEAR(contrats.debut) year, COUNT(*) 'total'"))
                ->whereYear('contrats.debut', $year)
                ->groupBy('mois')
                ->get();

            return $data;
        }
        
        $data = array(
            "$year" => effectifInterimaireForYear($year, $slug)->pluck('total', 'mois'),
            "$lastYear" => effectifInterimaireForYear($lastYear, $slug)->pluck('total', 'mois'),
        );

        return response()->json($data);
    }

    public function getPermanentEffectifsForYear($year){
        $contrats = Contrat::whereYear('debut', $year)->get();

        $cdd = $contrats->where('type_contrat_id', 1)->count();
        $cdi = $contrats->where('type_contrat_id', 2)->count();
        $stage = $contrats->where('type_contrat_id', 3)->count();

        $data = [
            "year" => $year,
            "cdd" => $cdd,
            "cdi" => $cdi,
            "stage" => $stage,
            "total" => $cdd + $cdi + $stage,
        ];

        return response()->json($data);
    }
}