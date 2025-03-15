@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Profilim</h1>
    @if ($user_type_id == 1)
        <h5>

        --Ziyaretçi sayfası--
        </h5>
        <h5>İsim: {{ auth()->user()->name }}</h5>
        <h5>E-Posta: {{ auth()->user()->email }}</h5>
    @else
    <h5>

        --İşletme sayfası--
    </h5>
        @if ($user_profile == null)
            <h1>Bir işletme sayfanız yok. Oluşturmak ister misiniz?</h1>
            <a href="{{ route("create_profile") }}">Evet</a>
        
        @else
            @if ($user_profile->active == 0)
                <div class="alert alert-danger" role="alert">
                    İşletme hesabınız site yöneticisi tarafından devre dışı bırakılmıştır. Lütfen site yöneticisiyle iletişime geçin.
                </div>
            @else

                <h5>İşletme ismi: {{$user_profile->profile_name}}</h5>
                <h5>
                    
                    Açıklama: {{$user_profile->description}}
                </h5>
                    
                <a href="{{ route('show_profile', [$user_profile->category,$user_profile]) }}">İşletme sayfasına gitmek için tıklayın...</a> 
                <h5>
                    
                    Statik Ip: {{$user_profile->static_ip_adress}}
                </h5>
                <h5>
                    
                    Resim: 
                    <img id="category_image" src="{{ Storage::disk('dropbox')->url("public/".$user_profile->image) }}" alt="">
                    
                </h5>
                <h5>
                    Oluşturulma zamanı: {{$user_profile->created_at}}
                    Güncellenme zamanı: {{$user_profile->updated_at}}
                    
                </h5>
                <a href="{{ route("edit_profile") }}">
                    
                    <button class="btn btn-primary">
                        
                        İşletme bilgilerini güncelle
                    </button>
                </a>
            @endif
        @endif

    @endif
</div>

@endsection
