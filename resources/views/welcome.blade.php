@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="leaderboard">
            <h1>Bu ayın sıralaması</h1>
            <a href="{{ route("game_index") }}" ><button class="btn btn-success">Oyuna git</button></a>

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

    </div>


    <div class="welcome_text">
        <h5>
            Web site tanıtım metni

        </h5>
    </div>
</div>

@endsection