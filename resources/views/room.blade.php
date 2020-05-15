@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                @foreach ($roomdetails as $room)
                <div class="card my-5">
                    <div class="card-header justify-content-center">{{$room->hotel->name}}</div>
                    <div class="card-body">
                        <div class="row mx-1">
                            <div class="col-9">
                                <p>
                                    {{$room->name}}
                                    <br>
                                    {{$room->capacity}}
                                    <br>
                                    {{$room->cost}}
                                    <br>
                                </p>
                            </div>
                            <form method="get" action="/rentRoom">
                            <input type="hidden" id="roomId" name="roomId" value="{{$room->id}}">
                            <input type="hidden" id="hotelId" name="hotelId" value="{{$room->hotel_id}}">
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary">Rent Room</button>
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
