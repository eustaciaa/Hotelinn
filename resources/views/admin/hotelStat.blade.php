@extends('layouts.admin')

@section('item')
<div class="content-inner p-5">
    <div class="row justify-content-around">
        <div class="col-12">
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
        let hotelCount = await getHotelCount();
        let month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: month,
                datasets: [{
                    label: 'Jumlah Hotel Terdaftar Per Bulan',
                    data: hotelCount,
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

    function getHotelCount() {
        return   axios.get('{{route('admin.hotelCountDetail')}}')
        .then( (res) => {
            var data = res.data;
            console.log(data)
            return data;
            }
        );
    }
</script>
@endsection
