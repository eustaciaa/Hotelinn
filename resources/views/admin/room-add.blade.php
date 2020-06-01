@extends('layouts.admin')

@section('item')
<div class="container my-5 mx-4">
    <h4>Tambah Hotel</h4>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{route('post.add-room')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group row d-flex justify-content-center px-4 pt-3">
                                <img src="/images/hotel/default-image.png" class="img-thumbnail" style="width:100%; object-fit: cover;" onclick="triggerClick()" id="display_photo"></img>
                            </div>
                            <label for="photo">{{ __('Foto Kamar') }}</label>
                            <div class="input-group mb-3">
                                <div class="form-group row d-flex justify-content-center px-4">
                                <div class="custom-file">
                                        <input type="file"  onchange="displayImage(this)" name="photo" id="input_photo" class="custom-file-input @error('photo') is-invalid @enderror" value="{{ old('photo') }}">
                                        <label class="custom-file-label" for="input_photo">Choose file</label>
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4"></div>

                <div class="form-group">
                    <label for="name">{{ __('Nama Hotel') }}</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama hotel" value="{{ old('name') }}" />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="star">{{ __('Bintang') }}</label>
                    <input type="number" name="star" class="form-control @error('star') is-invalid @enderror" min="1" max="5" value="{{ old('star') }}" />
                    @error('star')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="rating">{{ __('Penilaian') }}</label>
                    <input type="text" name="rating" class="form-control @error('rating') is-invalid @enderror" min="1" max="10" placeholder="Masukkan penilaian berupa angka" value="{{ old('rating') }}" />
                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="reviewers">{{ __('Penilaian') }}</label>
                    <input type="number" name="reviewers" class="form-control @error('reviewers') is-invalid @enderror" value="{{ old('reviewers') }}"/>
                    @error('reviewers')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="photo">{{ __('Gambar Hotel') }}</label>
                    <input type="file" name="photo" class="@error('photo') is-invalid @enderror" value="{{ old('photo') }}"/>
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <h4>Alamat</h4>
                <div class="form-group">
                    <label for="namaProvinsi">{{ __('Provinsi') }}</label>
                    <select name="namaProvinsi" class="@error('namaProvinsi') is-invalid @enderror">
                        <option value="DKI Jakarta">DKI Jakarta</option>
                        <option value="D.I Yogyakarta">D.I Yogyakarta</option>
                        <option value="Banten">Banten</option>
                    </select>
                    @error('namaProvinsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="namaKota">{{ __('Kota') }}</label>
                    <select name="namaKota" class="@error('namaKota') is-invalid @enderror">
                        <option value="Jakarta">Jakarta</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                        <option value="Tangerang">Tangerang</option>
                        <option value="Tangerang Selatan">Tangerang Selatan</option>
                        <option value="Serang">Serang</option>
                    </select>
                    @error('namaKota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="detailLengkap">{{ __('Alamat Lengkap') }}</label>
                    <input type="text" name="detailLengkap" class="form-control @error('detailLengkap') is-invalid @enderror" placeholder="Masukkan nama jalan atau daerah" value="{{ old('detailLengkap') }}"/>
                    @error('detailLengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <input type="submit" value="Tambahkan Hotel" />
                <a href="/admin" class="btn btn-primary mx-4">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
