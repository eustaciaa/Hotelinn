@extends('layouts.admin')

@section('item')
<script>
  function triggerClick(){
    document.querySelector('#input_photo').click();
  }

  function displayImage(e){
    if(e.files[0]){
      var reader = new FileReader();

      reader.onload = function(e){
        document.querySelector('#display_photo').setAttribute('src',e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
    }
  }
</script>

<div class="container my-5 mx-4">
    <h4>Tambah Kamar</h4><br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <form action="/admin/rooms/{{ $hotel->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group row d-flex justify-content-center px-4 pt-3">
                                <img src="/images/hotel/default-image.png" class="img-thumbnail" style="width:100%; object-fit: cover;" onclick="triggerClick()" id="display_photo"></img>
                            </div>
                            <div class="form-group row d-flex justify-content-center px-4">
                                <label for="photo">{{ __('Foto Kamar') }}</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file"  onchange="displayImage(this)" name="photo" id="input_photo" class="custom-file-input @error('photo') is-invalid @enderror" value="{{ old('photo') }}">
                                        <label class="custom-file-label" for="input_photo">Choose file</label>
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- <input type="file" name="photo" class="@error('photo') is-invalid @enderror" value="{{ old('photo') }}"/> -->
                                
                            </div>
                        </div>
                        <div class="col pl-4 pr-5 pt-2">
                            <div class="form-group row">
                                <label for="name">{{ __('Nama Kamar') }}</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="available">{{ __('Jumlah Kamar') }}</label>
                                <input type="number" name="available" class="form-control @error('available') is-invalid @enderror" min="1" max="10" value="{{ old('available') }}" />
                                @error('available')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="capacity">{{ __('Kapasitas Kamar') }}</label>
                                <input type="text" name="capacity" class="form-control @error('capacity') is-invalid @enderror" placeholder="2 kasur single.." value="{{ old('capacity') }}" />
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="cost">{{ __('Harga per Malam') }}</label>
                                <input type="number" name="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost') }}"/>
                                @error('cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card px-3 mb-4">
                <div class="card-body">
                    <h4 class="card-title my-3">Fasilitas</h4><br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="freeWifi">{{ __('Free WiFi') }}</label><br>
                                <input type="radio" id="ada" name="freeWifi" class="@error('freeWifi') is-invalid @enderror" value="1">
                                <label for="ada" class="mr-3">Yes</label>
                                <input type="radio" id="gada" name="freeWifi" class="@error('freeWifi') is-invalid @enderror" value="0">
                                <label for="gada">No</label>
                                @error('freeWifi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="noSmoking">{{ __('Bebas Asap Rokok') }}</label><br>
                                <input type="radio" id="iya" name="noSmoking" class="@error('noSmoking') is-invalid @enderror" value="1">
                                <label for="iya" class="mr-3">Yes</label>
                                <input type="radio" id="tidak" name="noSmoking" class="@error('noSmoking') is-invalid @enderror"  value="0">
                                <label for="tidak">No</label>
                                @error('noSmoking')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col pr-5">
                            <div class="form-group flex-column d-flex">
                                <label for="name">{{ __('Detail Fasilitas') }}</label>
                                <textarea type="text" name="shower" class="form-control @error('shower') is-invalid @enderror mb-3" placeholder="Fasilitas Kamar Mandi" value="{{ old('shower') }}">{{ old('shower') }}</textarea>
                                @error('shower')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <textarea type="text" name="scenery" class="form-control @error('scenery') is-invalid @enderror mb-3" placeholder="Fasilitas Pemandangan" value="{{ old('scenery') }}">{{ old('scenery') }}</textarea>
                                @error('scenery')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <textarea type="text" name="entertainment" class="form-control @error('entertainment') is-invalid @enderror mb-3" placeholder="Fasilitas Hiburan" value="{{ old('entertainment') }}">{{ old('entertainment') }}</textarea>
                                @error('entertainment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <textarea type="text" name="convenience" class="form-control @error('convenience') is-invalid @enderror mb-3" placeholder="Fasilitas Kenyamanan Kamar" value="{{ old('convenience') }}">{{ old('convenience') }}</textarea>
                                @error('convenience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <textarea type="text" name="furniture" class="form-control @error('furniture') is-invalid @enderror mb-3" placeholder="Fasilitas Perabotan Kamar" value="{{ old('furniture') }}">{{ old('furniture') }}</textarea>
                                @error('furniture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <textarea type="text" name="service" class="form-control @error('service') is-invalid @enderror mb-3" placeholder="Fasilitas Layanan Kamar" value="{{ old('service') }}">{{ old('service') }}</textarea>
                                @error('service')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <textarea type="text" name="security_safety" class="form-control @error('security_safety') is-invalid @enderror mb-3" placeholder="Fasilitas Keamanan Kamar" value="{{ old('security_safety') }}">{{ old('security_safety') }}</textarea>
                                @error('security_safety')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <textarea type="text" name="laundry" class="form-control @error('laundry') is-invalid @enderror mb-3" placeholder="Fasilitas Kebersihan Kamar" value="{{ old('laundry') }}">{{ old('laundry') }}</textarea>
                                @error('laundry')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <textarea type="text" name="food" class="form-control @error('food') is-invalid @enderror mb-3" placeholder="Fasilitas Makanan" value="{{ old('food') }}">{{ old('food') }}</textarea>
                                @error('food')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end px-3">
                <a href="/admin" class="btn btn-secondary mx-4">Batal</a>
                <input type="submit" class="btn btn-primary" value="Tambahkan Kamar" />
            </div>           
            </form>
        </div>
    </div>
</div>
@endsection