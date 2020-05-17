<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\alamat;
use App\provinsi;
use App\room_details;
use App\history;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

    public function getHotel(Request $request)
    {
        $id = $request->input('kotaId');
        $alamat = alamat::where('provinsi_id',$id)->get();

        return view('hotel.list')->with('alamats',$alamat);
    }

    public function rentHotel(Request $request)
    {
        if($request->input('order'))
        {
            $order = $request->input('order');
        }
        else{
            $order = 'asc';
        }
        $id = $request->input('hotelId');
        $rooms = room_details::where('hotel_id',$id)->orderBy('cost',$order)->get();

        return view('hotel.room')->with(['roomdetails' => $rooms,'hotelId' => $id]);
    }

}
