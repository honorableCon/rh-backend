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
    
    public function getRepartitionStageBySizeForYear($typecontrat, $year){
        $lastYear = $year-1;

        $repartitionForYear = function ($year, $typecontrat){
            $data = DB::table('contrats')
            ->select('structures.label', DB::raw('COUNT(filieres.label) as nombre'))
            ->join('type_contrats', 'type_contrats.id', '=', 'contrats.type_contrat_id')
            ->join('personnels', 'personnels.id', '=', 'contrats.personnel_id')
            ->join('filieres', 'personnels.filiere_id', '=', 'filieres.id')
            ->rightJoin('structures', 'filieres.structure_id', '=', 'structures.id')
            ->where('type_contrats.slug', $typecontrat)
            ->whereYear('contrats.debut', $year)
            ->groupBy('structures.label')
            ->get();

            return $data;
        };

        $data = array(
            "$year" => $repartitionForYear($year, $typecontrat)->pluck('nombre', 'label'),
            "$lastYear" => $repartitionForYear($lastYear, $typecontrat)->pluck('nombre', 'label'),
        );
        return response()->json($data);
    }
    
    public function getRepartitionStageByDurationForYear($typecontrat, $year){
        $data = DB::table('contrats')
            ->select('structures.label', DB::raw('COUNT(filieres.label) as nombre'))
            ->join('type_contrats', 'type_contrats.id', '=', 'contrats.type_contrat_id')
            ->join('personnels', 'personnels.id', '=', 'contrats.personnel_id')
            ->join('filieres', 'personnels.filiere_id', '=', 'filieres.id')
            ->rightJoin('structures', 'filieres.structure_id', '=', 'structures.id')
            ->where('type_contrats.slug', $typecontrat)
            ->whereYear('contrats.debut', $year)
            ->groupBy('structures.label')
            ->get();

        return response()->json($data);
    }

    public function getRepartitionEffectifByFiliereForYear($year){
        $lastYear = $year-1;

        $repartitionForYear = function($year){
            $filieres = DB::table('filieres')
                ->select('label as flabel', 'id as fid');

            $data = DB::table('personnels')
                ->joinSub($filieres, 'filieres', function($join){
                    $join->on('personnels.filiere_id', '=', 'filieres.fid');
                })
                ->select('flabel as filiere', 'sexe', 
                    'type_contrats.label as type de contrat', DB::raw('COUNT(*) as nombre'))
                ->join('contrats', 'personnels.id', '=', 'contrats.personnel_id')
                ->join('type_contrats', 'contrats.type_contrat_id', '=', 'type_contrats.id')
            ->whereYear('contrats.debut', $year)
            ->groupBy('filiere','sexe','type_contrats.label')
            ->get();

            return $data;
        };

        $data = array(
            "$year" => $repartitionForYear($year),
            "$lastYear" => $repartitionForYear($lastYear)
        );
        
        return response()->json($data);
    }

    public function getRepartitionEffectifByForYearAndType($type, $year){
        $lastYear = $year-1;

        $repartitionForYear = function($year, $type){
            
            // return response()->json($foreignId);

            $tables = DB::table("$type")
                ->select("label as flabel", 'id as fid');

            $data = DB::table('personnels')
                ->join('contrats', 'personnels.id', '=', 'contrats.personnel_id')
                ->joinSub($tables, "$type", function($join){
                    global $type;
                    $foreignId = $type.'_id';

                    $join->on("contrats.$foreignId", '=', "$type.fid");
                })
                ->select("flabel as $type", 'sexe', 
                    'type_contrats.label as type de contrat', DB::raw('COUNT(*) as nombre'))
                ->join('type_contrats', 'contrats.type_contrat_id', '=', 'type_contrats.id')
            ->whereYear('contrats.debut', $year)
            ->groupBy("$type",'sexe','type_contrats.label')
            ->get();

            return $data;
        };

        $data = array(
            "$year" => $repartitionForYear($year, $type),
            "$lastYear" => $repartitionForYear($lastYear, $type)
        );
        
        return response()->json($data);
    }
}