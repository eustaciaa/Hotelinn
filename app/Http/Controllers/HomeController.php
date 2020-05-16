<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\alamat;
use App\provinsi;
use App\hotel;
use App\room_details;
use App\history;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function getHotel(Request $request)
    {
        $id = $request->input('kotaId');
        $alamat = alamat::where('provinsi_id',$id)->get();

        return view('list')->with('alamats',$alamat);
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

        return view('room')->with(['roomdetails' => $rooms,'hotelId' => $id]);
    }

    public function rentRoom (Request $request)
    {
        $id = $request->input('hotelId');
        $roomId = $request->input('roomId');
        $hotel = hotel::where('id',$id)->first();
        $room = $hotel->room->where('id',$roomId)->first();
        return view('rent')->with( ['hotel' => $hotel,'room'=> $room]);
    }

    public function rentFinal (Request $request)
    {
        $fName = $request->input('fName');
        $lName = $request->input('lName');
        $checkIn = $request->input('checkIn');
        $jumlah = $request->input('jmlh');
        $id = $request->input('hotelId');
        $roomId = $request->input('roomId');
        $checkOut = $request->input('checkOut');
        $hotel = hotel::where('id',$id)->first();
        $room = $hotel->room->where('id',$roomId)->first();
        $total = $room->cost * $jumlah;

        $history = new history;
        $history->user_id = Auth::user()->id;
        $history->total = $total;
        $history->checkIn = $checkIn;
        $history->checkOut = $checkOut;
        $history->hotel_id = $hotel->id;
        $history->room_id = $room->id;
        $history->bookDate = Carbon::now();
        $history->save();

        return redirect('/');

    }
}
