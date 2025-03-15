@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route("admin_panel") }}"><button class="btn btn-primary">Geri git</button></a>

        <h3>Kullanıcılar</h3>

        <table class="table" id="table">
            <tr>
                <th scope="col">İsim</th>
                <th scope="col">E-Mail</th>
                <th scope="col">Aktiflik</th>
                <th scope="col">Kayıt Zamanı</th>
                <th scope="col">Güncelleme Zamanı</th>
                <th scope="col">Aktiflik Değiştir</th>

            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
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

@endsection
