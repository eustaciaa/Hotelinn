<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;


/* Model Imports */
use App\alamat;
use App\provinsi;
use App\room_details;
use App\hotel;
use App\history;
use Illuminate\Database\Eloquent\Builder;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('checkAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $hotel = alamat::whereHas('hotel', function (Builder $query) {
            $query->has('room','>','0');
        },">",0)->get();


        return view('home')->with(['hotels' => $hotel, 'provinsis' => provinsi::all()]);
    }



    /**
     * Get Room With Count of Booked Rooms
     */
    public function getRoomWithCount(Request $request)
    {
        $hotelId = $request->input('hotelId');
        $checkIn = $request->input('checkIn');
        $checkOut = $request->input('checkOut');

        $hotel = alamat::where('hotel_id', $hotelId)->first();

        $result = ['checkIn'=> $checkIn,'checkOut' => $checkOut, 'code' => 1];

        $rooms = room_details::where('hotel_id', $hotelId)->get();

        $count = history::selectRaw('room_id, sum(history.roomtotal) as booked_rooms')
                        ->where('hotel_id',$hotelId)
                        ->where('finished','=','false')
                        ->whereRaw("IF((checkIn BETWEEN '".$checkIn."' AND '".$checkOut."') OR (checkIn BETWEEN '".$checkIn."' AND '".$checkOut."'), 1, IF((checkOut >= '".$checkIn."') AND (checkIn <='".$checkOut."'), 1, 0))")
                        ->groupBy('room_id')->get();


        $hotel = alamat::where('hotel_id', $hotelId)->first();

        $rooms = room_details::where('hotel_id', $hotelId)->get();

        return view('hotel.list')->with(['rooms' => $rooms, 'hotel' => $hotel, 'bookedRooms' => $count, 'userInput' => $result]);
    }


    /**
     * Show Room Available
     */

    public function showRoom(Request $request)
    {
        $hotelId = $request->input('hotelId');

        $hotel = alamat::where('hotel_id', $hotelId)->first();

        $rooms = room_details::where('hotel_id', $hotelId)->get();

        return view('hotel.list')->with(['rooms' => $rooms, 'hotel' => $hotel]);
    }

    public function rentHotel(Request $request)
    {
        if ($request->input('order')) {
            $order = $request->input('order');
        } else {
            $order = 'asc';
        }
        $id = $request->input('hotelId');
        $rooms = room_details::where('hotel_id', $id)->orderBy('cost', $order)->get();

        return view('hotel.room')->with(['roomdetails' => $rooms, 'hotelId' => $id]);
    }
}
