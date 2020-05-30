@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-12">
        <h2 class="mt-3">Detail Kamar Hotel</h2>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @elseif (session('unstatus'))
            <div class="alert alert-danger">
                {{ __('Maaf terjadi kesalahan') }}
            </div>
        @endif
        <div class="card" style="width: 40rem;">
            <img src="{{ $room_detail->photo }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h3 class="card-title">{{ $room_detail->name }}</h3>
                @if (($room_detail->freeWifi) == 1)
                    <p class="my-2">WiFi Gratis &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: tersedia</p>
                @else
                    <p class="my-2">WiFi Gratis &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: tidak tersedia</p>
                @endif
                @if (($room_detail->noSmoking) == 1)
                    <p class="my-2">Area Merokok &nbsp&nbsp: tidak tersedia</p>
                @else
                    <p class="my-2">Area Merokok &nbsp&nbsp: tersedia</p>
                @endif
                <p class="my-2">Fasilitas &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </p>
                @if (is_null($room_detail->shower))
                @else
                    <small class="text-muted my-2">- {{ $room_detail->shower }}</small><br>
                @endif
                @if (is_null($room_detail->scenery))
                @else
                    <small class="text-muted my-2">- {{ $room_detail->scenery }}</small><br>
                @endif
                @if (is_null($room_detail->entertainment))
                @else
                    <small class="text-muted my-2">- {{ $room_detail->entertainment }}</small><br>
                @endif
                @if (is_null($room_detail->convenience))
                @else
                    <small class="text-muted my-2">- {{ $room_detail->convenience }}</small><br>
                @endif
                @if (is_null($room_detail->furniture))
                @else
                    <small class="text-muted my-2">- {{ $room_detail->furniture }}</small><br>
                @endif
                @if (is_null($room_detail->service))
                @else
                    <small class="text-muted my-2">- {{ $room_detail->service }}</small><br>
                @endif
                @if (is_null($room_detail->security_safety))
                @else
                    <small class="text-muted my-2">- {{ $room_detail->security_safety }}</small><br>
                @endif
                @if (is_null($room_detail->laundry))
                @else
                    <small class="text-muted my-2">- {{ $room_detail->laundry }}</small><br>
                @endif
                @if (is_null($room_detail->food))
                @else
                    <small class="text-muted my-2">- {{ $room_detail->food }}</small><br>
                @endif
                <a href="{{ $room_detail->id }}/edit" class="btn btn-primary mx-3 my-3">Ubah Kamar</a>
                <form action="{{ $room_detail->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger mx-3 my-3">Hapus Kamar</button>
                </form>
            </div>
        </div>
        <a href="/admin/rooms" class="btn btn-primary my-3">Kembali</a>
    </div>
</div>
@endsection