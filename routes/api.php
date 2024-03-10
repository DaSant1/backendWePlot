<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('user')->group(function(){
    Route::post('registrer',[App\Http\Controllers\UserController::class,'registrer']);
    Route::post('autenticar',[App\Http\Controllers\UserController::class,'authenticate']);
    Route::post('getAuthenticatedUser',[App\Http\Controllers\UserController::class,'getAthenticateUser']);
});


///Route::middleware('jwt.auth')->get('getAllUsers',[App\Http\Controllers\UserController::class,'getUsers']);
Route::get('getAllUsers',[App\Http\Controllers\UserController::class,'getUsers']);
//endPoint para admins
Route::prefix('admin')->group(function(){
    Route::post('registrer',[App\Http\Controllers\AdminController::class,'registrerNewAdmin']);
    Route::post('getAdminByIdUser',[App\Http\Controllers\AdminController::class,'getAdminByIdUser']);
    Route::post('getIdAdminByIdUser',[App\Http\Controllers\AdminController::class,'getIdAdminByIdUser']);
    Route::get('getAdmins',[App\Http\Controllers\AdminController::class,'getAdmins']);
});


//endPoint que obtene información relacionada a la tabla Estados
Route::prefix('estado')->group(function(){
    Route::post('create',[App\Http\Controllers\EstadoController::class,'createNewEstado']);
    Route::get('get',[App\Http\Controllers\EstadoController::class,'getEstados']);
});

Route::prefix('pregunta')->group(function(){
    Route::get('getPreguntasDisponibles',[App\Http\Controllers\PreguntasController::class,'getPreguntasDisponibles']);
    Route::post('create',[App\Http\Controllers\PreguntasController::class,'createNewPregunta']);
    Route::get('get',[App\Http\Controllers\PreguntasController::class,'getHistorialPreguntas']);
    Route::post('getHistorialRespuestasByDate',[App\Http\Controllers\RespuestasClientesController::class,'getRespuestasClientesByTimestamp']);
    Route::post('createNewRespuestaByUser',[App\Http\Controllers\RespuestasClientesController::class,'createNewRespuesta']);
    Route::post('getRespuestasByIdUser',[App\Http\Controllers\RespuestasClientesController::class,'getRespuestasByIdUser']);
    Route::post('ActivarPreguntaById',[App\Http\Controllers\PreguntasController::class,'ActivarPregunta']);
    Route::post('DesactivarPreguntaById',[App\Http\Controllers\PreguntasController::class,'DesactivarPregunta']);
});

Route::prefix('imageClient')->group(function(){
    Route::post('store',[App\Http\Controllers\CreateimageController::class,'store']); 
    Route::post('getImageByPath',[App\Http\Controllers\CreateimageController::class,'getImageByPath']); 
});