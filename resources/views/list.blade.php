@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                @foreach ($alamats as $alamat)
                <div class="card my-5">
                    <div class="card-header justify-content-center">{{$alamat->hotel->name}}</div>
                    <div class="card-body">
                        <div class="row mx-1">
                            <div class="col-9">
                                <p>
                                    {{$alamat->hotel->rate}} Stars
                                    <br>
                                    {{$alamat->detailLengkap}}
                                    <br>
                                </p>
                            </div>
                            <form method="get" action="/rentHotel">
                            <input type="hidden" id="hotelId" name="hotelId" value="{{$alamat->hotel_id}}">
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary">Check Room</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

        </div>
    </div>
</div>
@endsection
