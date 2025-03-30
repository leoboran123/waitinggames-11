@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="countdown-container">

            <h1 id="countdown" class="countdown"></h1>
        </div>
        <div class="game-button">

            <a href="{{ route("game_index") }}"><button class="btn btn-success">Oyuna git</button></a>
        </div>
        <hr style="margin: 15px;">

        <div class="leaderboard">
            <h1>Bu ayın sıralaması</h1>
            @if ($leaderboard_user_stat->isEmpty())
                Boş
            @else
                
                <div class="table-responsive" id="leaderboard">
                    
                    <table class="table table-hover" id="table">
                        <tr class="table-dark">
                            <th scope="col">Sıra</th>
                            <th scope="col">Kullanıcı İsmi</th>
                            <th scope="col">Skor</th>
                            
                        </tr>
                        @php
                            $lb_count = 1;
                        @endphp
                        @foreach ($leaderboard_user_stat as $stat)
                            @if ($check_user_is_logged_in == true && $stat->user->username == auth()->user()->username)
                                <tr class="table-success">
                                    <td><strong>{{ $lb_count }}</strong></td>
                                    @php
                                        $lb_count++;
                                    @endphp
                                        <td><strong>{{ $stat->user->username }}</strong></td>

                                        <td><strong>{{ $stat->score }}</strong></td>
                                </tr>
                            @else
                                <tr class="table-light">
                                    <td>{{ $lb_count }}</td>
                                    @php
                                        $lb_count++;
                                    @endphp
                                    
                                        <td>{{ $stat->user->username }}</td>

                                    <td>{{ $stat->score }}</td>
                                </tr>
                            @endif

                        @endforeach    
                    </table>


                </div>
            @endif

        </div>
        <hr style="margin: 15px;">
        <div class="former-leaderboard">
        <h1>Geçen ayın sıralaması</h1>
            @if ($former_leaderboard->isEmpty())
                Boş
            @else
                
                <div class="table-responsive" id="leaderboard">
                    
                    <table class="table table-hover" id="table">
                        <tr class="table-dark">
                            <th scope="col">Sıra</th>
                            <th scope="col">Kullanıcı İsmi</th>
                            <th scope="col">Skor</th>
                            
                        </tr>
                        @php
                            $lb_count = 1;
                        @endphp
                        @foreach ($former_leaderboard as $stat)
                            @if ($check_user_is_logged_in == true && $stat->user->username == auth()->user()->username)
                                <tr class="table-success">
                                    <td><strong>{{ $lb_count }}</strong></td>
                                    @php
                                        $lb_count++;
                                    @endphp
                                        <td><strong>{{ $stat->user->username }}</strong></td>

                                        <td><strong>{{ $stat->score }}</strong></td>
                                </tr>
                            @else
                                <tr class="table-light">
                                    <td>{{ $lb_count }}</td>
                                    @php
                                        $lb_count++;
                                    @endphp
                                    
                                        <td>{{ $stat->user->username }}</td>

                                    <td>{{ $stat->score }}</td>
                                </tr>
                            @endif

                        @endforeach    
                    </table>


                </div>
            @endif
        </div>

        <hr style="margin: 15px;">
        <div class="welcome_text">
            <h5>
                Web site tanıtım metni

            </h5>
        </div>
    </div>


    
</div>


<script>
    // Set the date we're counting down to
    var countDownDate = new Date("{{ $countdown }}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="countdown"
    document.getElementById("countdown").innerHTML = days + " gün, " + hours + " saat, "
    + minutes + " dakika, " + seconds + " saniye kaldı!";

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "Süre sona erdi!";
    }
    }, 1000);
</script>
@endsection