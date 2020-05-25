

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success my-5">
                <?php echo e(session('success')); ?>

                Klik <a href="/history"
                        onclick="event.preventDefault();
                                document.getElementById('history-form').submit();">di sini</a>
                untuk menuju ke Riwayat Pemesanan Anda.
            </div>
            <form id="history-form" action="/history" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="slider fade">
    <div class="load"></div>
    <div class="content">
        <?php if(session('success')): ?>
        <div class="principal" style="top: 60%;">
        <?php else: ?>
        <div class="principal" style="top: 40%;">
        <?php endif; ?>
            <h1>Bingung mau nginep di mana?<br><b>hotelinn</b> aja.</h1>
        </div>
    </div>
</div>
<div class="bg-lightblue">
    <div class="container">
        <div class="row justify-content-center" id="searchRow">
            <div class="col-md-6 my-5">
                <form>
                    <div class="row justify-content-center mb-2">
                        <div class="col text-center">
                            <h4>Mau nginep di mana?</h4>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <select class="form-control" name="provinsiId" id="provinsi">
                                <option value="all" selected> Pilih provinsi </option>
                                <?php $__currentLoopData = $provinsis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provinsi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($provinsi->id); ?>"> <?php echo e($provinsi->namaProvinsi); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card my-5 card-hotel" style="height=25vh;">
                <div class="row no-gutters">
                    <div class="col-md-5">
                    <img src="<?php echo e($hotel->hotel->photo); ?>" style="height:100%; object-fit: cover;" class="card-img" alt="<?php echo e($hotel->hotel->photo); ?>">
                    </div>
                    <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title mb-0"><?php echo e($hotel->hotel->name); ?></h5>
                        <?php for($i = 0; $i < $hotel->hotel->star; $i++): ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                        <?php if(is_null($hotel->hotel->rating)): ?>
                            <br><small class="text-muted my-2">Belum ada penilaian</small><br>
                        <?php else: ?>
                            <h5 class="my-2"><b><?php echo e($hotel->hotel->rating); ?>/10 </b>(<?php echo e($hotel->hotel->reviewers); ?> ulasan)</h6>
                        <?php endif; ?>
                        <span class="badge badge-light txt-lightblack text-uppercase transparent"><i class="fas fa-map-marker-alt mr-1"></i><?php echo e($hotel->kota->namaKota); ?>, <?php echo e($hotel->provinsi->namaProvinsi); ?></span>
                        <p class="card-text"><?php echo e($hotel->detailLengkap); ?></p>
                        <div class="row justify-content-start">
                            <form method="get" action="/showRoom">
                                <?php echo csrf_field(); ?>
                            <input type="hidden" id="hotelId" name="hotelId" value="<?php echo e($hotel->hotel->id); ?>">
                            <button type="submit" class="btn btn-primary ml-3">
                                Lihat Detail
                            </button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                data: { provinsiId: provinsiId, kotaId: kotaId, checkIn: checkIn, checkOut: checkOut},
                success: (result) => {
                    console.log(result);
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
                              if(hotel.rating == null) div+= '<br><small class="text-muted my-2">Belum ada penilaian</small><br>';
                              else div+= '<h5 class="my-2"><b>'+hotel.rating+'/10 </b>('+hotel.reviewers+' ulasan)</h6>'
                              div += '<span class="badge badge-light txt-lightblack text-uppercase transparent"><i class="fas fa-map-marker-alt mr-1"></i>'+hotel.namaKota+', '+hotel.namaProvinsi+'</span>'+
                              '<p class="card-text">'+hotel.detailLengkap+'</p>'+
                              '<div class="row justify-content-start">'+
                              '<form method="get" action="/showRoom">'+
                              ' <form method="get" action="/showRoom"><?php echo csrf_field(); ?>'+
                              '<input type="hidden" id="hotelId" name="hotelId" value="'+hotel.id+'">'+
                              '<button type="submit" class="btn btn-primary ml-3">Lihat Detail</button>'+
                              '</form></div></div></div></div></div>'
                        $('#hotel-row').append(div);
                    })

                }
            })
        });
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\hotelinn\resources\views/home.blade.php ENDPATH**/ ?>