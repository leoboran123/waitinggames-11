@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Admin Paneli</h3>

        <a href="{{ route("admin_users") }}"><button class="btn btn-primary">Kullanıcılar</button></a>
        <a href="{{ route("admin_profiles") }}"><button class="btn btn-primary">Profiller</button></a>
        <a href="{{ route("admin_businesess") }}"><button class="btn btn-primary">İşletmeler</button></a>


    </div>


@endsection
