@extends('layouts.admin')

@section('item')
<div class="container mt-4 mx-4">
    <div class="col-12">
        <h2 class="mt-3">Detail Kamar Hotel</h2><br>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @elseif (session('unstatus'))
            <div class="alert alert-danger">
                {{ __('Maaf terjadi kesalahan') }}
            </div>
        @endif
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ $room_detail->photo }}" class="card-img-top" alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="col">
                            <h3 class="card-title">{{ $room_detail->name }}</h3>
                            @if (($room_detail->freeWifi) == 1)
                                <p class="my-2">WiFi Gratis <i class="fas fa-check ml-1 text-success"></i></p>
                            @else
                                <p class="my-2">WiFi Gratis <i class="fas fa-times ml-1 text-danger"></i></p>
                            @endif
                            @if (($room_detail->noSmoking) == 1)
                                <p class="my-2">Bebas Asap Rokok <i class="fas fa-check ml-1 text-success"></i></p>
                            @else
                                <p class="my-2">Bebas Asap Rokok <i class="fas fa-times ml-1 text-danger"></i></p>
                            @endif
                            <p class="my-2">Kapasitas {{ $room_detail->capacity }}</p>
                            <p class="my-2">{{ $room_detail->scenery }}</p>
                        </div>
                        <div class="col d-inline-flex justify-content-end">
                            <div>
                                <a href="{{ $room_detail->id }}/edit" class="btn btn-primary mx-3"><i class="fas fa-edit mr-2"></i>Ubah</a>
                            </div>
                            <form action="{{ $room_detail->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-secondary mx-3"><i class="fas fa-trash-alt mr-2"></i>Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        @if(!is_null($room_detail->shower))
                            <div class="col-6 my-2">
                                <h5><i class="icon fas fa-shower mr-2"></i>Kamar Mandi dan Perlengkapan Mandi</h5>
                                <p>{{$room_detail->shower}}</p>
                            </div>
                        @endif
                        @if(!is_null($room_detail->food))
                            <div class="col-6 my-2">
                                <h5><i class="icon fas fa-utensils mr-2"></i>Makanan dan Minuman</h5>
                                <p>{{$room_detail->food}}</p>
                            </div>
                        @endif
                        @if(!is_null($room_detail->entertainment))
                            <div class="col-6 my-2">
                                <h5><i class="icon fas fa-tv mr-2"></i>Hiburan</h5>
                                <p>{{$room_detail->entertainment}}</p>
                            </div>
                        @endif
                        @if(!is_null($room_detail->convenience))
                            <div class="col-6 my-2">
                                <h5><i class="icon fas fa-fan mr-2"></i>Kenyamanan</h5>
                                <p>{{$room_detail->convenience}}</p>
                            </div>
                        @endif
                        @if(!is_null($room_detail->furniture))
                            <div class="col-6 my-2">
                                <h5><i class="icon fas fa-couch mr-2"></i>Tata Ruang dan Furnitur</h5>
                                <p>{{$room_detail->furniture}}</p>
                            </div>
                        @endif
                        @if(!is_null($room_detail->service))
                            <div class="col-6 my-2">
                                <h5><i class="icon fas fa-concierge-bell mr-2"></i>Layanan</h5>
                                <p>{{$room_detail->service}}</p>
                            </div>
                        @endif
                        @if(!is_null($room_detail->laundry))
                            <div class="col-6 my-2">
                                <h5><i class="icon fas fa-tshirt mr-2"></i>Pakaian dan Binatu</h5>
                                <p>{{$room_detail->laundry}}</p>
                            </div>
                        @endif
                        @if(!is_null($room_detail->secuity_safety))
                            <div class="col-6 my-2">
                                <h5><i class="icon fas fa-shield-alt mr-2"></i>Keamanan dan Keselamatan</h5>
                                <p>{{$room_detail->secuity_safety}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <a href="/admin/rooms" class="btn btn-primary my-3"><i class="fas fa-chevron-left mr-2"></i>Kembali</a>
    </div>
</div>
@endsection