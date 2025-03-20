@extends('layouts.app')

@section('content')

<div class="container">

<div class="row justify-content-center">

    <h3>İşletmeler</h3>
    @if ($profiles->count() == 0)
            <p>Sonuç bulunamadı</p>
    @else
        @foreach($profiles as $profile)
        <div class="card mb-3" id="category">
                <a href="/{{$profile->category->slug}}/{{ $profile->url }}" id="category_link">
                    <img class="card-img-top" id="category_image" src="{{ Storage::disk(env('FILESYSTEM'))->url($profile->image) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $profile->profile_name }}
                        </h5>
                        @if ($profile->description != null)
                        
                            <p class="card-text">{{ $profile->description }}</p>
                        @endif
                    </div>
                </a>
            </div>
            
            
            @endforeach
            
    @endif
    <h3>Kategoriler</h3>

    @if ($all_categories->count() == 0)
        <p>Sonuç bulunamadı</p>
    @else
        @foreach($all_categories as $category)

        <a href="/category/{{ $category->slug }}" id="category_link">
            <div class="card mb-3" id="category">
                <img class="card-img-top" id="category_image" src="{{ Storage::disk(env('FILESYSTEM'))->url($category->image) }}" alt="Card image cap">
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
        
    
        @endforeach
    @endif


</div>

@endsection
