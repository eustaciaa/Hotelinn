@extends('layouts.admin')

@section('item')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="/admin/hotels/alamat/{{ $hotel->id }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <h4>Ubah Detail Hotel</h4>
                <div class="form-group">
                    <label for="namaProvinsi">{{ __('Provinsi') }}</label>
                    <select name="namaProvinsi" class="@error('namaProvinsi') is-invalid @enderror">
                        <option value="1">DKI Jakarta</option>
                        <option value="2">D.I Yogyakarta</option>
                        <option value="3">Banten</option>
                    </select>
                    @error('namaProvinsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="namaKota">{{ __('Kota') }}</label>
                    <select name="namaKota" class="@error('namaKota') is-invalid @enderror">
                        <option value="1">Jakarta</option>
                        <option value="2">Yogyakarta</option>
                        <option value="3">Tangerang</option>
                        <option value="4">Tangerang Selatan</option>
                        <option value="5">Serang</option>
                    </select>
                    @error('namaKota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">{{ __('Alamat Detail Hotel') }}</label>
                    <input type="text" name="detailLengkap" class="form-control @error('detailLengkap') is-invalid @enderror" value="{{ $hotel->alamat->detailLengkap }}" />
                    @error('detailLengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="submit" value="Ubah Alamat Hotel" />
                <a href="/admin/hotels" class="btn btn-primary mx-4">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection