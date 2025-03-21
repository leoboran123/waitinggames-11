@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ekle') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin_business_store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="business_name" class="col-md-4 col-form-label text-md-right">{{ __('İşletme İsmi: ') }}</label>

                            <div class="col-md-6">
                                <input id="business_name" type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name" value="{{ old('business_name') }}" required autocomplete="business_name" autofocus>

                                @error('business_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="business_description" class="col-md-4 col-form-label text-md-right">{{ __('İşletme Açıklaması: ') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="business_description" id="business_description"></textarea>

                                @error('business_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="static_ip_adress" class="col-md-4 col-form-label text-md-right">{{ __('Statik Ip Adresi: ') }}</label>

                            <div class="col-md-6">
                                <input id="static_ip_adress" type="text" class="form-control @error('static_ip_adress') is-invalid @enderror" name="static_ip_adress" value="{{ old('static_ip_adress') }}" autocomplete="static_ip_adress" autofocus>

                                @error('static_ip_adress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adress" class="col-md-4 col-form-label text-md-right">{{ __('İşletme Adresi URL: ') }}</label>

                            <div class="col-md-6">
                                <input id="adress" type="url" class="form-control @error('adress') is-invalid @enderror" name="adress" value="{{ old('adress') }}" autocomplete="adress" autofocus>

                                @error('adress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ekle') }}
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