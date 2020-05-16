@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
<<<<<<< HEAD
            <form action="/rentHotel" method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="hotelId" value="{{$hotelId}}">
                        <select class="form-control" name="order" id="order">
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Sort</button>
                    </div>
                </div>
            </form>
=======

>>>>>>> fb91618c4f87c0abe708f14b37981d686b684929
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
