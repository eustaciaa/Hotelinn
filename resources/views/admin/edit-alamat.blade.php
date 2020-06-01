@extends('layouts.admin')

@section('item')
<div class="container my-5 mx-4">
    <h4>Ubah Alamat Hotel {{ $hotel->name }}</h4><br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4 px-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="/admin/hotels/alamat/{{ $hotel->id }}" method="POST" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                            <div class="form-group row pr-5">
                                <label for="provinsi_id">{{ __('Provinsi') }}</label>
                                <select name="provinsi_id" class="form-control @error('provinsi_id') is-invalid @enderror" id="provinsi">
                                    @foreach ($provinsis as $provinsi)
                                        @if($hotel->alamat->provinsi_id == $provinsi->id)
                                            <option value="{{ $provinsi->id }}" selected> {{ $provinsi->namaProvinsi }} </option>
                                        @else
                                            <option value="{{ $provinsi->id }}"> {{ $provinsi->namaProvinsi }} </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('provinsi_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col ">
                            <div class="form-group row pl-2">
                                <label for="kota_id">{{ __('Kota') }}</label>
                                <select name="kota_id" class="form-control @error('kota_id') is-invalid @enderror" id="kota">
                                    <option value="{{ $hotel->alamat->kota_id }}" selected> {{ $hotel->alamat->kota->namaKota }} </option>
                                </select>
                                @error('kota_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name">{{ __('Detail Alamat Hotel') }}</label>
                        <textarea name="detailLengkap" class="form-control @error('detailLengkap') is-invalid @enderror" value="{{ $hotel->alamat->detailLengkap }}" >{{ $hotel->alamat->detailLengkap }}
                        </textarea>
                        @error('detailLengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row justify-content-end px-3">
                <a href="/admin/hotels" class="btn btn-secondary mx-4">Batal</a>
                <input type="submit" class="btn btn-primary" value="Ubah Alamat Hotel" />
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