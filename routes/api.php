<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Services\EffectifService;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/allcontrats', [PersonnelController::class, 'personnels']);
Route::get('/permanents/{year}', [ContratController::class, 'getPermanentEffectifsForYear']);
Route::get('/effectifs/{slug}/{year}', 
    [EffectifService::class, 'getInterimaireEffectifsForYear']
);
// Route::get('/interimaires/{year}/{month}', 
//     [EffectifService::class, 'getInterimaireEffectifsForYearAndMonth']
// );

Route::get('/effectifs/{year}', [EffectifService::class, 'getEffectifTotalForYear']);
Route::get('/repartitions/{typecontrat}/{year}', [EffectifService::class, 'getRepartitionStageBySizeForYear']);
Route::get('/repartitions/effectifs/{type}/{year}', [EffectifService::class, 'getRepartitionEffectifByForYearAndType']);

Route::resource('contrats', ContratController::class);
Route::resource('personnels', PersonnelController::class);
Route::resource('users', UserController::class);











































// Route::get('/allcontrats', [AllContrantController::class, 'index']);
// Route::resource('causes', CauseController::class);
// Route::resource('departs', DepartController::class);
// Route::resource('filieres', FiliereController::class);
// Route::resource('fonctions', FonctionController::class);
// Route::resource('statuts', StatutController::class);
// Route::resource('structures', StructureController::class);
// Route::resource('typeContrats', TypeContratController::class);