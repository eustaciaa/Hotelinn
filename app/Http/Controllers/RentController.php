<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hotel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\history;
use App\room_details;


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
        $roomAvail = $request->input('roomAvail');
        $hotel = hotel::where('id',$id)->first();
        $room = $hotel->room->where('id',$roomId)->first();
        $userInput = ["checkIn" => $checkIn, "checkOut" => $checkOut,"roomAvail" => $roomAvail];

        return view('hotel.rent')->with( ['hotel' => $hotel,'room'=> $room, 'userInput' => $userInput]);
    }

    public function rentFinal (Request $request)
    {

        $dateHotelValidation = $request->validate([
            'hotelId' => 'required|',
            'roomId' => 'required',
            'checkIn' => 'required|date|after_or_equal:'.Carbon::now()->toDateString(),
            'checkOut' => 'required|date|after_or_equal:checkIn',
        ]);


        $maxRoom = history::selectRaw('sum(roomTotal) as booked_rooms')
                        ->where('hotel_id',$dateHotelValidation['hotelId'])
                        ->where('room_id',$dateHotelValidation['roomId'])
                        ->where('finished','=','false')
                        ->whereRaw("IF((checkIn BETWEEN '".$dateHotelValidation['checkIn']."' AND '".$dateHotelValidation['checkOut']."') OR (checkIn BETWEEN '".$dateHotelValidation['checkIn']."' AND '".$dateHotelValidation['checkOut']."'), 1, IF((checkOut >= '".$dateHotelValidation['checkIn']."') AND (checkIn <='".$dateHotelValidation['checkOut']."'), 1, 0))")
                        ->groupBy('room_id')->first();

        $rooms = room_details::select('available')->where(['hotel_id' => $dateHotelValidation['hotelId'],'id' => $dateHotelValidation['roomId']])->first();

        if($maxRoom == "null") $availRoom = $maxRoom->booked_rooms - $rooms->available;
        else $availRoom = $rooms->available;

        $dataValid = $request->validate([
            'fName' => 'required|alpha',
            'lName' => 'required|alpha',
            'jmlh' => 'required|max:'.$availRoom
        ],
        [
            'fName.required' => 'tolong masukan nama depan.',
            'fName.alpha' => 'nama depan harus berupa huruf.',
            'lName.alpha' => 'nama belakang harus berupa huruf.',
            'lName.required' => 'tolong masukan nama belakang.',
            'jmlh.requried' => 'tolong masukan jumlah yang tepat.',
            'jmlh.max' => 'kamar telah penuh dipesan.'
        ]);

        $data = array_merge($dateHotelValidation, $dataValid);

        $history = new history;
        $history->user_id = Auth::user()->id;
        $history->roomTotal =$data['jmlh'];
        $history->checkIn = $data['checkIn'];
        $history->checkOut = $data['checkOut'];
        $history->hotel_id = $data['hotelId'];
        $history->room_id = $data['roomId'];
        $history->bookDate = Carbon::now();
        $history->save();

        return redirect('/')->with('success', 'Asyik! Ruangan hotel berhasil dipesan! Pemesanan yang telah berhasil dilakukan dapat dilihat pada Riwayat Pemesanan Anda.');

    }
}
