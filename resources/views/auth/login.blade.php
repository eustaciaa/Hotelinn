@extends('layouts.app')

@section('content')
<div class="container mh-100">
    <div class="row d-flex align-items-center mh-100" style="height:85vh;">
        <div class="col-md-6 text-md-right mh-100 m-0 txt-lightblack">
            <img src="/images/hotelinn/brand1.png" height="50vh"><br><br>
            <h1 style="font-size:300%;">
                <b>Masuk sekarang untuk dapat memesan hotel yang kamu mau!</b>
            </h1><br><br><br>
        </div>
        <div class="col-md-6 pl-5 form">
            <div class="row pl-5 form">
                <div class="card col-md-9">
                    <div class="card-body">
                        <h4 class="card-title text-center"><b>{{ __('Masuk') }}</b></h4><br>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('Alamat E-Mail') }}</label>

                                <div class="col-md-7">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('Kata Sandi') }}</label>

                                <div class="col-md-7">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-7 offset-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Ingat Saya') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mt-4 mb-2 d-flex justify-content-end flex-column">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Masuk') }}
                                    </button>
                
                                @if (Route::has('password.request'))
                                        <a id="forgot-password" class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Lupa Kata Sandi?') }}
                                        </a>
                                @endif                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
