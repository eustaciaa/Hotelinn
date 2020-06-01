@extends('layouts.admin')

@section('item')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <h3>Detail Pemesanan</h3>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi penginapan</h5><br>
                    @foreach ($histories as $history)
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Check in') }}</label>

                        <div class="col-md-6 d-flex align-items-end">
                            <h5><span class="badge badge-primary txt-lightblack text-uppercase transparent">
                                {{ date_format(date_create($history->checkIn), "j F Y") }}
                            </span></h5>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Check out') }}</label>

                        <div class="col-md-6 d-flex align-items-end">
                            <h5><span class="badge badge-primary txt-lightblack text-uppercase transparent">
                                {{ date_format(date_create($history->checkOut), "j F Y") }}
                            </span></h5>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Hotel') }}</label>

                        <div class="col-md-6 d-flex flex-column justify-content-start">
                            <h6>{{ $history->hotel->name }}</h6>
                            <p>{{ $history->hotel->alamat->detailLengkap }}</p>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Ruangan') }}</label>

                        <div class="col-md-6 d-flex align-items-center">
                        <h6>{{ $history->room->name }}</h6>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-4 text-md-right">{{ __('Harga') }}</label>

                        <div class="col-md-6 d-flex align-items-center text-red">
                        <h6>Rp{{number_format($history->room->cost,2,",",".")}} / malam</h6>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-md-4 text-md-right">{{ __('Malam') }}</label>

                            <div class="col-md-6 d-flex align-items-center text-red">
                            <h6>{{ $history->roomTotal }}x</h6>
                            </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-md-4 text-md-right">{{ __('Total Pembayaran') }}</label>

                            <div class="col-md-6 d-flex align-items-center text-red">
                            <h6>Rp{{number_format($history->roomTotal *$history->room->cost,2,",",".")}}</h6>
                            </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-md-4 text-md-right">{{ __('Status') }}</label>
                    @if ($history->confirmed == 0 && $history->finished == 0)

                            <div class="col-md-6 d-flex align-items-center text-red">
                                <div class="h6" style="color:red">WAITING</div>
                            </div>
                    @elseif ($history->confirmed > 0 && $history->finished == 0)
                            <div class="col-md-6 d-flex align-items-center text-red">
                                <div class="h6" style="color:orange">CONFIRMED</div>
                            </div>

                    @elseif ($history->confirmed > 0 && $history->finished > 0)
                            <div class="col-md-6 d-flex align-items-center text-red">
                                <div class="h6" style="color:green">FINISHED</div>
                            </div>
                    @endif
                    </div>

                </div>
            </div><br>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data diri</h5><br>
                    <div class="form-group row">
                        <label for="fName" class="col-md-4 col-form-label text-md-right">{{ __('Nama Depan') }}</label>

                        <div class="col-md-6">
                            <input id="fName" type="text" class="form-control" name="fName" value="{{ $history->nama_depan }}" disabled autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lName" class="col-md-4 col-form-label text-md-right">{{ __('Nama Belakang') }}</label>

                        <div class="col-md-6">
                            <input id="lName" type="text" class="form-control" name="lName" value="{{ $history->nama_belakang }}" disabled autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Telepon') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ $history->phone }}" disabled autofocus>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
        <a href="/admin/orderList" class="btn btn-primary my-3"><i class="fas fa-chevron-left mr-2"></i>Kembali</a>
        </div>
    </div>
</div>

@endsection
