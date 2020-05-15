@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="card my-5">
                    <div class="card-header justify-content-center">{{__('Rent Details')}}</div>
                    <div class="card-body">
                        <form action="/rentFinal" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="fname" type="text" class="form-control" name="fName" value="{{ Auth::user()->fName }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="Lname" type="text" class="form-control" name="fName" value="{{ Auth::user()->lName }}" required autofocu>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="checkIn" class="col-md-4 col-form-label text-md-right">{{ __('Check In') }}</label>

                                    <div class="col-md-6">
                                        <input id="checkIn" type="date" class="form-control" name="checkIn" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="checkIn" class="col-md-4 col-form-label text-md-right">{{ __('Check In') }}</label>

                                    <div class="col-md-6">
                                        <input id="checkOut" type="date" class="form-control" name="checkOut" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="Jumlah" class="col-md-4 col-form-label text-md-right">{{ __('Jumlah') }}</label>

                                    <div class="col-md-6">
                                        <input id="jmlh" type="number" class="form-control" name="jmlh" value="{{ 1 }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <input type="hidden" name="hotelId" value="{{ $hotel->id }}">
                                    <input type="hidden" name="roomId" value="{{ $room->id }}">
                                    <button id="submit" class="btn btn-primary offset-md-4 " type="submit">Rent</button>
                                </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
