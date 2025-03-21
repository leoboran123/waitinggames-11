@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Bu işletmeyi silmek istediğinize emin misiniz?</h2>

        <div class="options">

            <a href="{{ route("admin_business_delete_done", $business_id) }}"><button class="btn btn-danger">Sil</button></a>
            <a href="{{ route("admin_businesess") }}"><button class="btn btn-primary">Vazgeç</button></a>
        </div>

    </div>




@endsection