@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 py-5">
            <div class="text-xs-center">
            <img src="{{ asset('images/hotelinn/brand.png') }}" width="200" alt="">
            @foreach ($details as $detail)
                <div class="h5" style="color:gray;">Bukti Transaksi</div>
                <div class="row">
                @if ($detail->finished > 0 && $detail->confirmed > 0)
                <div class="col-sm" style="color:green;"><strong>Status: Finished</strong></div>
                @elseif ($detail->confirmed > 0 && $detail->finished == 0)
                <div class="col-sm" style="color:orange;"><strong>Status: Active</strong></div>
                @elseif ($detail->confirmed == 0 && $detail->finished == 0)
                <div class="col-sm" style="color:red;"><strong>Status: Waiting</strong></div>
                @endif
                <div class="col-sm h5 text-right" style="color:orange;"><strong>Kode Booking : #{{ $detail->id }}</strong></div>
                </div>
            </div>
            <hr>
            <h4>Data Diri</h4>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <a style="color:gray">Nama</a>
                            <br>
                            <strong>{{ $detail->nama_depan}} {{$detail->nama_belakang }}</strong>
                        </div>
                        <div class="col-sm">
                            <a style="color:gray">Email</a>
                            <br>
                            <strong>{{ Auth::user()->email }}</strong>
                        </div>
                        <div class="col-sm">
                            <a style="color:gray">Nomor Telepon</a>
                            <br>
                            <strong>{{ $detail->phone }}</strong>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm">
                            <a style="color:gray">Check In</a>
                            <br>
                            <div class="d-flex align-items-end">
                                <h5><span class="badge badge-primary txt-lightblack text-uppercase transparent">
                                    {{ date_format(date_create($detail->checkIn), "D, j F Y") }}
                                </span></h5>
                            </div>
                        </div>
                        <div class="col-sm">
                            <a style="color:gray">Check Out</a>
                            <br>
                            <div class="d-flex align-items-end">
                                <h5><span class="badge badge-primary txt-lightblack text-uppercase transparent">
                                    {{ date_format(date_create($detail->checkOut), "D, j F Y") }}
                                </span></h5>
                            </div>
                        </div>
                        <div class="col-sm">
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <h4>Detail Pembayaran</h4>
            <div class="card">
                <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="border-bottom border-top">
                                    <td><strong>Nama</strong></td>
                                    <td class="text-xs-center"><strong>Deskripsi</strong></td>
                                    <td class="text-xs-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td><strong>{{ $detail->hotel->name }}</strong><br>{{ $detail->hotel->alamat->detailLengkap }}</td>
                                    <td class="text-xs-center"><strong>{{ $detail->room->name }}</strong><br>Malam x{{ $detail->roomTotal }}</td>
                                    <td class="text-xs-right"><strong>Rp{{number_format($detail->room->cost * $detail->roomTotal,2,",",".")}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-xs-center"><strong>Biaya Layanan</strong></td>
                                    <td class="emptyrow text-xs-right"><strong>GRATIS</strong></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-xs-center"><strong>Total</strong></td>
                                    <td class="emptyrow text-xs-right"><strong>Rp{{number_format($detail->room->cost * $detail->roomTotal,2,",",".")}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card bg-lightblue">
                        <div class="card-body">
                            <div class="row">
                            <div class="col">
                            <a><strong>Total Pembayaran</strong></a>
                            <br>
                            <a class="text-muted" style="font-size:12px">*Sudah termasuk PPN 10%<a>
                            </div>
                            <div class="col-right">
                            <a class="h4" style="color:orange"><strong>Rp{{number_format($detail->room->cost * $detail->roomTotal,2,",",".")}}</strong></a>
                            </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

                
        </div>
    </div>
</div>






















<!-- 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <h3>Detail Pemesanan</h3>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi penginapan</h5><br>
                    @foreach ($details as $detail)

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Check in') }}</label>

                        <div class="col-md-6 d-flex align-items-end">
                            <h5><span class="badge badge-primary txt-lightblack text-uppercase transparent">
                                {{ date_format(date_create($detail->checkIn), "j F Y") }}
                            </span></h5>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Check out') }}</label>

                        <div class="col-md-6 d-flex align-items-end">
                            <h5><span class="badge badge-primary txt-lightblack text-uppercase transparent">
                                {{ date_format(date_create($detail->checkOut), "j F Y") }}
                            </span></h5>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Hotel') }}</label>

                        <div class="col-md-6 d-flex flex-column justify-content-start">
                            <h6>{{ $detail->hotel->name }}</h6>
                            <p>{{ $detail->hotel->alamat->detailLengkap }}</p>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Ruangan') }}</label>

                        <div class="col-md-6 d-flex align-items-center">
                        <h6>{{ $detail->room->name }}</h6>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Harga') }}</label>

                        <div class="col-md-6 d-flex align-items-center text-red">
                        <h6>Rp{{number_format($detail->room->cost,2,",",".")}} / malam</h6>
                        </div>
                    </div>
        </div>
    </div>
</div>
@endforeach
<script>
    $('#checkIn').attr('min', new Date().toISOString().split("T")[0]);
    $('#checkOut').attr('min',  $('#checkIn').attr('min'));
    $('#checkIn').on('change', () => {
        $('#checkOut').attr('min',  $('#checkIn').val());
    })
</script> -->
@endsection
