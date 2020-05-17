@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success mt-5">
                {{ session('success') }}
                Klik <a href="/history" 
                        onclick="event.preventDefault();
                                document.getElementById('history-form').submit();">disini</a> 
                untuk menuju ke Riwayat Pemesanan Anda.
            </div>
            <form id="history-form" action="/history" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
@endif
<!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <div class="d-block h-100" style="background-image: url('{{ asset('images/login/viceroy-bali-tonedowned.jpg') }}');"></div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="" alt="Third slide">
    </div>
  </div>
</div>
<script type="text/javascript">
    $('.carousel').carousel();
</script> -->
<div class="container">
    <div class="row justify-content-center" id="searchRow">
        <div class="col-md-8">
              
            <div class="card my-5 content-wrapper">
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
                        <form method="get" action="/rentHotel">
                        <input type="hidden" id="hotelId" name="hotelId" value="{{$hotel->hotel->id}}">
                        <button type="submit" class="btn btn-primary show-room" action="rentHotel" id="hotel{{$hotel->hotel->id}}">Show
                            Room</button>
                        </form>
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
