@extends('layouts.app')

@section('content')
<div class="container">


        <button class="btn btn-info">Geri Dön</button>
    </a>    

    <div class="profile">

        <h1>{{$profile->profile_name}} </h1>
        <h5>{{ $profile->description }}</h5>

        
        <hr>
        <h6>Oyunlar</h6>
        
    </div>
</div>

@endsection
