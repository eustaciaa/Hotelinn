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
                        <p>{{ $hotel->detailLengkap }}</p>
                        <a href="/admin/hotels/{{ $hotel->hotel->id }}" class="badge badge-info">Detail</a>
                        <a href="#" class="badge badge-info mx-1">Ubah Alamat</a>
                    </li>
                @endforeach
            </ul>
            <a href="/admin" class="btn btn-primary my-3">Kembali</a>
        </div>
    </div>
</div>
@endsection