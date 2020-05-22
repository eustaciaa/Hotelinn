@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="card my-5">
                    <div class="card-header justify-content-center"><i>{{__('Ubah Profil')}}</i></div>
                    <div class="card-body">
                        <form action="/updateProfile" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <label for="fName" class="col-md-4 col-form-label text-md-right">{{ __('Nama Depan') }}</label>
                            
                                    <div class="col-md-6">
                                        <input id="fName" type="text" class="form-control" name="fName" value="{{ Auth::user()->fName }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lName" class="col-md-4 col-form-label text-md-right">{{ __('Nama Belakang') }}</label>

                                    <div class="col-md-6">
                                        <input id="lName" type="text" class="form-control" name="lName" value="{{ Auth::user()->lName }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right"><i>{{ __('Email') }}</i></label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="gender" class="col-md-4 col-form-label text-md-right"><i>{{ __('Jenis Kelamin') }}</i></label>

                                    <div class="col-md-6">
                                        <input id="gender" type="text" class="form-control" name="gender" value="{{ Auth::user()->gender }}" required disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="birtdate" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                    <div class="col-md-6">
                                        <input id="date" type="text" class="form-control" name="birthdate" value="{{ Auth::user()->birthdate }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <button id="submit" class="btn btn-primary offset-md-4 " type="submit">Ubah</button>
                                </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
