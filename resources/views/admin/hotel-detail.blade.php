@extends('layouts.admin')

@section('item')
<div class="container mt-4 mx-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mt-3">Detail Hotel</h2><br>

            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ $hotel->photo }}" class="card-img-top" alt="{{ $hotel->photo }}" style="height:100%; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="col">
                                <h3 class="card-title">{{ $hotel->name }}</h3>
                                @for ($i = 0; $i < $hotel->star; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                <i href="#" class="bi bi-building" style="width:20px" fill="currentColor"></i>
                                @if (is_null($hotel->rating))
                                    <br><small class="text-muted my-2">Belum ada penilaian</small>
                                @else
                                    <p class="my-2"><b>{{ $hotel->rating }}/10 </b>({{ $hotel->reviewers }} Penilaian)</p>
                                @endif<br>

                            </div>
                            <div class="col d-inline-flex justify-content-end">
                                <div>
                                    <a href="{{ $hotel->id }}/edit" class="btn btn-primary mx-3"><i class="fas fa-edit mr-2"></i>Ubah</a>
                                </div>
                                <form action="{{ $hotel->id }}" method="post" class="d-inline">
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
            <a href="/admin/hotels" class="btn btn-primary my-3"><i class="fas fa-chevron-left mr-2"></i>Kembali</a>
        </div>
    </div>
</div>
@endsection
