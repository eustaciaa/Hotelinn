<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kota;
use App\alamat;

class AJAXController extends Controller
{
    /**
     * Show The Hotel List
     */
    public function getHotel(Request $request)
    {
        $kotaId = $request->input('kotaId');
        $provinsiId = $request->input('provinsiId');
        $hotelId = $request->input('hotelId');
        $field = $request->input('field');
        $order = $request->input('order');
        if ($field != "none" && $order != "none") {
            if ($kotaId == 'all' && $provinsiId == 'all') {
                $alamat = alamat::join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->orderBy($field, $order)->get();
            } elseif ($kotaId == 'all') {
                $query = ['provinsi_id' => $provinsiId];
                $alamat = alamat::where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->orderBy($field, $order)->get();
            } elseif ($provinsiId == 'all') {
                $query = ['kota_id' => $kotaId];
                $alamat = alamat::where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->orderBy($field, $order)->get();
            } else {
                $query = ['provinsi_id' => $provinsiId, 'kota_id' => $kotaId];
                $alamat = alamat::where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->orderBy($field, $order)->get();
            }
        } else {
            if ($kotaId == 'all' && $provinsiId == 'all' && $hotelId == "all") {
                $alamat = alamat::join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->get();
            } elseif($kotaId == 'all' && $provinsiId == 'all') {
                $alamat = alamat::join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->where('hotel.id',$hotelId)->get();
            } elseif ($kotaId == 'all' && $hotelId == 'all') {
                $alamat = alamat::where('provinsi_id',$provinsiId)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('kota','alamat.kota_id','=','kota.id')->groupBy('hotel.id')->get();
            } elseif ($provinsiId == 'all' && $hotelId == "all") {
                $query = ['kota_id' => $kotaId];
                $alamat = alamat::where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->get();
            } else {
                $query = ['provinsi_id' => $provinsiId, 'kota_id' => $kotaId];
                $alamat = alamat::where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->get();
            }
        }

        return json_encode($alamat, JSON_HEX_TAG);
    }

    public function getKota(Request $request)
    {
        if ($request->input('provinsi') == 'all') {
            return json_encode(kota::get(), JSON_HEX_TAG);
        }
        return json_encode(kota::where('provinsi_id', $request->input('provinsi'))->get(), JSON_HEX_TAG);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $query = '%' . $query . '%';

        $result = [];

        $provinsis = kota::select('provinsi.namaProvinsi', 'provinsi.id')->join('provinsi', 'kota.provinsi_id', 'provinsi.id')->where('namaProvinsi', 'like', $query)->distinct('provinsi.id')->get();

        if($provinsis->count() > 0){
            foreach($provinsis as $provinsi){
                $result[] = ["provinsi"=> $provinsi->namaProvinsi, "provinsi_id" => $provinsi->id];
            }
        }

        $kotas = kota::select('namaKota', 'kota.id')->where('namaKota','like',$query)->get();

        if($kotas->count() > 0)
        {
            foreach($kotas as $kota){
                $result[] = ["kota" => $kota->namaKota, "kota_id"=> $kota->id];
            }
        }

        $hotels = $hotels = kota::select('hotel.name', 'hotel.id')->join('alamat', 'kota.id', 'alamat.kota_id')->join('hotel', 'alamat.hotel_id', 'hotel.id')->where('hotel.name', 'like', $query)->get();

        if($hotels->count() > 0)
        {
            foreach($hotels as $hotel)
            {
                $result[] = ["hotel" => $hotel->name, "hotel_id" => $hotel->id];
            }
        }
        // if ($provinsis->count() > 0) {
        //     foreach ($provinsis as $provinsi) {
        //         $kotas = kota::select('namaKota', 'kota.id')->where('provinsi_id', $provinsi->id)->get();
        //         if ($kotas->count() > 0) {
        //             foreach ($kotas as $kota) {
        //                 $hotels = kota::select('hotel.name', 'hotel.id')->join('alamat', 'kota.id', 'alamat.kota_id')->join('hotel', 'alamat.hotel_id', 'hotel.id')->where('kota.id', $kota->id)->get();
        //                 if ($hotels->count() > 0) {
        //                     foreach ($hotels as $hotel) {
        //                         $hotelList[] = ['hotel' => $hotel->name, 'hotel_id' => $hotel->id];
        //                     }
        //                 } else{
        //                     unset($hotelList);
        //                     $hotelList = null;
        //                 }
        //                 $kotaList[] = ['kota' => $kota->namaKota, 'kota_id' => $kota->id, 'hotelList' => $hotelList];
        //                 unset($hotelList);
        //             }

        //         }else{
        //             unset($kotaList);
        //             $kotaList = null;
        //         }
        //         $result['provinsiList'][] = ['provinsi_id'=>$provinsi->id,'provinsi' => $provinsi->namaProvinsi,'kotaList' => $kotaList];
        //         unset($kotaList, $hotelList);
        //     }
        // } else {
        //     $kotas = kota::select('namaKota', 'kota.id')->where('namaKota','like',$query)->get();

        //     if ($kotas->count() > 0) {
        //         foreach ($kotas as $kota) {
        //             $hotels = kota::select('hotel.name', 'hotel.id')->join('alamat', 'kota.id', 'alamat.kota_id')->join('hotel', 'alamat.hotel_id', 'hotel.id')->where('kota.namaKota', 'like', $query)->get();
        //             if ($hotels->count() > 0) {
        //                 foreach ($hotels as $hotel) {
        //                     $hotelList[] = ['hotel' => $hotel->id, 'hotel_id' => $hotel->name];
        //                 }
        //             }
        //             else{
        //                 $hotelList = null;
        //             }
        //             $result['kotaList'][] = ['kota_id' => $kota->id,'kota' => $kota->namaKota, 'hotelList' => $hotelList];
        //             unset($hotelList);
        //         }
        //     } else {
        //         $hotels = kota::select('hotel.name', 'hotel.id')->join('alamat', 'kota.id', 'alamat.kota_id')->join('hotel', 'alamat.hotel_id', 'hotel.id')->where('hotel.name', 'like', $query)->get();
        //         if ($hotels->count() > 0) {
        //             foreach ($hotels as $hotel) {
        //                 $result['hotel_list'][] = ['hotel_id' => $hotel->id, 'hotel' => $hotel->name];
        //             }
        //         }
        //     }
        // }

        // if (isset($result['provinsiList'])) {
        //     foreach($result['provinsiList'] as $provList)
        //     $kotas = kota::select('namaKota', 'kota.id')->where('namaKota', $query)->orWhere('provinsi_id', $provList['provinsi_id'])->get();
        // } else {
        //     $kotas = kota::select('namaKota', 'kota.id')->where('namaKota', $query)->get();
        // }
        // if($kotas->count() > 0){
        //     foreach($kotas as $kota)
        //     if(!array_key_exists('kotaList',$result)) $result['provinsiList']['kotaList'][] = ['kota' => $kota->namaKota, 'kota_id' => $kota->id];
        //     else $result['provinsiList']['kotaList'][] = ['kota' => $kota->namaKota, 'kota_id' => $kota->id];
        // }

        // if(isset($result['provinsiList'] && isset($result['kotaList'])){
        //     foreach($provinsiList as $result)
        //     $hotel = kota::select('hotel.name','hotel.id')->join('alamat','kota.id','alamat.kota_id')->join('hotel','alamat.hotel_id','hotel.id')->where('kota.id',$result['kotaList'])
        // }

        return json_encode($result,JSON_HEX_TAG);
    }
}
