@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Profilim</h1>
    @if ($user_type_id == 1)
        
        <h5>Kullanıcı Adı: {{ auth()->user()->username }}</h5>
        <h5>E-Posta: {{ auth()->user()->email }}</h5>
        
        @if ($user_profile == null)
            <a href="{{ route("create_profile") }}">Profil bilgileriniz eksik, lütfen doldurmak için tıklayın</a>
        @else
            <h5>İsim: {{ $user_profile->name }}</h5>
            <h5>Soyisim: {{ $user_profile->surname }}</h5>
            <a href="{{ route("edit_profile") }}">

                <button class="btn btn-info" >Bilgileri Düzenle</button>
            </a>
        @endif
    @endif

    <h1>Oyun</h1>
    <p>
        Bu ayki maksimum skorun: <strong>{{ $user_game_stats }}!</strong>
    </p> 
   

    
</div>

@endsection
