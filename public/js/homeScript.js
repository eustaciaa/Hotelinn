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

        theme: "bootstrap4",
        source: function (query, process) {
            return $.ajax({
                type: 'GET',
                url: '/searchBox',
                data: { query: this.query },
                success: function (result) {
                    result = JSON.parse(result);
                    console.log(result);
                    process(result);
                }
            })},
            displayText: function(item) {
                if(item.provinsi) return item.provinsi
                else if (item.kota) return item.kota
                else if (item.hotel) return item.hotel
            },
            afterSelect: function(item){
                ajaxCallSearch(item);
            }
            ,autoSelect: true
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
    $('#search').on('click', function () {
        var provinsiId = $('#provinsi').val();
        var kotaId = $("#kota").val();
        var orderBy = $("#orderBy").val();
        var hotelId = "all";
        var order = orderBy.split(" ");
        var field = order[0];
        var order = order[1];
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
            data: { provinsiId: provinsiId, kotaId: kotaId, field: field, order: order, hotelId: hotelId },
            success: (result) => {
                console.log(result);
                result = JSON.parse(result);
                $('.card-hotel').remove();
                result.forEach(hotel => {
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
                    else div += '<h5 class="my-2"><b>' + hotel.rating + '/10 </b>(' + hotel.reviewers + ' ulasan)</h6>'
                    div += '<span class="badge badge-light txt-lightblack text-uppercase transparent"><i class="fas fa-map-marker-alt mr-1"></i>' + hotel.namaKota + ', ' + hotel.namaProvinsi + '</span>' +
                        '<p class="card-text">' + hotel.detailLengkap + '</p>' +
                        '<div class="row justify-content-start">' +
                        '<form method="get" action="/showRoom">' +
                        ' <form method="get" action="/showRoom">@csrf' +
                        '<input type="hidden" id="hotelId" name="hotelId" value="' + hotel.id + '">' +
                        '<button type="submit" class="btn btn-primary ml-3">Lihat Detail</button>' +
                        '</form></div></div></div></div></div>'
                    $('#hotel-row').append(div);
                })

            }
        })
    });
});

function ajaxCallSearch (item) {
    var provinsiId = "all";
    var kotaId = "all";
    var hotelId = "all";
    var field = "none";
    var order = "none";
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
            data: { provinsiId: provinsiId, kotaId: kotaId, field: field, order: order, hotelId: hotelId },
            success: (result) => {
                console.log(result);
                result = JSON.parse(result);
                $('.card-hotel').remove();
                result.forEach(hotel => {
                    console.log(hotel.detailLengkap);
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
                    else div += '<h5 class="my-2"><b>' + hotel.rating + '/10 </b>(' + hotel.reviewers + ' ulasan)</h6>';
                    div += '<span class="badge badge-light txt-lightblack text-uppercase transparent"><i class="fas fa-map-marker-alt mr-1"></i>' + hotel.namaKota + ', ' + hotel.namaProvinsi + '</span>' +
                        '<p class="card-text">' + hotel.detailLengkap + '</p>' +
                        '<div class="row justify-content-start">' +
                        '<form method="get" action="/showRoom">' +
                        '<form method="get" action="/showRoom">@csrf' +
                        '<input type="hidden" id="hotelId'+hotel.id+'" name="hotelId" value="' + hotel.id + '">' +
                        '<button type="submit" class="btn btn-primary ml-3">Lihat Detail</button>' +
                        '</form></div></div></div></div></div>'
                    $('#hotel-row').append(div);
                })

            }
        })
}
