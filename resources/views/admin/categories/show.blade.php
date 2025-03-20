@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route("admin_panel") }}"><button class="btn btn-primary">Geri git</button></a>

 
    <h3>Kategoriler</h3>
    <a href="{{ route("admin_category_create") }}"><button class="btn btn-success">Kategori Ekle</button></a>
    <div class="table-responsive">

    <table class="table" id="table">
        <tr>
            <th scope="col">İsim</th>
            <th scope="col">Açıklama</th>
            <th scope="col">Resim</th>
            <th scope="col">Kayıt Zamanı</th>
            <th scope="col">Güncelleme Zamanı</th>
            <th scope="col">Aktiflik</th>
            <th scope="col">Aktiflik Değiştir</th>
            <th scope="col">Güncelle</th>
            <th scope="col">Sil</th>



        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    @if ($category->image == null)
                        Resim yok
                    @else

                            <img src="{{ Storage::disk(env('FILESYSTEM'))->url($category->image) }}" alt="" id="table_image">
                        
                        @endif    
                </td>

                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }}</td>
                @if ($category->active == 1)
                
                    <td>Aktif</t>
                @else
                    <td>Pasif</t>

                @endif
                <td>
                    @if ($category->active == 1)
                        <a href="{{ route('admin_category_activeness_change', [$category->id, $category->active]) }}"><button class="btn btn-warning">Deaktive Et</button></a>
                    @else
                        <a href="{{ route('admin_category_activeness_change', [$category->id, $category->active]) }}"><button class="btn btn-success">Aktive Et</button></a>

                    @endif
                </td>
                <td><a href="{{ route('admin_category_edit', $category->id) }}"><button class="btn btn-info">Güncelle</button></a></td>
                <td><a href="{{ route('admin_category_delete', $category->id) }}"><button class="btn btn-danger">Sil</button></a></td>


            </tr>
        @endforeach
    </table>
    </div>

        
</div>   
@endsection
