@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                @foreach ($histories as $history)
                <div class="card my-5">
                    <div class="card-header justify-content-center">History No {{$history->id}}</div>
                    <div class="card-body">
                        <div class="row mx-1">
                            <div class="col-9">
                                <p>
                                    {{$history->hotel->name}}
                                    <br>
                                    <br>
                                    {{$history->room->name}}
                                    <br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

        </div>
    </div>
</div>
@endsection
