@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route("admin_panel") }}"><button class="btn btn-primary">Geri git</button></a>
        <hr style="margin: 5px;">

        <p>(Deaktive edilen skorlar sadece skor tablosundan silinecektir. Kullanıcının bütün skorlarını deaktive etmek için kullanıcı sayfasından kullanıcıyı devre dışı bırakın)</p>
        <hr style="margin: 5px;">
        <div class="leaderboard">
                <h1>Bu ayın güncel sıralaması</h1>
                @if ($leaderboard_user_stat->isEmpty())
                    Boş
                @else
                    
                    <div class="table-responsive" id="leaderboard">
                        
                        <table class="table table-hover table-bordered" id="table">
                            <tr class="table-dark">
                                <th scope="col">Sıra</th>
                                <th scope="col">Kullanıcı İsmi</th>
                                <th scope="col">Skor</th>
                                <th scope="col">Oynanma Tarihi</th>
                                <th scope="col">Aktiflik</th>

                                
                            </tr>
                            @php
                                $lb_count = 1;
                            @endphp
                            @foreach ($leaderboard_user_stat as $stat)
                                
                                    <tr class="table-light">
                                        <td>{{ $lb_count }}</td>
                                        @php
                                            $lb_count++;
                                        @endphp
                                        
                                            <td>{{ $stat->user->username }}</td>

                                        <td>{{ $stat->score }}</td>
                                        <td>{{ $stat->created_at }}</td>

                                        @if($stat->active == 1)

                                            <td><a href="{{ route('admin_gamescore_activeness_change', [$stat->id, $stat->active]) }}"><button class="btn btn-warning">Deaktive Et</button></a></td>
                                        @else
                                            <td><a href="{{ route('admin_gamescore_activeness_change', [$stat->id, $stat->active]) }}"><button class="btn btn-success">Aktive Et</button></a></td>

                                        @endif
                                    </tr>


                            @endforeach    
                           
                        </table>


                    </div>
                @endif

        </div>
        <hr style="margin:10px;">
        <div class="former-leaderboard">
            <h1>Geçen ayın sıralaması</h1>
            @if ($former_leaderboard->isEmpty())
                Boş
            @else
                
                <div class="table-responsive" id="leaderboard">
                    
                    <table class="table table-hover table-bordered" id="table">
                        <tr class="table-dark">
                            <th scope="col">Sıra</th>
                            <th scope="col">Kullanıcı İsmi</th>
                            <th scope="col">Skor</th>
                            <th scope="col">Oynanma Tarihi</th>
                            <th scope="col">Aktiflik</th>

                            
                        </tr>
                        @php
                            $lb_count = 1;
                        @endphp
                        @foreach ($former_leaderboard as $stat)
                            
                                <tr class="table-light">
                                    <td>{{ $lb_count }}</td>
                                    @php
                                        $lb_count++;
                                    @endphp
                                    
                                        <td>{{ $stat->user->username }}</td>

                                    <td>{{ $stat->score }}</td>
                                    <td>{{ $stat->created_at }}</td>
                        
                                    @if($stat->active == 1)

                                        <td><a href="{{ route('admin_gamescore_activeness_change', [$stat->id, $stat->active]) }}"><button class="btn btn-warning">Deaktive Et</button></a></td>
                                    @else
                                        <td><a href="{{ route('admin_gamescore_activeness_change', [$stat->id, $stat->active]) }}"><button class="btn btn-success">Aktive Et</button></a></td>

                                    @endif
                                </tr>


                        @endforeach    
                        
                    </table>


                </div>
            @endif
        </div>
    </div>

@endsection
