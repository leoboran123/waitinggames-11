@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Bu kategoriyi silmek istediğinize emin misiniz?</h2>

        <div class="options">

            <a href="{{ route("admin_category_delete_done", $categoryId) }}"><button class="btn btn-danger">Sil</button></a>
            <a href="{{ route("admin_categories") }}"><button class="btn btn-primary">Vazgeç</button></a>
        </div>

    </div>




@endsection
