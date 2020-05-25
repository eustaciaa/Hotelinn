@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="card my-5">
                    <div class="card-header justify-content-center"><i>{{__('Booking Form')}}</i></div>
                    <div class="card-body">
                        <form action="/rentFinal" method="POST">
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
                                    <label for="checkIn" class="col-md-4 col-form-label text-md-right"><i>{{ __('Check In') }}</i></label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ date_format(date_create($formNeeds['checkIn']), 'j F Y') }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="checkOut" class="col-md-4 col-form-label text-md-right"><i>{{ __('Check Out') }}</i></label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ date_format(date_create($formNeeds['checkOut']), 'j F Y') }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jumlah" class="col-md-4 col-form-label text-md-right">{{ __('Jumlah') }}</label>

                                    <div class="col-md-6">
                                        <input id="jmlh" type="number" class="form-control" name="jmlh" value="{{ 1 }}" min="1" max="{{ $formNeeds['remainedRooms'] }}" required>
                                        <span class="badge badge-warning txt-lightblack transparent">
                                            <i class="fas fa-exclamation-circle mr-1"></i><b>Tersisa {{ $formNeeds['remainedRooms'] }} ruangan</b>
                                        </span>
                                        <br><small class="text-muted text-07"><b>Anda hanya dapat memesan paling banyak {{ $formNeeds['remainedRooms'] }} ruangan.</b></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <input type="hidden" value="{{ $formNeeds['checkIn'] }}" name="checkIn">
                                    <input type="hidden" value="{{ $formNeeds['checkOut'] }}" name="checkOut">
                                    <input type="hidden" name="hotelId" value="{{ $hotel->id }}">
                                    <input type="hidden" name="roomId" value="{{ $room->id }}">
                                    <input type="hidden" name="remainedRooms" value="{{ $formNeeds['remainedRooms'] }}">
                                    <button id="submit" class="btn btn-primary offset-md-4 " type="submit">Rent</button>
                                </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- <script>
    $('#checkIn').attr('min', new Date().toISOString().split("T")[0]);
</script> -->
@endsection
