@extends('layouts.app')

@section('content')
<div class="container mh-100 my-5">
    <div class="row justify-content-center ml-5 mh-100" style="height:85vh;">
        <div class="col-md-4 text-md-right mh-100 m-0 txt-lightblack d-flex flex-column align-items-end">
            <br><br><br><img src="/images/hotelinn/brand1.png" height="50vh"><br>
            <h1>
                <b>Daftar untuk menemukan kenyamanan menginap dengan hotelinn!</b>
            </h1>
        </div>
        <div class="col-md-8 pl-3">
            <div class="row pl-5">
                <div class="card col-md-9">
                    <div class="card-body">
                        <h4 class="card-title text-center"><b>{{ __('Daftar') }}</b></h4><br>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('Alamat E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fName" class="col-md-5 col-form-label text-md-right">{{ __('Nama Depan') }}</label>

                                <div class="col-md-6">
                                    <input id="fName" type="text" class="form-control @error('fName') is-invalid @enderror" name="fName" value="{{ old('fName') }}"  autocomplete="fName">

                                    @error('fName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lName" class="col-md-5 col-form-label text-md-right">{{ __('Nama Belakang') }}</label>

                                <div class="col-md-6">
                                    <input id="lName" type="text" class="form-control @error('lName') is-invalid @enderror" name="lName" value="{{ old('lName') }}"  autocomplete="lName">

                                    @error('lName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birthdate" class="col-md-5 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                <div class="col-md-6">
                                    <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}"  autocomplete="birthdate">

                                    @error('birthdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-5 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('gender') is-invalid @enderror" id="gender"  autocomplete="gender" name="gender">
                                        @if (old('gender')=='M')
                                            <option value="M" selected>Pria</option>
                                            <option value="F">Wanita</option>
                                        @else
                                            <option value="M">Pria</option>
                                            <option value="F" selected>Wanita</option>
                                        @endif
                                    </select>
                                    <!-- <input id="gender" type="date" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}"  autocomplete="gender"> -->

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('Kata Sandi') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Konfirmasi Kata Sandi') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mt-5 mx-3 mb-2 d-flex justify-content-end flex-column">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Daftar') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
