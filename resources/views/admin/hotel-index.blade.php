@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
<div class="container">
    <div class="col-12">
        <h2 class="mt-3">Daftar Hotel</h2>
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
                    <th>Nama Hotel</th>
                    <th>Alamat Hotel</th>
                    <th>Panel</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($hotels as $hotel)
                <tr>
                    <td>{{ $hotel->hotel->name }}</td>
                    <td>{{ $hotel->detailLengkap }}</td>
                    <td>
                        <a href="/admin/hotels/{{ $hotel->hotel->id }}" class="mx-2 badge badge-info">Detail</a>
                        <a href="/admin/hotels/alamat/{{ $hotel->hotel->id }}/edit" class="mx-2 badge badge-info">Ubah Alamat</a>
                        <a href="/admin/rooms/{{ $hotel->hotel->id }}/add-room" class="mx-2 badge badge-info">Tambah Kamar</a>
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