<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use App\Models\Pets;

class PetController extends Controller
{
    
    public function index(): View
    {
        return view('pets.index', [
            'categories' => Pets::getCategories(),
            'statuses' => Pets::getStatuses()
        ]);
    }
    
    public function addPet()
    {
        echo 'dodajemy';
    }
    
    public function getPet(int $id)
    {
        
    }
    
    public function updatePet()
    {
        
    }
    
}
