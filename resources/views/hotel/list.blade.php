@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @foreach ($rooms as $room)
            <div class="card my-5">
                <div class="card-header justify-content-center">{{$room->name}}</div>
                <div class="card-body">
                    <div class="row mx-1">
                        <div class="col-9">
                            <p>
                                {{$room->capacity}} Stars
                                <br>
                                {{$room->cost}}
                                <br>
                            </p>
                        </div>
                        @if ($room->available > 0)
                        <form method="get" action="/rent">
                            @csrf
                            <input type="hidden" id="hotelId" name="hotelId" value="{{$room->hotel_id}}">
                            <input type="hidden" id="roomId" name="roomId" value="{{$room->id}}">
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary">Check Room</button>
                            </div>
                        </form>
                        @else
                        <div class="col-1">
                            <button type="submit" class="btn btn-secondary" disabled>Check Room</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
