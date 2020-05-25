<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hotel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\history;

class RentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rent (Request $request)
    {
        $id = $request->input('hotelId');
        $roomId = $request->input('roomId');
        $checkIn = $request->input('checkIn');
        $checkOut = $request->input('checkOut');
        $remainedRooms = $request->input('remainedRooms');
        
        $hotel = hotel::where('id',$id)->first();
        $room = $hotel->room->where('id',$roomId)->first();
        $formNeeds = ['checkIn' => $checkIn, 'checkOut' => $checkOut, 'remainedRooms' => $remainedRooms];

        return view('hotel.rent')->with( ['hotel' => $hotel,'room'=> $room, 'formNeeds' => $formNeeds]);
    }

    public function rentFinal (Request $request)
    {   
        $remainedRooms = $request->input('remainedRooms');
        $jumlah = $request->input('jmlh');

        if($jumlah > $remainedRooms){
            return redirect('/')->with('fail', 'Oops! Ruangan hotel gagal dipesan. Jumlah ruangan yang ingin dipesan melebihi jumlah ruangan yang tersedia.');
        }

        $fName = $request->input('fName');
        $lName = $request->input('lName');
        $checkIn = $request->input('checkIn');
        $id = $request->input('hotelId');
        $roomId = $request->input('roomId');
        $checkOut = $request->input('checkOut');

        $hotel = hotel::where('id',$id)->first();
        $room = $hotel->room->where('id',$roomId)->first();
        $roomTotal = $jumlah;

        $history = new history;
        $history->user_id = Auth::user()->id;
        $history->roomTotal = $roomTotal;
        $history->checkIn = $checkIn;
        $history->checkOut = $checkOut;
        $history->hotel_id = $hotel->id;
        $history->room_id = $room->id;
        $history->bookDate = Carbon::now();
        $history->save();

        return redirect('/')->with('success', 'Asyik! Ruangan hotel berhasil dipesan! Pemesanan yang telah berhasil dilakukan dapat dilihat pada Riwayat Pemesanan Anda.');

    }
}
