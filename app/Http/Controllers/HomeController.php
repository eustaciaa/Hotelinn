<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\alamat;
use App\provinsi;
use App\hotel;
use App\room_details;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $provinsi = provinsi::all();

        return view('home')->with('provinsis',$provinsi);

    }

    public function getHotel(Request $request){
        $id = $request->input('kotaId');
        $alamat = alamat::where('provinsi_id',$id)->get();

        return view('list')->with('alamats',$alamat);
    }

    public function rentHotel(Request $request){
        $id = $request->input('hotelId');
        $rooms = room_details::where('hotel_id',$id)->get();

        return view('room')->with('roomdetails',$rooms);
    }
}
