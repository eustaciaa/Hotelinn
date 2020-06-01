@extends('layouts.admin')

@section('item')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
<div class="container mt-4 mx-4">
    <div class="col-12">
        <h2 class="mt-3">Daftar Hotel</h2><br>
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
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->alamat }} {{ $hotel->deleted_at }}</td>
                    <td>
                        @if($hotel->deleted_at == null)
                        <a href="/admin/hotels/{{ $hotel->id }}" class="mx-2 badge badge-info">Detail</a>
                        <a href="/admin/hotels/alamat/{{ $hotel->id }}/edit" class="mx-2 badge badge-info">Ubah Alamat</a>
                        <a href="/admin/rooms/{{ $hotel->id }}/add-room" class="mx-2 badge badge-info">Tambah Kamar</a>
                        @else
                        <form action="/admin/hotels_restore/{{ $hotel->id }}" method="POST">
                            @method('PATCH')
                            @csrf
                        <button type="submit" class="mx-2 badge badge-success" style="border: none">Pulihkan Kembali</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
        } );
    } );
</script>
@endsection
