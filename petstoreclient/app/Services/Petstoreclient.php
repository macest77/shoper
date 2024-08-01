<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use  App\Services\PetstoreclientInterface;

class Petstoreclient implements PetstoreclientInterface
{
    public function oauth(): bool
    {
        $response = Http::withHeaders(['x-api-key' => 'special-key'])
                ->get('https://petstore.swagger.io/oauth/authorize');
                
        return $response->successful();
    }
}
