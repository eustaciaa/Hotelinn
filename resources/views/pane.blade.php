@extends('layouts.admin')

@section('item')
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
                        'rgba(241, 196, 15,1.0)',
                    borderColor:
                        'rgba(241, 196, 15,1.0)',
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
