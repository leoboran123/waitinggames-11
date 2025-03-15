@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route("admin_panel") }}"><button class="btn btn-primary">Geri git</button></a>

        <h3>Profiller</h3>

        <table class="table" id="table">
            <tr>
                <th scope="col">Profil İsmi</th>
                <th scope="col">İşletmeci ismi</th>
                <th scope="col">Açıklama</th>
                <th scope="col">Resim</th>
                <th scope="col">Kayıt Zamanı</th>
                <th scope="col">Güncelleme Zamanı</th>
                <th scope="col">Aktiflik</th>
                
                <th scope="col">Aktiflik Değiştir</th>

            </tr>
            @foreach ($profiles as $profile)
                <tr>
                    <td>{{ $profile->profile_name }}</td>
                    <td>{{ $profile->user->name }}</td>
                    <td>{{ $profile->description }}</td>
                    <td><img src="{{ Storage::disk('dropbox')->url( "public/".$profile->image ) }}" id="table_image" alt=""> </td>
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

@endsection
