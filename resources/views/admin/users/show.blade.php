@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route("admin_panel") }}"><button class="btn btn-primary">Geri git</button></a>
        <hr style="margin: 5px;">

        <h3>Kullanıcılar</h3>
        <p>(Deaktive edilen kullanıcılar oyun sıralamasından silinir ve hesaplarına giriş yapmaları engellenir!)</p>
        <hr style="margin: 5px;">

        <div class="table-responsive">

        <table class="table table-hover" id="table">
            <tr>
                <th scope="col">Kullanıcı Adı</th>
                <th scope="col">E-Mail</th>
                <th scope="col">Kayıt Zamanı</th>
                <th scope="col">Güncelleme Zamanı</th>
                <th scope="col">Aktiflik</th>
                <th scope="col">Aktiflik Değiştir</th>

            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>

                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    @if ($user->active == 1)
                    
                        <td>Aktif</t>
                    @else
                        <td>Pasif</t>

                    @endif
                    <td>
                        @if ($user->active == 1)
                            <a href="{{ route('admin_user_activeness_change', [$user->id, $user->active]) }}"><button class="btn btn-warning">Deaktive Et</button></a>
                        @else
                            <a href="{{ route('admin_user_activeness_change', [$user->id, $user->active]) }}"><button class="btn btn-success">Aktive Et</button></a>

                        @endif
                    </td>

                </tr>
            @endforeach
        </table>
        </div>

        
</div>    

@endsection
