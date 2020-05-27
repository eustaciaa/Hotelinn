@extends('layouts.app')

@section('content')
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">

                    <div class="card my-5 text-center bg-lightblue">
                    <div class="card-header bg-dark">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active a-ijo" id="wait-tab" data-toggle="tab" href="#wait_confirm" role="tab" aria-controls="posts" aria-selected="true">Menunggu Konfirmasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link a-ijo" id="confirm-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#active_book">Pemesanan Aktif</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link a-ijo" id="history-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#history">Riwayat Pemesanan</a>
                                </li>
                            </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="wait_confirm" role="tabpanel" aria-labelledby="wait-tab">
                                @foreach ($histories as $history)
                                @if ($history->finished == 0 && $history->confirmed == 0) 
                                <div class="form-group">
                                <div class="card my-5">
                                    <div class="card-body">
                                        <div class="row mx-1">
                                            <div class="col-9">
                                                <p class="text-left">
                                                <img class="card-img" style="width: 300px" src="{{$history->hotel->photo}}" alt="{{$history->hotel->photo}}">
                                                    <br>
                                                    {{$history->hotel->name}}
                                                    <br>
                                                    {{$history->room->name}}
                                                    <br>
                                                    <br>
                                                    <span class="badge badge-light txt-lightblack text-uppercase transparent"><i class="fas fa-map-marker-alt mr-1"></i>{{ $history -> hotel -> alamat -> kota -> namaKota }}, {{ $history -> hotel -> alamat -> provinsi -> namaProvinsi }}</span>
                                                    <br>
                                                    {{$history -> hotel -> alamat -> detailLengkap}}
                                                    <br>
                                                    <div class="col-md-6 d-flex align-items-end">
                                                        <h5><span class="badge badge-primary txt-lightblack text-uppercase transparent">
                                                            {{ date_format(date_create($history->checkIn), "j F Y") }} - 
                                                            {{ date_format(date_create($history->checkOut), "j F Y") }}
                                                        </span></h5>
                                                    </div>
                                                </p>
                                            </div>
                                        </div>
                                </div>
                                </div>
                                @endif
                                @endforeach

                            </div>


                            <div class="tab-pane fade" id="active_book" role="tabpanel" aria-labelledby="confirm-tab">
                                <div class="form-group">
                                    <label class="sr-only" for="message">post</label>
                                    <textarea class="form-control" name="post" id="comment" placeholder="2"></textarea>
                                </div>

                            </div>
                            
                            <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                                <div class="form-group">
                                    <label class="sr-only" for="message">post</label>
                                    <textarea class="form-control" name="post" id="comment" placeholder="3"></textarea>
                                </div>

                            </div>
                        </div>

                    </div>
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection
