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
                <a class="nav-link active" href="#">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item px-3 pt-4">
                <h6>Statistik</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Reports
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#dropdowm" aria-expanded="false" data-toggle="collapse">
                    <i class="fas fa-layer-group mr-2"></i>
                    Dropdown
                </a>
                <ul id="dropdowm" class="collapse nav flex-column px-4">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Page</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Page</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Page</a>                        
                    </li>
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
        </ul>
    </nav>
    <div class="content-inner p-5">
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
</div>
@endsection
