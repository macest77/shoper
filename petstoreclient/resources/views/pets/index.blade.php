@extends('layouts.app')

@section('scripts')
    <script>
        function showForm(div) {
            
            $("#add_div").hide();
            $("#find_div").hide();
            
            $("#"+div+"_div").show();
        }
        function submitForm(f, pet) {
            var form = $("#"+f+"_pet_form");
            var petID = $("#"+f+"_pet_id");
            
            petID.val(pet);
            
            if (f == 'search') {
                $("#find_type_id").click();
                $("#is_editing").val("1");
            }
            
            form.submit();
            
        }
    </script>
@endsection

@section('content')

    @if( !empty($petID) )
        <p><strong>Pet {{ $type ?? 'edited' }} - ID: {{ $petID }}</strong></p>
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
        
        <form id="search_pet_form" method="post" action="/pets/find">@csrf
        
            <input type="radio" id="find_type_status" name="find_type" value="status" /> 
            Status: <select name="search_status_id">
                    @foreach($statuses as $key => $status)
                    <option value="{{ $key }}">{{ $status }}</option>
                    @endforeach
                </select><br />
                
            <input type="radio" id="find_type_id" name="find_type" value="id" /> 
            <input type="text" id="search_pet_id" name="search_pet_id" value="" placeholder="Pet ID" /> <br />
            <input type="hidden" id="is_editing" name="is_editing" value="0" />
            
            <br />
            <input type="submit" value="Search" />
            
        </form>
    </div>
    <div id="fetched_div">
    
    @if( !empty($fetched_data) )
        @if( $fetched_data == '')
            <p>No data</p>
        @else
        
            @for ( $i=0; $i<count($fetched_data); $i++ )
        
                @if ( $i>(count($fetched_data)-10) )
                
        {{ $fetched_data[$i]->id }} . {{ $fetched_data[$i]->name }}
        <button onclick="submitForm('search', '{{ $fetched_data[$i]->id }}')" >Edit</button> &nbsp; 
        <button onclick="submitForm('delete', '{{ $fetched_data[$i]->id }}')" >Delete</button>
        <br />
        
                @endif
                
            @endfor
            
        <form id="edit_pet_form" method="post" action="/pets/update">@csrf
            
        </form>
        
        <form id="delete_pet_form" method="post" action="/pets/delete">@csrf
            <input type="hidden" id="delete_pet_id" name="delete_pet_id" value="" />
        </form>
        
        @endif
        
    @endif
    
    </div>
    
@endsection
