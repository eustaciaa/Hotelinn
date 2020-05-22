@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card my-5">
                <img class="card-img-top" src="{{$hotel->photo}}" alt="{{$hotel->photo}}">
                <div class="card-body">
                    <h3 class="card-title mb-0">{{ $hotel->name }}</h3>
                    @for ($i = 0; $i < $hotel->star; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    @if (is_null($hotel->rating))
                        <br><small class="text-muted my-2">Belum ada penilaian</small>
                    @else
                        <h5 class="my-2"><b>{{ $hotel->rating }}/10 </b>({{ $hotel->reviewers }} ulasan)</h6>
                    @endif
                    <p class="card-text">{{$hotel->detailLengkap}}</p>
                </div>
            </div>
            <h4>Penawaran Kamar</h4><br>
            @foreach ($rooms as $room)
                @if ($loop->first || ($loop->iteration-1)%2 == 0)
                    <div class="card-deck mb-4">
                @endif
                    <div class="card">
                        <img class="card-img-top" src="{{$room->photo}}" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">{{$room->name}}</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        @if ($room->available > 0)
                        <form method="get" action="/rent">
                            @csrf
                            <input type="hidden" id="hotelId" name="hotelId" value="{{$room->hotel_id}}">
                            <input type="hidden" id="roomId" name="roomId" value="{{$room->id}}">
                            <button type="submit" class="btn btn-primary">Check Room</button>
                        </form>
                        @else
                        <div class="col-1">
                            <button type="submit" class="btn btn-secondary" disabled>Check Room</button>
                        </div>
                        @endif
                        </div>
                    </div>
                @if ($loop->iteration%2 == 0)
                    </div>
                @elseif ($loop->last)
                    @for ($i = 0; $i < 2-($loop->count%2); $i++)
                        <div class="card" style="border: none; background-color: transparent;"></div>
                        </div>
                    @endfor
                @endif
            @endforeach
            <!-- @foreach ($rooms as $room)
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
                        
                    </div>
                </div>
            </div>
            @endforeach -->

        </div>
    </div>
</div>
@endsection
