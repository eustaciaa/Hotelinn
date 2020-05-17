@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="searchRow">
        <div class="col-md-8">
            <div class="card my-5">
                <div class="card-header">Search For Hotel</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label for="provinsi" class="col-md-4 col-form-label text-md-right">Provinsi</label>

                        <div class="col-md-6">
                            <select class="form-control" name="provinsiId" id="provinsi">
                                <option value="all" selected> Pilih... </option>
                                @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->id }}"> {{ $provinsi->namaProvinsi }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kota" class="col-md-4 col-form-label text-md-right">Kota</label>

                        <div class="col-md-6">
                            <select class="form-control" name="kotaId" id="kota">
                                <option value="null"> Pilih.. </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" id="search">
                                Search
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class='row justify-content-center' >
        <div class='col-md-8' id='hotel-row'>
            @foreach($hotels as $hotel)
            <div class='card my-5 card-hotel'>
                <div class='card-header'>{{ $hotel->hotel->name }}</div>
                <div class="card-body">
                    <div class="row">
                        <p class="mx-3">
                            {{$hotel->detailLengkap}}
                        </p>
                    </div>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-primary show-room" id="hotel{{$hotel->hotel->id}}">Show
                            Room</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

<script>
    $( document ).ready(function() {
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
        });
        $.ajax({
            type: 'POST',
            url: '/getKota',
            data: { provinsi: 'all'},
            success: function(result) {
                var result = JSON.parse(result);
                console.log(result);
                result.forEach(element => {

                    $( "#kota" ).append('<option value=' + element.id + '>' + element.namaKota + '</option>');

                });
            }
        });
        $( "#provinsi" ).change(function() {
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
            success: function(result) {
                var result = JSON.parse(result);
                console.log(result);
                $( "#kota option" ).remove();
                $( '#kota').append( '<option value="null"> Pilih... </option>')
                result.forEach(element => {

                    $( "#kota" ).append('<option value=' + element.id + '>' + element.namaKota + '</option>');

                });
            }
        });
        });
        $( '#search' ).on('click', function (){
            var provinsiId = $('#provinsi').val();
            var kotaId = $("#kota").val();
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
            });
            $.ajax({
                type: 'GET',
                url: '/getHotel',
                data: { provinsiId: provinsiId, kotaId: kotaId},
                success: (result) => {
                    result = JSON.parse(result);
                    $( '.card-hotel').remove();
                    result.forEach(hotel => {
                        $('#hotel-row').append(
                              "<div class='card my-5 card-hotel'>" +
                              "<div class='card-header'>"+hotel.name+"</div>"+
                              '<div class="card-body"><div class="row">'+
                              '<p class="mx-3">'+hotel.detailLengkap+'</p></div>' +
                              '<div class="row justify-content-center">'+
                              '<button type="button" class="btn btn-primary show-room" id="hotel'+hotel.id+'">Show Room</button>'+
                              '</div></div></div></div></div>');
                    })

                }
            })
        });
        $( '.show-room' ).on('click', function (){
            var hotelId = $('.showroom').attr("id").replace('hotel',"");
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
            });
            $.ajax({
                type: 'POST',
                url: '/getRoom',
                data: { provinsiId: hotelId},
                success: (result) => {
                    console.log(result);
                }
            })
        })
    });

</script>
@endsection
