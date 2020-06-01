<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kota;
use App\alamat;

class AJAXController extends Controller
{
    /**
     * Show The Hotel List
     * @return json
     *
     */

    public function getHotel(Request $request)
    {
        $kotaId = $request->input('kotaId');
        $provinsiId = $request->input('provinsiId');
        $hotelId = $request->input('hotelId');
        $field = $request->input('field');
        $order = $request->input('order');
        $filter = $request->input('filter');
        $min = $request->input('min');
        $max = $request->input('max');


        if ($field != "none" && $order != "none" && $filter != "none") {
            if ($kotaId == 'all' && $provinsiId == 'all'){
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->whereBetween($filter, [$min , $max])->groupBy('alamat.hotel_id','hotel.photo','hotel.name','hotel.star','hotel.total_rating','hotel.reviewers','alamat.detailLengkap','kota.namaKota','provinsi.namaProvinsi','room_details.cost ')->orderBy($field,$order)->get();
            } elseif ($kotaId == 'all') {
                $query = ['alamat.provinsi_id' => $provinsiId];
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->whereBetween($filter, [$min , $max])->groupBy('alamat.hotel_id','hotel.photo','hotel.name','hotel.star','hotel.total_rating','hotel.reviewers','alamat.detailLengkap','kota.namaKota','provinsi.namaProvinsi','room_details.cost ')->orderBy($field,$order)->get();
            } elseif ($provinsiId == 'all') {
                $query = ['kota_id' => $kotaId];
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->whereBetween($filter, [$min , $max])->groupBy('alamat.hotel_id','hotel.photo','hotel.name','hotel.star','hotel.total_rating','hotel.reviewers','alamat.detailLengkap','kota.namaKota','provinsi.namaProvinsi','room_details.cost ')->orderBy($field,$order)->get();
            } else {
                $query = ['alamat.provinsi_id' => $provinsiId, 'kota_id' => $kotaId];
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->whereBetween($filter, [$min , $max])->groupBy('alamat.hotel_id','hotel.photo','hotel.name','hotel.star','hotel.total_rating','hotel.reviewers','alamat.detailLengkap','kota.namaKota','provinsi.namaProvinsi','room_details.cost ')->orderBy($field,$order)->get();
            }
        } elseif ($field != "none" && $order != "none") {
            if ($kotaId == 'all' && $provinsiId == 'all') {
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->groupBy('alamat.hotel_id','hotel.photo','hotel.name','hotel.star','hotel.total_rating','hotel.reviewers','alamat.detailLengkap','kota.namaKota','provinsi.namaProvinsi','room_details.cost ')->orderBy($field,$order)->get();
            } elseif ($kotaId == 'all') {
                $query = ['alamat.provinsi_id' => $provinsiId];
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')-->groupBy('alamat.hotel_id','hotel.photo','hotel.name','hotel.star','hotel.total_rating','hotel.reviewers','alamat.detailLengkap','kota.namaKota','provinsi.namaProvinsi','room_details.cost ')->orderBy($field,$order)->get();
            } elseif ($provinsiId == 'all') {
                $query = ['kota_id' => $kotaId];
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->groupBy('alamat.hotel_id','hotel.photo','hotel.name','hotel.star','hotel.total_rating','hotel.reviewers','alamat.detailLengkap','kota.namaKota','provinsi.namaProvinsi','room_details.cost ')->orderBy($field,$order)->get();
            } else {
                $query = ['alamat.provinsi_id' => $provinsiId, 'kota_id' => $kotaId];
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->groupBy('alamat.hotel_id','hotel.photo','hotel.name','hotel.star','hotel.total_rating','hotel.reviewers','alamat.detailLengkap','kota.namaKota','provinsi.namaProvinsi','room_details.cost ')->orderBy($field,$order)->get();
            }
        } elseif ($filter != "none") {
            if ($kotaId == 'all' && $provinsiId == 'all') {
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->whereBetween($filter, [$min , $max])->distinct()->get();
            } elseif ($kotaId == 'all') {
                $query = ['alamat.provinsi_id' => $provinsiId];
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->whereBetween($filter, [$min , $max])->distinct()->get();
            } elseif ($provinsiId == 'all') {
                $query = ['alamat.kota_id' => $kotaId];
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->whereBetween($filter, [$min , $max])->distinct()->get();
            } else {
                $query = ['alamat.provinsi_id' => $provinsiId, 'alamat.kota_id' => $kotaId];
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->whereBetween($filter, [$min , $max])->distinct()->get();
            }
        } else {
            if ($kotaId == 'all' && $provinsiId == 'all' && $hotelId == "all") {
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->distinct()->get();
            } elseif($kotaId == 'all' && $provinsiId == 'all') {
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->where('hotel.id',$hotelId)->distinct()->get();
            } elseif ($kotaId == 'all' && $hotelId == 'all') {
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where('alamat.provinsi_id',$provinsiId)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->join('kota','alama->distinct()t.kota_id','=','kota.id')->get();
            } elseif ($provinsiId == 'all' && $hotelId == "all") {
                $query = ['kota_id' => $kotaId];
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->distinct()->get();
            } else {
                $query = ['alamat.provinsi_id' => $provinsiId, 'kota_id' => $kotaId];
                $alamat = alamat::select('alamat.hotel_id as hotel_id','hotel.photo as photo','hotel.name as name','hotel.star as star','hotel.total_rating as rating','hotel.reviewers as reviewers','alamat.detailLengkap as detailLengkap','kota.namaKota as namaKota','provinsi.namaProvinsi as namaProvinsi','room_details.cost as cost')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','hotel.id','=','room_details.hotel_id')->distinct()->get();
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

    public function getMinMaxRating(Request $request){
        $kotaId = $request->input('kotaId');
        $provinsiId = $request->input('provinsiId');

        if($kotaId == 'all' && $provinsiId == 'all') {
            $alamat = alamat::selectRaw('MAX("total_rating") as Max, MIN("total_rating") as Min')->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->get();
        } elseif ($kotaId == 'all') {
            $query = ['kota_id' => $provinsiId];
            $alamat = alamat::selectRaw('MAX("total_rating") as Max, MIN("total_rating") as Min')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->get();
        } elseif ($provinsiId == 'all') {
            $query = ['kota_id' => $kotaId];
            $alamat = alamat::selectRaw('MAX("total_rating") as Max, MIN("total_rating") as Min')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->get();
        } else {
            $query = ['alamat.provinsi_id' => $provinsiId, 'alamat.kota_id' => $kotaId];
            $alamat = alamat::selectRaw('MAX("total_rating") as Max, MIN("total_rating") as Min')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->get();
        }

        return json_encode($alamat, JSON_HEX_TAG);
    }

    public function getMinMaxCost(Request $request){
        $kotaId = $request->input('kotaId');
        $provinsiId = $request->input('provinsiId');

        if($kotaId == 'all' && $provinsiId == 'all') {
            $alamat = alamat::selectRaw('MAX("cost") as Max, MIN("cost") as Min')->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','alamat.hotel_id','room_details.hotel_id')->get();
        } elseif ($kotaId == 'all') {
            $query = ['kota_id' => $provinsiId];
            $alamat = alamat::selectRaw('MAX("cost") as Max, MIN("cost") as Min')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','alamat.hotel_id','room_details.hotel_id')->get();
        } elseif ($provinsiId == 'all') {
            $query = ['kota_id' => $kotaId];
            $alamat = alamat::selectRaw('MAX("cost") as Max, MIN("cost") as Min')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','alamat.hotel_id','room_details.hotel_id')->get();
        } else {
            $query = ['alamat.provinsi_id' => $provinsiId, 'alamat.kota_id' => $kotaId];
            $alamat = alamat::selectRaw('MAX("cost") as Max, MIN("cost") as Min')->where($query)->join('hotel', 'alamat.hotel_id', '=', 'hotel.id')->join('kota','alamat.kota_id','=','kota.id')->join('provinsi','alamat.provinsi_id','=','provinsi.id')->join('room_details','alamat.hotel_id','room_details.hotel_id')->get();
        }

        return json_encode($alamat, JSON_HEX_TAG);
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
