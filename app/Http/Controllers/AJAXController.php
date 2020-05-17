<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kota;

class AJAXController extends Controller
{
    public function getKota(Request $request)
    {
        if($request->input('provinsi') == 'all'){
            return json_encode(kota::get(), JSON_HEX_TAG);
        }
        return json_encode(kota::where('provinsi_id',$request->input('provinsi'))->get(), JSON_HEX_TAG);
    }
}
