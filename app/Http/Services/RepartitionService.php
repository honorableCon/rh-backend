<?php

namespace App\Http\Services;

use App\Models\Contrat;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RepartitionService extends Controller
{

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

    public function getRepartitionEffectifByStatutForYear($year){
        $lastYear = $year-1;

        $repartitionForYear = function($year){
            $statuts = DB::table('statuts')
                ->select('label as flabel', 'id as fid');

            $data = DB::table('contrats')
                ->joinSub($statuts, 'statuts', function($join){
                    $join->on('contrats.statut_id', '=', 'statuts.fid');
                })
                ->join('personnels', 'personnels.id', '=', 'contrats.personnel_id')
                ->select('flabel as statut', 'sexe', 
                    'type_contrats.label as type de contrat', DB::raw('COUNT(*) as nombre'))
                ->join('type_contrats', 'contrats.type_contrat_id', '=', 'type_contrats.id')
                ->whereYear('contrats.debut', $year)
                ->groupBy('statut','sexe','type_contrats.label')
                ->get();

            return $data;
        };

        $data = array(
            "$year" => $repartitionForYear($year),
            "$lastYear" => $repartitionForYear($lastYear)
        );
        
        return response()->json($data);
    }

    public function getPermenantRecrutementsForYear($year){
        $statuts = DB::table('statuts')
                ->select('label as flabel', 'id as fid');

        $data = DB::table('personnels')
        ->join('contrats', 'personnels.id', '=', 'contrats.personnel_id')
        ->join('type_contrats', 'type_contrats.id', '=', 'contrats.type_contrat_id')
        ->joinSub($statuts, 'statuts', function($join){
            $join->on('contrats.statut_id', '=', 'statuts.fid');
        })
        ->select('flabel as statut', 'sexe', 'type_contrats.label', DB::raw('COUNT(sexe) as nombre'))
        ->whereYear('contrats.debut', $year)
        ->groupBy('statut','sexe','type_contrats.label')
        ->get();

        return response()->json($data);
    }
    
    public function getDepartByCausesForYear($year){
        $statuts = DB::table('statuts')
                ->select('label as flabel', 'id as fid');

        $data = DB::table('personnels')
            ->join('departs', 'personnels.id', '=', 'departs.personnel_id')
            ->join('causes', 'causes.id', '=', 'departs.cause_id')
            ->join('contrats', 'personnels.id', '=', 'contrats.personnel_id')
            ->joinSub($statuts, 'statuts', function($join){
                $join->on('contrats.statut_id', '=', 'statuts.fid');
            })
            ->select('personnels.sexe', 'departs.date', 'causes.label as cause', 'flabel as statut', DB::raw('COUNT(*) as nombre'))
            // ->whereYear('departs.date', $year)
            ->groupBy('personnels.sexe', 'departs.date', 'cause', 'statut')
            ->get();
        
        return response()->json($data);
    }
}