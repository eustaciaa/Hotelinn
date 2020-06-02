@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success my-5">
                {{ session('success') }} Silahkan cek e-mail Anda atau
                klik <a href="/history" onclick="event.preventDefault();
                                    document.getElementById('history-form').submit();">di sini</a>
                untuk menuju ke Riwayat Pemesanan Anda.
            </div>
            <form id="history-form" action="/history" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
@elseif(session('fail'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger my-5">
                {{ session('fail') }}
            </div>
        </div>
    </div>
</div>
@endif
<div class="slider fade">
    <div class="load"></div>
    <div class="content">
        @if (session('success') || session('fail'))
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

                    <div class="row justify-content-center mb-3">
                        <div class="col text-center">
                            <h4>Mau nginep di mana?</h4>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-2">
                        <div class="col text-center">
                            <form action="/searchBox" method="GET" id="searchForm">
                                <input type="text" class="form-control" name="query" id="searchBox"
                                    placeholder="Nama hotel, Provinsi, Kota.." autocomplete="off">
                            </form>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-4 col-sm-12">
                            <select class="form-control" name="provinsiId" id="provinsi">
                                <option value="all" selected> Pilih provinsi </option>
                                @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->id }}"> {{ $provinsi->namaProvinsi }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <select class="form-control" name="kotaId" id="kota">
                                <option value="all" selected> Pilih kota </option>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <select class="form-control" name="orderBy" id="orderBy">
                                <option value="none" selected> Urutkan Berdasarkan </option>
                                <optgroup label="Rating">
                                    <option value="rating asc">Terendah - Tertinggi</option>
                                    <option value="rating desc">Tertinggi - Terendah</option>
                                <optgroup label="Bintang">
                                    <option value="star asc">Terendah - Tertinggi</option>
                                    <option value="star desc">Tertinggi - Terendah</option>
                                <optgroup label="Harga">
                                    <option value="cost asc">Terendah - Tertinggi</option>
                                    <option value="cost desc">Tertinggi - Terendah</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-4">
                            <select class="form-control" name="filterBy" id="filterBy">
                                <option value="none" selected>Filter Berdasarkan</option>
                                <option value="cost">Harga</option>
                                <option value="rating">Rating</option>
                            </select>
                        </div>
                        <div class="col-md-1 d-flex align-items-end pl-3">
                            <label for="min" class="form-label">Dari</label>
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="number" name="min" id="min" min="0" value="0">
                        </div>
                        <div class="col-md-1 d-flex align-items-end pl-3">
                            <label for="max" class="form-label">Sampai</label>
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="number" name="max" id="max" max="0" value="0">
                        </div>
                    </div>
                    <div class="row text-center mb-2">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="search">
                                Cari
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class='row justify-content-center'>
            <div class='col-md-9' id='hotel-row'>
                @foreach($hotels as $hotel)
                <div class="card my-5 card-hotel" style="height=25vh;">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <img src="{{$hotel->hotel->photo}}" style="height:100%; object-fit: cover;" class="card-img"
                                alt="{{$hotel->hotel->photo}}">
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
                                    <h5 class="my-2"><b>{{ $hotel->hotel->rating }}/10
                                        </b>({{ $hotel->hotel->reviewers }} Penilaian)</h6>
                                        @endif
                                        <span class="badge badge-light txt-lightblack text-uppercase transparent"><i
                                                class="fas fa-map-marker-alt mr-1"></i>{{ $hotel->kota->namaKota }},
                                            {{ $hotel->provinsi->namaProvinsi }}</span>
                                        <p class="card-text">{{$hotel->detailLengkap}}</p>
                                        <div class="row justify-content-start">
                                            <form method="get" action="/showRoom">
                                                @csrf
                                                <input type="hidden" id="hotelId{{$hotel->hotel->id}}" name="hotelId"
                                                    value="{{$hotel->hotel->id}}">
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

    <script src="{{ asset('js/typeahead.jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {

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
    $('#searchBox').typeahead({
        source: function (query, process) {
            return $.ajax({
                type: 'GET',
                url: '/searchBox',
                data: { query: this.query },
                success: function (result) {
                    result = JSON.parse(result);
                    console.log(result);
                    process(result);
                    customwidth();
                }
            })},
            displayText: function(item) {
                if(item.provinsi) return item.provinsi
                else if (item.kota) return item.kota
                else if (item.hotel) return item.hotel
            },
            afterSelect: function(item){
                console.log(item);
                ajaxCallSearch(item);
            }
            ,
            autoSelect: true
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
                $('#kota').append('<option value="all" selected> Pilih kota </option>')
                result.forEach(element => {

                    $("#kota").append('<option value=' + element.id + '>' + element.namaKota + '</option>');

                });
            }
        });
    });
    $('#filterBy').on('change',() => {
        var filterType = $("#filterBy").val();
        var provinsiId = $('#provinsi').val();
        var kotaId = $("#kota").val();
        $('#min').val(0)
        $('#max').val(0)
        console.log(filterType)
        filterType == "cost" ? url = "/minMaxCost" : url = "/minMaxRating";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: url,
            data: { provinsiId: provinsiId, kotaId: kotaId },
            success: (result) => {
                result = JSON.parse(result);
                console.log(result);
                console.log(result[0].max);
                $('#max').attr('max',result[0].max)

            }
        })
    });
    $('#search').on('click', function () {
        var provinsiId = $('#provinsi').val();
        var kotaId = $("#kota").val();
        var orderBy = $("#orderBy").val();
        var hotelId = "all";
        var order = orderBy.split(" ");
        var field = order[0];
        var order = order[1];
        var filter = $('#filterBy').val()
        var min = $("#min").val()
        var max = $("#max").val()
        if (order == undefined) {
            order = "none";
        }
        console.log(field, order);
        var checkIn = $('#checkIn').val();
        var checkOut = $('#checkOut').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/getHotel',
            data: { provinsiId: provinsiId, kotaId: kotaId, field: field, order: order, hotelId: hotelId, filter: filter, min:min, max:max},
            success: (result) => {
                result = JSON.parse(result);
                $('.card-hotel').remove();
                console.log(result);
                result.forEach(hotel => {
                    // console.log(hotel);
                    let div = "<div class='card my-5 card-hotel' style='height=25vh;'>" +
                        '<div class="row no-gutters">' +
                        '<div class="col-md-5">' +
                        '<img src="' + hotel.photo + '" style="height:100%; object-fit: cover;" class="card-img" alt="No Photo">' +
                        '</div>' +
                        '<div class="col-md-7">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title mb-0">' + hotel.name + '</h5>';
                    for (var i = 0; i < hotel.star; i++) {
                        div += ' <i class="fas fa-star"></i>';
                    }
                    if (hotel.rating == null) div += '<br><small class="text-muted my-2">Belum ada penilaian</small><br>';
                    else div += '<h5 class="my-2"><b>' + hotel.rating + '/10 </b>(' + hotel.reviewers + ' Penilaian)</h6>'
                    div += '<span class="badge badge-light txt-lightblack text-uppercase transparent"><i class="fas fa-map-marker-alt mr-1"></i>' + hotel.namaKota + ', ' + hotel.namaProvinsi + '</span>' +
                        '<p class="card-text">' + hotel.detailLengkap + '</p>' +
                        '<div class="row justify-content-start">' +
                        '<form method="get" action="/showRoom">' +
                        ' <form method="get" action="/showRoom">@csrf' +
                        '<input type="hidden" id="hotelId'+hotel.hotel_id+'" name="hotelId" value="' + hotel.hotel_id + '">' +
                        '<button type="submit" class="btn btn-primary ml-3">Lihat Detail</button>' +
                        '</form></div></div></div></div></div>'
                    $('#hotel-row').append(div);
                    div = "";
                })

            }
        })
    });

        $(window).resize(function(e) {
            customwidth();
        });
});
function customwidth()
        {
            var formwidth = $('#searchForm').width();
            $('.typeahead').width(formwidth);
            console.log($('#searchForm').width());
        }


