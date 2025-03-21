@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route("admin_panel") }}"><button class="btn btn-primary">Geri git</button></a>

        <h3>İşletmeler</h3>
        <a href="{{ route("admin_business_create") }}"><button class="btn btn-success">İşletme Ekle</button></a>
        <div class="table-responsive">

        <table class="table" id="table">
            <tr>
                <th scope="col">İşletme İsmi</th>
                <th scope="col">İşletme Açıklaması</th>
                <th scope="col">İşletme Adres</th>
                <th scope="col">İşletme Statik Ip Adresi</th>
                <th scope="col">Kayıt Zamanı</th>
                <th scope="col">Güncelleme Zamanı</th>
                <th scope="col">Aktiflik</th>
                <th scope="col">Aktiflik Değiştir</th>
                <th scope="col">Güncelle</th>
                <th scope="col">Sil</th>



            </tr>
            @foreach ($businesess as $business)
                <tr>
                    <td>{{ $business->business_name }}</td>
                    <td>{{ $business->business_description }}</td>
                    <td>{{ $business->adress }}</td>
                    <td>{{ $business->static_ip_adress }}</td>
                    <td>{{ $business->created_at }}</td>
                    <td>{{ $business->updated_at }}</td>
                    @if ($business->active == 1)
                    
                        <td>Aktif</t>
                    @else
                        <td>Pasif</t>

                    @endif
                    <td>
                        @if ($business->active == 1)
                            <a href="{{ route('admin_business_activeness_change', [$business->id, $business->active]) }}"><button class="btn btn-warning">Deaktive Et</button></a>
                        @else
                            <a href="{{ route('admin_business_activeness_change', [$business->id, $business->active]) }}"><button class="btn btn-success">Aktive Et</button></a>

                        @endif
                    </td>
                    <td><a href="{{ route('admin_business_edit', $business->id) }}"><button class="btn btn-info">Güncelle</button></a></td>
                    <td><a href="{{ route('admin_business_delete', $business->id) }}"><button class="btn btn-danger">Sil</button></a></td>
                </tr>
            @endforeach
        </table>
        </div>

        
</div>    

@endsection
