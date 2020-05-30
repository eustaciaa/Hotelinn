@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <h3>Formulir Pemesanan</h3>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi penginapan</h5><br>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Check in') }}</label>

                        <div class="col-md-6 d-flex align-items-end">
                            <h5><span class="badge badge-primary txt-lightblack text-uppercase transparent">
                                {{ date_format(date_create($userInput['checkIn']), "j F Y") }}
                            </span></h5>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Check out') }}</label>

                        <div class="col-md-6 d-flex align-items-end">
                            <h5><span class="badge badge-primary txt-lightblack text-uppercase transparent">
                                {{ date_format(date_create($userInput['checkOut']), "j F Y") }}
                            </span></h5>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Hotel') }}</label>

                        <div class="col-md-6 d-flex flex-column justify-content-start">
                            <h6>{{ $hotel->name }}</h6>
                            <p>{{ $alamat->detailLengkap }}</p>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Ruangan') }}</label>

                        <div class="col-md-6 d-flex align-items-center">
                        <h6>{{ $room->name }}</h6>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Harga') }}</label>

                        <div class="col-md-6 d-flex align-items-center text-red">
                        <h6>Rp{{number_format($room->cost,2,",",".")}} / malam</h6>
                        </div>
                    </div>

                    <form action="/rentFinal" method="POST">
                        @csrf
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-4 col-form-label text-md-right">{{ __('Jumlah') }}</label>

                        <div class="col-md-6">
                            <input id="jmlh" type="number" class="form-control @error('jmlh') is-invalid @enderror" name="jmlh" value="{{ 1 }}" min="1" max="{{$userInput['roomAvail']}}" required>
                            @error('jmlh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="badge badge-warning txt-lightblack transparent">
                                <i class="fas fa-exclamation-circle mr-1"></i><b>Tersisa {{ $userInput['roomAvail'] }} ruangan</b>
                            </span>
                            <br><small class="text-muted text-07"><b>Anda hanya dapat memesan paling banyak {{ $userInput['roomAvail'] }} ruangan.</b></small>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data diri</h5><br>
                    <div class="form-group row">
                        <label for="fName" class="col-md-4 col-form-label text-md-right">{{ __('Nama Depan') }}</label>

                        <div class="col-md-6">
                            <input id="fName" type="text" class="form-control @error('fName') is-invalid @enderror" name="fName" value="{{ Auth::user()->fName }}" required autofocus>
                            @error('fName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lName" class="col-md-4 col-form-label text-md-right">{{ __('Nama Belakang') }}</label>

                        <div class="col-md-6">
                            <input id="lName" type="text" class="form-control @error('lName') is-invalid @enderror" name="lName" value="{{ Auth::user()->lName }}" required autofocus>
                            @error('lName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Telepon') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" required autofocus>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-end mt-4">
                <input type="hidden" name="maxRoom" value="{{ $userInput['roomAvail'] }}">
                <input type="hidden" name="hotelId" value="{{ $hotel->id }}">
                <input type="hidden" name="roomId" value="{{ $room->id }}">
                <input type="hidden" name="checkIn" value="{{ $userInput['checkIn'] }}">
                <input type="hidden" name="checkOut" value="{{ $userInput['checkOut'] }}">
                <button id="submit" class="btn btn-primary mr-3" type="submit">Pesan Sekarang</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#checkIn').attr('min', new Date().toISOString().split("T")[0]);
    $('#checkOut').attr('min',  $('#checkIn').attr('min'));
    $('#checkIn').on('change', () => {
        $('#checkOut').attr('min',  $('#checkIn').val());
    })
</script>
@endsection
