@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Panel') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Giriş yapıldı! Ana sayfaya yönlendiriliyorsunuz.') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "{{ route("welcome") }}";

        }, 500);
</script>
@endsection