function ajaxCallSearch (item) {
    var provinsiId = "all";
    var kotaId = "all";
    var hotelId = "all";
    var field = "none";
    var order = "none";
    var filter = "none";
    if(item.provinsi) provinsiId = item.provinsi_id
    else if(item.kota) kotaId = item.kota_id
    else if(item.hotel) hotelId = item.hotel_id
    console.log(provinsiId, hotelId, kotaId, field, order);
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/getHotel',
            data: { provinsiId: provinsiId, kotaId: kotaId, field: field, order: order, hotelId: hotelId, filter: filter },
            success: (result) => {
                console.log(result);
                result = JSON.parse(result);
                $('.card-hotel').remove();
                result.forEach(hotel => {
                    console.log("ho");
                    var div = "<div class='card my-5 card-hotel' style='height=25vh;'>" +
                        '<div class="row no-gutters">' +
                        '<div class="col-md-5">' +
                        '<img src="' + hotel.photo + '" style="height:100%; object-fit: cover;" class="card-img" alt="No Photo">' +
                        '</div>' +
                        '<div class="col-md-7">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title mb-0">' + hotel.name + '</h5>';
                    for (var i = 0; i < hotel.star; i++) {
                        div += ' <i class="fas fa-star"></i>';
                    }
                    if (hotel.rating == null) div += '<br><small class="text-muted my-2">Belum ada penilaian</small><br>';
                    else div += '<h5 class="my-2"><b>' + hotel.rating + '/10 </b>(' + hotel.reviewers + ' Penilaian)</h6>'
                    div += '<span class="badge badge-light txt-lightblack text-uppercase transparent"><i class="fas fa-map-marker-alt mr-1"></i>' + hotel.namaKota + ', ' + hotel.namaProvinsi + '</span>' +
                        '<p class="card-text">' + hotel.detailLengkap + '</p>' +
                        '<div class="row justify-content-start">' +
                        '<form method="get" action="/showRoom">@csrf' +
                        '<input type="hidden" id="hotelId'+hotel.hotel_id+'" name="hotelId" value="' + hotel.hotel_id + '">' +
                        '<button type="submit" class="btn btn-primary ml-3">Lihat Detail</button>' +
                        '</form></div></div></div></div></div>'
                    $('#hotel-row').append(div);
                })

            }
        });


}
    </script>
    @endsection
