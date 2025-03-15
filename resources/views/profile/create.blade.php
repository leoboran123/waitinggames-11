@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Güncelle') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route("store_profile") }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('İşletme İsmi:') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('İşletme açıklaması:') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="description" id="description"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="static_ip_adress" class="col-md-4 col-form-label text-md-right">{{ __('Statik Ip Adresi:') }}</label>

                            <div class="col-md-6">
                                <input id="static_ip_adress" type="text" class="form-control @error('static_ip_adress') is-invalid @enderror" name="static_ip_adress" value="{{ old('static_ip_adress') }}"  autocomplete="static_ip_adress" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('İşletme türü:') }}</label>

                            <div class="col-md-6">

                                <select name="category" id="category" class="form-control">
                                    @foreach ($categories as $category)
                                    
                                        <option class="form-control" value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                    
                                </select>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Resim:') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" name="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Oluştur') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
