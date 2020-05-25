@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-3">Daftar Hotel</h1>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <ul class="list-group">
                @foreach ($hotels as $hotel)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <h5 class="mb-1">{{ $hotel->hotel->name }}</h5>
                        <a href="/admin/hotels/{{ $hotel->hotel->id }}" class="badge badge-info">Detail</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small class="mb-1">{{ $hotel->detailLengkap }}</small>
                        <a href="/admin/hotels/alamat/{{ $hotel->hotel->id }}/edit" class="badge badge-info">Ubah Alamat</a>
                    </li>
                @endforeach
            </ul>
            <a href="/admin" class="btn btn-primary my-3">Kembali</a>
        </div>
    </div>
</div>
@endsection