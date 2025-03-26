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
    <p>Bu ayın sıralaması:</p>
    @if ($leaderboard_user_stat->isEmpty())
        Henüz kimse oynamadı!
    @else
        <div class="table-responsive" id="leaderboard">
        
            <table class="table" id="table">
                <tr>
                    <th scope="col">Sıra</th>
                    <th scope="col">Kullanıcı İsmi</th>
                    <th scope="col">Skor</th>
                    
                </tr>
                @php
                    $lb_count = 1;
                @endphp
                @foreach ($leaderboard_user_stat as $stat)
                    <tr>
                        <td>{{ $lb_count }}</td>
                        @php
                            $lb_count++;
                        @endphp
                        @if ($stat->user->username == auth()->user()->username)
                        
                            <td><strong>{{ $stat->user->username }}</strong></td>
                        @else
                            <td>{{ $stat->user->username }}</td>

                        @endif
                        <td>{{ $stat->score }}</td>
                    </tr>

                @endforeach    
            </table>


        </div>
    @endif

    
</div>

@endsection
