<?php

use App\Http\Controllers\emprestimoController;
use App\Http\Controllers\leitorController;
use App\Http\Controllers\livrosController;
use Illuminate\Support\Facades\Route;

foreach (['/', '/dashboard'] as $rotas_main) {
    Route::get($rotas_main, [livrosController::class, 'index']);
}

Route::get('/formcreatelivros', [livrosController::class, 'formcreate']);
Route::post('/createlivros', [livrosController::class, 'store']);
Route::get('/formupdatelivros/{id}', [livrosController::class, 'formedit']);
Route::put('/updatelivros/{id}', [livrosController::class, 'update']);
Route::delete('/deletelivros/{id}', [livrosController::class, 'destroy']);

Route::get('/listleitor', [leitorController::class, 'index']);
Route::get('/formcreateleitor', [leitorController::class, 'formcreate']);
Route::post('/createleitor', [leitorController::class, 'store']);
Route::get('/formupdateleitor/{id}', [leitorController::class, 'formedit']);
Route::put('/updateleitor/{id}', [leitorController::class, 'update']);
Route::delete('/deleteleitor/{id}', [leitorController::class, 'destroy']);

Route::get('/listaremprestimo', [emprestimoController::class, 'index']);
Route::post('/createmprestimo', [emprestimoController::class, 'store']);
Route::put('/updatemprestimo', [emprestimoController::class, 'update']);
