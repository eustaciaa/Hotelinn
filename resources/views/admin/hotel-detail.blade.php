@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-3">Detail Hotel</h1>

            <div class="card" style="width: 18rem;">
                <img src="{{ $hotel->photo }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $hotel->name }}</h5>
                    @for ($i = 0; $i < $hotel->star; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    <i href="#" class="bi bi-building" style="width:20px" fill="currentColor"></i>
                    @if (is_null($hotel->rating))
                        <br><small class="text-muted my-2">Belum ada penilaian</small>
                    @else
                        <p class="my-2"><b>{{ $hotel->rating }}/10 </b>({{ $hotel->reviewers }} ulasan)</p>
                    @endif<br>
                    <button type="submit" class="btn btn-primary my-1">Ubah Hotel</button>
                    <button type="submit" class="btn btn-danger mx-3">Hapus Hotel</button>
                    <a href="/admin/hotels" class="btn btn-primary my-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection