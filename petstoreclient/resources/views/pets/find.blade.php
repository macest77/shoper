@extends('layouts.app')

@section('scripts')
    <script>
        function showAddForm() {
            $("#add_div").show();
        }
    </script>
@endsection

@section('content')

    <h3><strong>Editing Pet ID: {{ $fetched_data[0]->id }}</strong></h3>
    
    <div id="add_div">
        <form id="add_pet_form" method="post" action="/pets/add">@csrf
        
            <input type="hidden" name="edit_pet_id" value="{{ $fetched_data[0]->id }}" />
            <input type="hidden" name="is_editing" value="1" />
            
            Name: <input type="text" name="name" value="{{ $fetched_data[0]->name }}" /><br />
            
            Category: <select name="category_id">
                @foreach($categories as $key => $category)
                    
                    @php
                        $selected_txt = '';
                    
                        if($fetched_data[0]->category->id == $key) {
                            $selected_txt = ' selected="selected"';
                        }
                    @endphp
                <option value="{{ $key }}"{{ $selected_txt }}>{{ $category }}</option>
                @endforeach
            </select><br />
            
            Photo URL: <input type="text" name="photo_url" value="{{ $fetched_data[0]->photoUrls[0] ?? '' }}" /><br />
            
            @php $tags = ''; @endphp
            @foreach($fetched_data[0]->tags as $tag)
                @php
                    if ($tags != '') {
                        $tags = $tags . ',';
                    }
                    
                    $tags = $tags . $tag->name;
                    
                @endphp

            @endforeach
            Tags: <input type="text" name="tags" value="{{ $tags }}" /><br />
            <sup>(separate tags with coma)</sup><br />
            
            Status: <select name="status_id">
                @foreach($statuses as $key => $status)
                    @php 
                        $selected_txt = '';
                    
                        if($fetched_data[0]->status == $status) {
                            $selected_txt = ' selected="selected"';
                        }
                    @endphp
                <option value="{{ $key }}"{{ $selected_txt }}>{{ $status }}</option>
                @endforeach
            </select><br />
            
            <br />
            <input type="submit" value="Update" /> <a href="/pets">Cancel</a>
            
        </form>
    </div>
    
@endsection
