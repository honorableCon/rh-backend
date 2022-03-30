<?php

use App\Models\AllContrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CauseController;
use App\Http\Controllers\DepartController;
use App\Http\Controllers\StatutController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\AllContrantController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/allcontrats', [AllContrantController::class, 'index']);
Route::resource('causes', CauseController::class);
Route::resource('contrats', ContratController::class);
Route::resource('departs', DepartController::class);
Route::resource('filieres', FiliereController::class);
Route::resource('fonctions', FonctionController::class);
Route::resource('personnels', PersonnelController::class);
Route::resource('statuts', StatutController::class);
Route::resource('structures', StructureController::class);
Route::resource('typeContrats', TypeContratController::class);
Route::resource('users', UserController::class);
