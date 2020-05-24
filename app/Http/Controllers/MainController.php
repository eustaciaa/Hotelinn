<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

/* Model Imports */
use App\alamat;
use App\provinsi;
use App\room_details;
use App\hotel;

class MainController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        $checkIn = $request->input('checkIn');
        $checkOut = $request->input('checkOut');
        $alamat = alamat::whereNotIn('hotel_id', function($query) use ($checkIn, $checkOut){
                            $query->select('hotel_id')->from('history')
                                                        ->whereBetween('checkIn', [$checkIn, $checkOut])
                                                        ->whereBetween('checkOut', [$checkIn, $checkOut]);
                            })
                        ->where(['alamat.provinsi_id' => $provinsiId, 'alamat.kota_id' => $kotaId])
                        ->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')
                        ->join('provinsi', 'alamat.provinsi_id', '=', 'provinsi.id')
                        ->join('kota', 'alamat.kota_id', '=', 'kota.id')
                        ->get();
        return json_encode($alamat, JSON_HEX_TAG);
    }

    /**
     * Show The Hotel List Filtered With Desired CheckIn and CheckOut
     */
    public function getAvailableHotel(Request $request)
    {
        $checkIn = $request->input('checkIn');
        $checkOut = $request->input('checkOut');
        $hotels = alamat::whereNOTIn('hotel_id',function($query){
                            $query->select('hotel_id')->from('history')
                                                      ->whereBetween('checkIn', [$checkIn, $checkOut])
                                                      ->whereBetween('checkOut', [$checkIn, $checkOut]);
                        })
                        ->get();
        dd($hotels);
    }

    /**
     * Show Room Available
     */

    public function showRoom(Request $request){
        $hotelId = $request->input('hotelId');

        $hotel = alamat::where('hotel_id', $hotelId)->first();

        $rooms = room_details::where('hotel_id', $hotelId)->get();

        return view('hotel.list')->with(['rooms' => $rooms, 'hotel' => $hotel]);
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
