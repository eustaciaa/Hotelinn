@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success my-5">
                {{ session('success') }}
                Klik <a href="/history"
                        onclick="event.preventDefault();
                                document.getElementById('history-form').submit();">di sini</a>
                untuk menuju ke Riwayat Pemesanan Anda.
            </div>
            <form id="history-form" action="/history" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
@endif
<div class="slider fade">
    <div class="load"></div>
    <div class="content">
        @if (session('success'))
        <div class="principal" style="top: 60%;">
        @else
        <div class="principal" style="top: 40%;">
        @endif
            <h1>Bingung mau nginep di mana?<br><b>hotelinn</b> aja.</h1>
        </div>
    </div>
</div>
<div class="bg-lightblue">
    <div class="container">
        <div class="row justify-content-center" id="searchRow">
            <div class="col-md-8 my-5">
                <form>
                    <div class="row justify-content-center mb-5">
                        <div class="col">
                            <label for="checkIn" class="col-form-label text-md-right"><i>{{ __('Check In') }}</i></label>
                            <input id="checkOut" type="date" class="form-control" name="checkIn">
                        </div>
                        <div class="col">
                            <label for="checkIn" class="col-form-label text-md-right"><i>{{ __('Check Out') }}</i></label>
                            <input id="checkOut" type="date" class="form-control" name="checkOut">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <select class="form-control" name="provinsiId" id="provinsi">
                                <option value="all" selected> Pilih provinsi </option>
                                @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->id }}"> {{ $provinsi->namaProvinsi }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="kotaId" id="kota">
                                <option value="null"> Pilih kota </option>
                            </select>
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="search">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class='row justify-content-center' >
        <div class='col-md-9' id='hotel-row'>
            @foreach($hotels as $hotel)
            <div class="card my-5 card-hotel" style="height=25vh;">
                <div class="row no-gutters">
                    <div class="col-md-5">
                    <img src="{{$hotel->hotel->photo}}" style="height:100%; object-fit: cover;" class="card-img" alt="{{$hotel->hotel->photo}}">
                    </div>
                    <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title mb-0">{{ $hotel->hotel->name }}</h5>
                        @for ($i = 0; $i < $hotel->hotel->star; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        @if (is_null($hotel->hotel->rating))
                            <br><small class="text-muted my-2">Belum ada penilaian</small><br>
                        @else
                            <h5 class="my-2"><b>{{ $hotel->hotel->rating }}/10 </b>({{ $hotel->hotel->reviewers }} ulasan)</h6>
                        @endif
                        <span class="badge badge-light txt-lightblack text-uppercase transparent"><i class="fas fa-map-marker-alt mr-1"></i>{{ $hotel->kota->namaKota }}, {{ $hotel->provinsi->namaProvinsi }}</span>
                        <p class="card-text">{{$hotel->detailLengkap}}</p>
                        <div class="row justify-content-start">
                            <form method="get" action="/showRoom">
                                @csrf
                            <input type="hidden" id="hotelId" name="hotelId" value="{{$hotel->hotel->id}}">
                            <button type="submit" class="btn btn-primary ml-3">
                                Lihat Detail
                            </button>
                            </form>
                        </div>
                    </div>
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
                        var div = "<div class='card my-5 card-hotel' style='height=25vh;'>" +
                              '<div class="row no-gutters">'+
                              '<div class="col-md-5">'+
                              '<img src="'+hotel.photo+'" style="height:100%; object-fit: cover;" class="card-img" alt="No Photo">'+
                              '</div>'+
                              '<div class="col-md-7">'+
                              '<div class="card-body">'+
                              '<h5 class="card-title mb-0">'+hotel.name+'</h5>';
                              for(var i = 0; i < hotel.star; i++){
                                div += ' <i class="fas fa-star"></i>';
                              }
                              if(hotel.rating == null) div+= '<br><small class="text-muted my-2">Belum ada penilaian</small>';
                              else div+= '<h5 class="my-2"><b>'+hotel.rating+'/10 </b>('+hotel.reviewers+'ulasan)</h6>'
                              div +='<p class="card-text">'+hotel.detailLengkap+'</p>'+
                              '<div class="row justify-content-start">'+
                              '<form method="get" action="/showRoom">'+
                              ' <form method="get" action="/showRoom">@csrf'+
                              '<input type="hidden" id="hotelId" name="hotelId" value="'+hotel.id+'">'+
                              '<button type="submit" class="btn btn-primary ml-3">ShowRoom</button>'+
                              '</form></div></div></div></div></div>'
                        $('#hotel-row').append(div);
                    })

                }
            })
        });
    });

</script>
@endsection
