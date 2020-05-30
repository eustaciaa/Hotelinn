@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-stretch">
    <nav class="side-navbar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center pt-5 pb-3 px-4">
            <div class="title">
                <h1 class="h4">{{ Auth::user()->fName }}</h1>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>
        <!-- Sidebar Navidation Menus-->
        <ul class="nav flex-column px-2">
            <li class="nav-item">
                <a class="nav-link active" href="/admin">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item px-3 pt-4">
                <h6>Statistik</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/hotelStat">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Reports
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#dropdowm" aria-expanded="false" data-toggle="collapse">
                    <i class="fas fa-layer-group mr-2"></i>
                    Statistik Detail
                </a>
                <ul id="dropdowm" class="collapse nav flex-column px-4">
                    <li class="nav-item">
                        <a href="{{ route('admin.userStat') }}" class="nav-link">User</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.hotelStat') }}" class="nav-link">Hotel</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">Page</a>
                    </li> -->
                </ul>
            </li>
            <li class="nav-item px-3 pt-4">
                <h6>Hotel</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/hotels">
                    <i class="fas fa-th-list mr-2"></i>
                    Lihat semua hotel
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/add-hotel">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Tambahkan hotel
                </a>
            </li>
            <li class="nav-item px-3 pt-4">
                <h6>Order</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/orderList">
                    <i class="fas fa-th-list mr-2"></i>
                    Pemesanan
                </a>
            </li>
        </ul>
    </nav>
    <div class="content-inner p-5">
        <div class="row justify-content-around">
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <strong>Jumlah User Yang Terdaftar</strong>
                        </h5>
                        <h5 class="card-text">
                            {{ $user }}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <strong>Jumlah Hotel Yang Terdaftar</strong>
                        </h5>
                        <h5 class="card-text">
                            {{ $hotel }}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <strong>Jumlah Order Yang Terdaftar</strong>
                        </h5>
                        <h5 class="card-text">
                            {{ $order }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="allChart" width="200" height="110"></canvas>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Welcome ADMIN <strong>{{ Auth::user()->fName }}</strong>!
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action" href="/admin/add-hotel">Menambahkan Hotel</a>
                    <a class="list-group-item list-group-item-action" href="/admin/hotels">Menampilkan Hotel</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</> --}}
</div>
<script>
    $(document).ready( async ()=>{
        let ctx = $('#allChart')
        let userCount = await getUserCount();
        let hotelCount = await getHotelCount();
        let orderCount = await getOrderCount();
        let month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: month,
                datasets: [{
                    label: 'Jumlah User Terdaftar',
                    data: userCount,
                    backgroundColor:
                        'rgba(255, 99, 132, 0.2)',
                    borderColor:
                        'rgba(255, 99, 132, 1)',
                    fill: false
                },{
                    label: 'Jumlah Hotel Terdaftar',
                    data: hotelCount,
                    backgroundColor:
                        'rgba(52, 152, 219,1.0)',
                    borderColor:
                        'rgba(52, 152, 219,1.0)',
                    fill: false
                },{
                    label: 'Jumlah Order Terdaftar',
                    data: orderCount,
                    backgroundColor:
                        'rgba(255, 99, 132, 0.2)',
                    borderColor:
                        'rgba(255, 99, 132, 1)',
                    fill: false
                }],

            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    })

    function getUserCount() {
        return   axios.get('{{route('admin.userCount')}}')
        .then( (res) => {
            var data = res.data;
            console.log(data)
            return data;
            }
        );
    }
    function getHotelCount() {
        return   axios.get('{{route('admin.hotelCount')}}')
        .then( (res) => {
            var data = res.data;
            console.log(data)
            return data;
            }
        );
    }
    function getOrderCount() {
        return   axios.get('{{route('admin.orderCount')}}')
        .then( (res) => {
            var data = res.data;
            console.log(data)
            return data;
            }
        );
    }
</script>
@endsection
