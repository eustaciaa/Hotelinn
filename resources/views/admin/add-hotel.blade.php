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
    <h4>Tambah Hotel</h4>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{route('post.add-hotel')}}" method="POST" enctype="multipart/form-data">
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
                            </div>
                        </div>
                        <div class="col pl-4 pr-5 pt-2">
                            <div class="form-group row">
                                <label for="name">{{ __('Nama Hotel') }}</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama hotel" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="star">{{ __('Bintang') }}</label>
                                <input type="number" name="star" class="form-control @error('star') is-invalid @enderror" min="1" max="5" value="{{ old('star') }}" />
                                @error('star')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 px-3">
                <div class="card-body">
                    <h4 class="card-title my-3">Alamat</h4><br>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="provinsi_id">{{ __('Provinsi') }}</label>
                                <select name="provinsi_id" class="form-control @error('provinsi_id') is-invalid @enderror" id="provinsi">
                                    @foreach ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id }}"> {{ $provinsi->namaProvinsi }} </option>
                                    @endforeach
                                </select>
                                @error('namaProvinsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="kota_id">{{ __('Kota') }}</label>
                                <select name="kota_id" class="form-control @error('kota_id') is-invalid @enderror" id="kota">
                                </select>
                                @error('namaKota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row px-3">
                        <label for="detailLengkap">{{ __('Alamat Lengkap') }}</label>
                        <textarea name="detailLengkap" class="form-control @error('detailLengkap') is-invalid @enderror" placeholder="Masukkan nama jalan atau daerah" value="{{ old('detailLengkap') }}"></textarea>
                        @error('detailLengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row justify-content-end px-3">
                <a href="/admin" class="btn btn-secondary mx-4">Batal</a>
                <input type="submit"  class="btn btn-primary" value="Tambahkan Hotel" />     
                </form>
            </div>
        </div>
    </div>
</div>
<script>
   $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/getKota',
        data: { provinsi: 'all' },
        success: function (result) {
            var result = JSON.parse(result);
            console.log(result);
            result.forEach(element => {

                $("#kota").append('<option value=' + element.id + '>' + element.namaKota + '</option>');

            });
        }
    });
    $("#provinsi").change(function () {
        var provinsi = $('#provinsi').val()
        console.log(provinsi);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/getKota',
            data: { provinsi: provinsi },
            success: function (result) {
                var result = JSON.parse(result);
                console.log(result);
                $("#kota option").remove();
                result.forEach(element => {

                    $("#kota").append('<option value=' + element.id + '>' + element.namaKota + '</option>');

                });
            }
        });
    });
   })
</script>
@endsection