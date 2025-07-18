@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route("admin_panel") }}"><button class="btn btn-primary">Geri git</button></a>
        <hr style="margin: 10px;">

        <h3>İşletmeler</h3>
        <p>(İşletme eklenmediği sürece oyun herkes tarafından erişilebilir durumdadır)</p>
        <hr style="margin: 10px;">
        <a href="{{ route("admin_business_create") }}"><button class="btn btn-success">İşletme Ekle</button></a>
        
        <div class="table-responsive">

        <table class="table table-hover" id="table">
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
                    @if ($business->adress == null)
                        <td>Adres yok</td>
                    @else
                        <td><a href="{{ $business->adress }}" target="_blank">{{ $business->adress }}</a></td>
                    @endif
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
