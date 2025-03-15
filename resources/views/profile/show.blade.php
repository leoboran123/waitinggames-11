@extends('layouts.app')

@section('content')
<div class="container">

    <a href="{{ route('show_category', $profile->category->slug) }}">

        <button class="btn btn-info">Geri Dön</button>
    </a>    

    <div class="profile">

        <img id="category_image" src="{{ Storage::disk('dropbox')->url("public/".$profile->image) }}" alt="">
        <h1>{{$profile->profile_name}} </h1>
        <h5>{{ $profile->description }}</h5>

        
        <hr>
        <h6>Oyunlar</h6>
        
    </div>
</div>

@endsection
