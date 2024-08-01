<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pets', [PetController::class, 'index'])->name('pets');
Route::post('/pets/add', [PetController::class, 'addPet']);
Route::post('/pets/find', [PetController::class, 'findPet']);
