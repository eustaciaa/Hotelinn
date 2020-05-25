@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="/admin/hotels/{{ $hotel->id }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <h4>Ubah Detail Hotel</h4>
                <div class="form-group">
                    <label for="name">{{ __('Nama Hotel') }}</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama hotel" value="{{ $hotel->name }}" />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="star">{{ __('Bintang') }}</label>
                    <input type="number" name="star" class="form-control @error('star') is-invalid @enderror" min="1" max="5" value="{{ $hotel->star }}" />
                    @error('star')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="rating">{{ __('Penilaian') }}</label>
                    <input type="number" name="rating" class="form-control @error('rating') is-invalid @enderror" min="1" max="10" value="{{ $hotel->rating }}" />
                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="reviewers">{{ __('Ulasan') }}</label>
                    <input type="number" name="reviewers" class="form-control @error('reviewers') is-invalid @enderror" value="{{ $hotel->reviewers }}"/>
                    @error('reviewers')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="photo">{{ __('Gambar Hotel') }}</label>
                    <input type="file" name="photo" class="@error('photo') is-invalid @enderror" value="{{ $hotel->photo }}"/>
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="submit" value="Ubah Hotel" />
                <a href="/admin/hotels" class="btn btn-primary mx-4">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection