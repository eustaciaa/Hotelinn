@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="/admin/rooms/{{ $room_detail->id }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <h4>Ubah Detail Kamar Hotel</h4>
                <div class="form-group">
                    <label for="name">{{ __('Nama Kamar') }}</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama hotel" value="{{ $room_detail->name }}" />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="available">{{ __('Jumlah Kamar') }}</label>
                    <input type="number" name="available" class="form-control @error('available') is-invalid @enderror" min="1" max="10" value="{{ $room_detail->available }}" />
                    @error('available')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="capacity">{{ __('Kapasitas Kamar') }}</label>
                    <input type="text" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ $room_detail->capacity }}" />
                    @error('capacity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cost">{{ __('Harga per Kamar') }}</label>
                    <input type="number" name="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ $room_detail->cost }}"/>
                    @error('cost')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="photo">{{ __('Gambar Kamar') }}</label>
                    <input type="file" name="photo" class="@error('photo') is-invalid @enderror" value="{{ $room_detail->photo }}"/>
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="freeWifi">{{ __('WiFi') }}</label><br>
                    <input type="radio" id="ada" name="freeWifi" class="@error('freeWifi') is-invalid @enderror" value="1">
                    <label for="ada">Yes</label>
                    <input type="radio" id="gada" name="freeWifi" class="@error('freeWifi') is-invalid @enderror" value="0">
                    <label for="gada">No</label>
                    @error('freeWifi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="noSmoking">{{ __('Area Merokok') }}</label><br>
                    <input type="radio" id="iya" name="noSmoking" class="@error('noSmoking') is-invalid @enderror" value="0">
                    <label for="iya">Yes</label>
                    <input type="radio" id="tidak" name="noSmoking" class="@error('noSmoking') is-invalid @enderror"  value="1">
                    <label for="tidak">No</label>
                    @error('noSmoking')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">{{ __('Fasilitas') }}</label>
                    <input type="text" name="shower" class="form-control @error('shower') is-invalid @enderror" placeholder="Fasilitas Kamar Mandi" value="{{ $room_detail->shower }}" />
                    @error('shower')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="text" name="scenery" class="form-control @error('scenery') is-invalid @enderror" placeholder="Fasilitas Pemandangan" value="{{ $room_detail->scenery }}" />
                    @error('scenery')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="text" name="entertainment" class="form-control @error('entertainment') is-invalid @enderror" placeholder="Fasilitas Hiburan" value="{{ $room_detail->entertainment }}" />
                    @error('entertainment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="text" name="convenience" class="form-control @error('convenience') is-invalid @enderror" placeholder="Fasilitas Kenyamanan Kamar" value="{{ $room_detail->convenience }}" />
                    @error('convenience')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="text" name="furniture" class="form-control @error('furniture') is-invalid @enderror" placeholder="Fasilitas Perabotan Kamar" value="{{ $room_detail->furniture }}" />
                    @error('furniture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="text" name="service" class="form-control @error('service') is-invalid @enderror" placeholder="Fasilitas Layanan Kamar" value="{{ $room_detail->service }}" />
                    @error('service')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="text" name="security_safety" class="form-control @error('security_safety') is-invalid @enderror" placeholder="Fasilitas Keamanan Kamar" value="{{ $room_detail->security_safety }}" />
                    @error('security_safety')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="text" name="laundry" class="form-control @error('laundry') is-invalid @enderror" placeholder="Fasilitas Kebersihan Kamar" value="{{ $room_detail->laundry }}" />
                    @error('laundry')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="text" name="food" class="form-control @error('food') is-invalid @enderror" placeholder="Fasilitas Makanan" value="{{ $room_detail->food }}" />
                    @error('food')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="submit" value="Ubah Hotel" />
                <a href="/admin/rooms" class="btn btn-primary mx-4">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection