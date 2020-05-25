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
        return view('home')->with(['hotels' => alamat::all(), 'provinsis' => provinsi::all()]);
    }

    /**
     * Show The Hotel List
     */
    public function getHotel(Request $request)
    {
        $kotaId = $request->input('kotaId');
        $provinsiId = $request->input('provinsiId');
        $field = $request->input('field');
        $order = $request->input('order');
        if ($field != "none" && $order != "none") {
            if ($kotaId == 'all' && $provinsiId == 'all') {
                $alamat = alamat::join('hotel', 'alamat.hotel_id', '=', 'hotel.id')
                                ->join('provinsi', 'alamat.provinsi_id', '=', 'provinsi.id')
                                ->join('kota', 'alamat.kota_id', '=', 'kota.id')
                                ->orderBy($field, $order)->get();
            } elseif ($kotaId == 'all') {
                $query = ['alamat.provinsi_id' => $provinsiId];
                $alamat = alamat::where($query)
                                ->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')
                                ->join('provinsi', 'alamat.provinsi_id', '=', 'provinsi.id')
                                ->join('kota', 'alamat.kota_id', '=', 'kota.id')
                                ->orderBy($field, $order)->get();
            } elseif ($provinsiId == 'all') {
                $query = ['alamat.kota_id' => $kotaId];
                $alamat = alamat::where($query)
                                ->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')
                                ->join('provinsi', 'alamat.provinsi_id', '=', 'provinsi.id')
                                ->join('kota', 'alamat.kota_id', '=', 'kota.id')
                                ->orderBy($field, $order)->get();
            } else {
                $query = ['alamat.provinsi_id' => $provinsiId, 'alamat.kota_id' => $kotaId];
                $alamat = alamat::where($query)
                                ->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')
                                ->join('provinsi', 'alamat.provinsi_id', '=', 'provinsi.id')
                                ->join('kota', 'alamat.kota_id', '=', 'kota.id')
                                ->orderBy($field, $order)->get();
            }
        } else {
            if ($kotaId == 'all' && $provinsiId == 'all') {
                $alamat = alamat::join('hotel', 'alamat.hotel_id', '=', 'hotel.id')
                                ->join('provinsi', 'alamat.provinsi_id', '=', 'provinsi.id')
                                ->join('kota', 'alamat.kota_id', '=', 'kota.id')->get();
            } elseif ($kotaId == 'all') {
                $query = ['alamat.provinsi_id' => $provinsiId];
                $alamat = alamat::where($query)
                                ->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')
                                ->join('provinsi', 'alamat.provinsi_id', '=', 'provinsi.id')
                                ->join('kota', 'alamat.kota_id', '=', 'kota.id')->get();
            } elseif ($provinsiId == 'all') {
                $query = ['alamat.kota_id' => $kotaId];
                $alamat = alamat::where($query)
                                ->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')
                                ->join('provinsi', 'alamat.provinsi_id', '=', 'provinsi.id')
                                ->join('kota', 'alamat.kota_id', '=', 'kota.id')->get();
            } else {
                $query = ['alamat.provinsi_id' => $provinsiId, 'alamat.kota_id' => $kotaId];
                $alamat = alamat::where($query)
                                ->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')
                                ->join('provinsi', 'alamat.provinsi_id', '=', 'provinsi.id')
                                ->join('kota', 'alamat.kota_id', '=', 'kota.id')->get();
            }
        }
        
        return json_encode($alamat, JSON_HEX_TAG);
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

        $count = history::selectRaw('room_id, sum(roomTotal) as booked_rooms')
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
