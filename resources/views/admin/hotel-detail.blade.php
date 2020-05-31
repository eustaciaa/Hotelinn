@extends('layouts.admin')

@section('item')
<div class="container  mt-4 mx-4">
    <div class="row">
        <div class="col-10">
            <h2 class="mt-3">Detail Hotel</h2><br>

            <div class="card" style="width: 20rem;">
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
                    <a href="{{ $hotel->id }}/edit" class="btn btn-primary mx-3 my-3">Ubah Hotel</a>
                    <form action="{{ $hotel->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger mx-3 my-3">Hapus Hotel</button>
                    </form>
                </div>
            </div>
            <a href="/admin/hotels" class="btn btn-primary mx-3 my-3">Kembali</a>
        </div>
    </div>
</div>
@endsection