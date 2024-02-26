<?php

use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\RespuestaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/encuestas',[EncuestaController::class, 'home']);
Route::get('/encuesta/{id}',[EncuestaController::class, 'show']);
Route::post('/encuesta',[EncuestaController::class, 'store']);
Route::put('/encuesta/update/{id}',[EncuestaController::class, 'update']);
Route::delete('/encuesta/delete/{id}',[EncuestaController::class, 'destroy']);

// Route::post('/usuario',[UsuarioController::class, 'store']);

// Route::post('/encuesta/{encuestaID}/preguntas',[PreguntaController::class, 'store']);
Route::post('/preguntas',[PreguntaController::class, 'store']);
Route::delete('/pregunta/{id}', [PreguntaController::class, 'destroy']);
Route::get('/encuesta/{encuestaId}/preguntas', [PreguntaController::class, 'getPreguntas']);

Route::get('/responder/{encuestaId}', [RespuestaController::class, 'resopnder']);
Route::post('/responder/{encuestaId}/{encuestadoID}', [RespuestaController::class, 'store']);
