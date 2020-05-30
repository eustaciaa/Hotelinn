@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
<div class="container">
    <div class="col-12">
        <h2 class="mt-3">Daftar Pemesanan</h2>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @elseif (session('unstatus'))
            <div class="alert alert-danger">
                {{ session('unstatus') }}
            </div>
        @endif
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Kode Booking</th>
                    <th>Nama Customer</th>
                    <th>Nama Hotel</th>
                    <th>Alamat Hotel</th>
                    <th>Panel</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($histories as $history)
                <tr>
                    <td>{{ $history->id }}</td>
                    <td>{{ $history->nama_depan }} {{ $history->nama_belakang }}</td>
                    <td>{{ $history->hotel->name }}</td>
                    <td>{{ $history->hotel->alamat->detailLengkap }}</td>
                    <td>
                        <a href="/admin/order/{{ $history->id }}" class="mx-2 badge badge-info">Detail</a>
                        @if($history->confirmed == 0)
                        <a href="/admin/confirm/{{ $history->id }}" class="mx-2 badge badge-success">Confirm</a>
                        @else
                        <a href="/admin/unconfirm/{{ $history->id }}" class="mx-2 badge badge-warning">Unconfirm</a>
                        @endif

                        @if($history->finished == 0)
                        <a href="/admin/finish/{{ $history->id }}" class="mx-2 badge badge-success">Finish</a>
                        @else
                        <a href="/admin/unfinish/{{ $history->id }}" class="mx-2 badge badge-warning">Unfinish</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="/admin" class="btn btn-primary my-3">Kembali</a>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
        } );
    } );
</script>
@endsection