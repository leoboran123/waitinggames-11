@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        Sıralama

        <a href="{{ route("game_index") }}" ><button class="btn btn-success">Oyuna git</button></a>
    </div>


    <div class="welcome_text">
        <h5>
            Web site tanıtım metni

        </h5>
    </div>
</div>

@endsection