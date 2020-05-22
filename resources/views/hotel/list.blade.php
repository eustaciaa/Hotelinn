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
                        <h6 class="card-text price"><strong>Rp{{number_format($room->cost,2,",",".")}} / malam</strong></h6>
                        <div class="row mt-3">
                            <div class="col-6">
                                <p><i class="mr-2 fas fa-bed"></i>  {{$room->capacity}}</p>
                            </div>
                            @if($room->freeWifi == true)
                                <div class="col-6">
                                    <p><i class="mr-2 fas fa-wifi"></i>  Wifi gratis</p>
                                </div>
                            @endif
                            @if($room->noSmoking == true)
                                <div class="col-6">
                                    <p><i class="mr-2 fas fa-smoking-ban"></i>  Bebas asap rokok</p>
                                </div>
                            @endif
                            <div class="col-6">
                                <p><i class="mr-2 fas fa-mountain"></i>  {{$room->scenery}}</p>
                            </div>
                        </div>
                        <a href="#moreFacilities" data-toggle="modal">
                            <small class="text-muted"><i class="fas fa-ellipsis-h mr-2"></i>Fasilitas lainnya</small>
                        </a>

                        <!-- moreFacilities Modal -->
                        <div class="modal fade" id="moreFacilities" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Fasilitas lainnya</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @if(!is_null($hotel->shower))
                                                <div class="col-6">
                                                    <h5>Kamar Mandi dan Perlengkapan Mandi</h5>
                                                    <p>{{$hotel->shower}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($hotel->food))
                                                <div class="col-6">
                                                    <h5>Makanan dan Minuman</h5>
                                                    <p>{{$hotel->food}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($hotel->entertainment))
                                                <div class="col-6">
                                                    <h5>Hiburan</h5>
                                                    <p>{{$hotel->entertainment}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($hotel->convenience))
                                                <div class="col-6">
                                                    <h5>Kenyamanan</h5>
                                                    <p>{{$hotel->convenience}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($hotel->furniture))
                                                <div class="col-6">
                                                    <h5>Tata Ruang dan Furnitur</h5>
                                                    <p>{{$hotel->furniture}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($hotel->service))
                                                <div class="col-6">
                                                    <h5>Layanan</h5>
                                                    <p>{{$hotel->service}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($hotel->laundry))
                                                <div class="col-6">
                                                    <h5>Pakaian dan Binatu</h5>
                                                    <p>{{$hotel->laundry}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($hotel->secuity_safety))
                                                <div class="col-6">
                                                    <h5>Keamanan dan Keselamatan</h5>
                                                    <p>{{$hotel->secuity_safety}}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        
                            @if ($room->available > 0)
                            <form method="get" action="/rent">
                                @csrf
                                <input type="hidden" id="hotelId" name="hotelId" value="{{$room->hotel_id}}">
                                <input type="hidden" id="roomId" name="roomId" value="{{$room->id}}">
                                <button type="submit" class="btn btn-primary mt-3">Check Room</button>
                            </form>
                            @else
                                <button type="submit" class="btn btn-secondary" disabled>Check Room</button>
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
        </div>
    </div>
</div>
@endsection
