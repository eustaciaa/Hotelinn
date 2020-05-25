@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
</div>
@endsection
