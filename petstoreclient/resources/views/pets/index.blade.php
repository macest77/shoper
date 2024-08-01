@extends('layouts.app')

@section('scripts')
    <script>
        function showForm(div) {
            
            $("#add_div").hide();
            $("#find_div").hide();
            
            $("#"+div+"_div").show();
        }
    </script>
@endsection

@section('content')

    @if( !empty($petID) )
        <p><strong>Pet added - ID: {{ $petID }}</strong></p>
    @endif
    <button onclick="showForm('add')">Add</button> | <button onclick="showForm('find')">Find</button>
    
    <div id="add_div" style="display: none">
        
        <form id="add_pet_form" method="post" action="/pets/add">@csrf
        
            <h3>Add Pet</h3>
            
            Name: <input type="text" name="name" value="" /><br />
            
            Category: <select name="category_id">
                @foreach($categories as $key => $category)
                <option value="{{ $key }}">{{ $category }}</option>
                @endforeach
            </select><br />
            
            Photo URL: <input type="text" name="photo_url" value="" /><br />
            
            Tags: <input type="text" name="tags" value="" /><br />
            <sup>(separate tags with coma)</sup><br />
            
            Status: <select name="status_id">
                @foreach($statuses as $key => $status)
                <option value="{{ $key }}">{{ $status }}</option>
                @endforeach
            </select><br />
            
            <br />
            <input type="submit" value="Dodaj" />
            
        </form>
    </div>
    
    <div id="find_div" style="display: none">
    
        <h3>Find Pet</h3>
        
        <form id="add_pet_form" method="post" action="/pets/find">@csrf
        
            <input type="radio" id="find_type1" name="find_type" value="status" /> 
            Status: <select name="search_status_id">
                    @foreach($statuses as $key => $status)
                    <option value="{{ $key }}">{{ $status }}</option>
                    @endforeach
                </select><br />
                
            <input type="radio" id="find_type2" name="find_type" value="id" /> 
            <input type="text" id="search_pet_id" name="search_pet_id" value="" placeholder="Pet ID" /> <br />
            
            <br />
            <input type="submit" value="Search" />
            
        </form>
    </div>
    <div id="fetched_div">
    
    @if( !empty($fetched_data) )
        @for ( $i=0; $i<count($fetched_data); $i++ )
        
            @if ( $i>(count($fetched_data)-10) )
                
        {{ $fetched_data[$i]->id }} . {{ $fetched_data[$i]->name }}<br />
        
            @endif
        @endfor
    @endif
    
    </div>
    
@endsection
