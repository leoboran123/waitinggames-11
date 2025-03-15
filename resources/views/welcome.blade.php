@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1>Kategoriler</h1>
    </div>
    <div id="categories">
        @if ($all_categories->count() == 0)
            <p>Boş</p>
        @else
            @foreach($all_categories as $category)
                @if ($category->active == 0)
                
                @else

                    <a href="/category/{{ $category->slug }}" id="category_link">
                        <div class="card mb-3" id="category">
                            <img class="card-img-top" id="category_image" src="{{ Storage::disk('dropbox')->url("public/".$category->image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $category->name }}
                                </h5>
                                @if ($category->description != null)
                                
                                <p class="card-text">{{ $category->description }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                @endif
                
        
            @endforeach
        @endif
    </div>
    <div class="welcome_text">
        <h5>
            Web site tanıtım metni

        </h5>
    </div>
</div>

@endsection