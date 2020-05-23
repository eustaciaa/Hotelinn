@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card my-5">
                <img class="card-img-top" src="{{$hotel->hotel->photo}}" alt="{{$hotel->hotel->photo}}">
                <div class="card-body">
                    <h3 class="card-title mb-0">{{ $hotel->hotel->name }}</h3>
                    @for ($i = 0; $i < $hotel->hotel->star; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    @if (is_null($hotel->hotel->rating))
                        <br><small class="text-muted my-2">Belum ada penilaian</small>
                    @else
                        <h5 class="my-2"><b>{{ $hotel->hotel->rating }}/10 </b>({{ $hotel->hotel->reviewers }} ulasan)</h6>
                    @endif
                    <span class="badge badge-light txt-lightblack text-uppercase"><i class="fas fa-map-marker-alt mr-1"></i>{{ $hotel->kota->namaKota }}, {{ $hotel->provinsi->namaProvinsi }}</span>
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
                                <p><i class="mr-2 icon fas fa-bed"></i>  {{$room->capacity}}</p>
                            </div>
                            @if($room->freeWifi == true)
                                <div class="col-6">
                                    <p><i class="mr-2 icon fas fa-wifi"></i>  Wifi gratis</p>
                                </div>
                            @endif
                            @if($room->noSmoking == true)
                                <div class="col-6">
                                    <p><i class="mr-2 icon fas fa-smoking-ban"></i>  Bebas asap rokok</p>
                                </div>
                            @endif
                            <div class="col-6">
                                <p><i class="mr-2 icon fas fa-mountain"></i>  {{$room->scenery}}</p>
                            </div>
                        </div>
                        <a href="#{{str_replace(' ', '', $room->name)}}" data-toggle="modal">
                            <small class="text-muted"><i class="fas fa-ellipsis-h mr-2"></i>Fasilitas lainnya</small>
                        </a>

                        <!-- moreFacilities Modal -->
                        <div class="modal fade" id="{{str_replace(' ', '', $room->name)}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                            @if(!is_null($room->shower))
                                                <div class="col-6 my-2">
                                                    <h5><i class="icon fas fa-shower mr-2"></i>Kamar Mandi dan Perlengkapan Mandi</h5>
                                                    <p>{{$room->shower}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($room->food))
                                                <div class="col-6 my-2">
                                                    <h5><i class="icon fas fa-utensils mr-2"></i>Makanan dan Minuman</h5>
                                                    <p>{{$room->food}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($room->entertainment))
                                                <div class="col-6 my-2">
                                                    <h5><i class="icon fas fa-tv mr-2"></i>Hiburan</h5>
                                                    <p>{{$room->entertainment}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($room->convenience))
                                                <div class="col-6 my-2">
                                                    <h5><i class="icon fas fa-fan mr-2"></i>Kenyamanan</h5>
                                                    <p>{{$room->convenience}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($room->furniture))
                                                <div class="col-6 my-2">
                                                    <h5><i class="icon fas fa-couch mr-2"></i>Tata Ruang dan Furnitur</h5>
                                                    <p>{{$room->furniture}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($room->service))
                                                <div class="col-6 my-2">
                                                    <h5><i class="icon fas fa-concierge-bell mr-2"></i>Layanan</h5>
                                                    <p>{{$room->service}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($room->laundry))
                                                <div class="col-6 my-2">
                                                    <h5><i class="icon fas fa-tshirt mr-2"></i>Pakaian dan Binatu</h5>
                                                    <p>{{$room->laundry}}</p>
                                                </div>
                                            @endif
                                            @if(!is_null($room->secuity_safety))
                                                <div class="col-6 my-2">
                                                    <h5><i class="icon fas fa-shield-alt mr-2"></i>Keamanan dan Keselamatan</h5>
                                                    <p>{{$room->secuity_safety}}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
