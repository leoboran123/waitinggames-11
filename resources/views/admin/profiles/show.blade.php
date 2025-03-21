@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route("admin_panel") }}"><button class="btn btn-primary">Geri git</button></a>

        <h3>Profiller</h3>
        <div class="table-responsive">

        <table class="table" id="table">
            <tr>
                <th scope="col">Kullanıcı İsmi</th>
                <th scope="col">İsim</th>
                <th scope="col">Soyisim</th>
                <th scope="col">Kayıt Zamanı</th>
                <th scope="col">Güncelleme Zamanı</th>
                <th scope="col">Aktiflik</th>
                
                <th scope="col">Aktiflik Değiştir</th>

            </tr>
            @foreach ($profiles as $profile)
                <tr>
                    <td>{{ $profile->user->username }}</td>
                    <td>{{ $profile->name }}</td>
                    <td>{{ $profile->surname }}</td>
                    <td>{{ $profile->created_at }}</td>
                    <td>{{ $profile->updated_at }}</td>
                    @if ($profile->active == 1)
                    
                        <td>Aktif</t>
                    @else
                        <td>Pasif</t>

                    @endif
                    <td>
                        @if ($profile->active == 1)
                            <a href="{{ route('admin_profile_activeness_change', [$profile->id, $profile->active]) }}"><button class="btn btn-warning">Deaktive Et</button></a>
                        @else
                            <a href="{{ route('admin_profile_activeness_change', [$profile->id, $profile->active]) }}"><button class="btn btn-success">Aktive Et</button></a>

                        @endif
                    </td>

                </tr>
            @endforeach
        </table>
        </div>

        
</div>    

@endsection
