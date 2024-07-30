<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pets', [PetController::class, 'index']);
Route::post('/pets/add', [PetController::class, 'addPet']);
