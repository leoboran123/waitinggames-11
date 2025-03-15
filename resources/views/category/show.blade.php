@extends('layouts.app')

@section('content')

<div class="container">

<div class="row justify-content-center">
    <div class="container">
    <a href="{{ route("welcome") }}"><button class="btn btn-primary">Geri Dön</button></a>
    <h1>{{ $category->name }} Oyunları</h1>

    @if ($profiles->count() == 0)
            <p>Empty</p>
    @else
        @foreach($profiles as $profile)
        <div class="card mb-3" id="category">
                <a href="/{{$profile->category->slug}}/{{ $profile->url }}" id="category_link">
                    <img class="card-img-top" id="category_image" src="{{ Storage::disk('dropbox')->url($profile->image) }}" alt="Card image cap">
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

</div>
</div>    

@endsection
