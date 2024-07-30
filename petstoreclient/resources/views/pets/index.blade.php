@extends('layouts.app')

@section('contentscripts')
    <script>
        function showAddForm() {
            $("#add_div").show();
        }
    </script>
@endsection

@section('content')

    <button onclick="showAddForm()">Add</button> | Find 
    
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
    
@endsection
