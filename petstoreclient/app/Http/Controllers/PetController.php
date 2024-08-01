<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use App\Models\Pets;
use App\Services\Petstoreclient;

class PetController extends Controller
{
    private $petstoreclient;
    
    public function __construct(Petstoreclient $petstoreclient)
    {
        $this->petstoreclient = $petstoreclient;
    }
    
    public function index(Request $request): View
    {
        $petID = $request->query('petID');
        
        return view('pets.index', [
            'categories' => Pets::getCategories(),
            'statuses' => Pets::getStatuses(),
            'petID' => $petID ?? ''
        ]);
    }
    
    public function addPet(Request $request)
    {
        $categories = Pets::getCategories();
        $statuses = Pets::getStatuses();
        
        $tags = explode(',', $request->tags);
        
        $tags_to_request = [];
        foreach( $tags as $key => $tag) {
            $tags_to_request[] = (object)[ 'id' => $key,
                                    'name' => $tag ];
        }        
        
        $data_to_json = [
            'id' => 0,
            'name' => $request->name,
            'category' => (object)['id' => $request->category_id,
                            'name' => $categories[$request->category_id]
                        ],
            'photoUrl' => [ $request->photo_url ],
            'tags' => $tags_to_request,
            'status' => Pets::getStatuses()[$request->status_id],
        ];
        $response = Http::withBody(json_encode($data_to_json), 'application/json')
            ->withBasicAuth('test', 'abc123')
            ->post('https://petstore.swagger.io/v2/pet');
        //dd($response->successful());
        $body = false;
        if ( $response->successful() ) {
            $body = $response->body();
            $body = json_decode($body);
            //dd($body->id);
        }
        return redirect()->route('pets', ['petID' => $body->id, 'type' => 'added']);
        //dd($response->body());
        return view('pets.index', [
            'categories' => Pets::getCategories(),
            'statuses' => Pets::getStatuses(),
            'body' => $body
        ]);
    }
    
    public function findPet(Request $request)
    {
        $body = null;
        $fetched_data = null;

        $this->petstoreclient->oauth();

        if ( $request->find_type == 'status' ) {
            
            $response = Http::withHeaders(['x-api-key' => 'special-key'])
                ->get('https://petstore.swagger.io/v2/pet/findByStatus?status=' . Pets::getStatuses()[$request->search_status_id]);
        } else {
            
            $response = Http::withHeaders(['x-api-key' => 'special-key'])
                ->get('https://petstore.swagger.io/v2/pet/' . $request->search_pet_id);
        }
        
        if ( $response->successful() ) {
            
            $body = $response->body();
            $body = json_decode($body);
            
            $fetched_data = [ $body ];
            
            if ( is_array($body) ) {
                
                $fetched_data = $body;
            }
            
        }
        return view('pets.index', [
            'categories' => Pets::getCategories(),
            'statuses' => Pets::getStatuses(),
            'fetched_data' => $fetched_data
        ]);
    }
    
    public function updatePet(Request $request)
    {
        
    }
    
}
