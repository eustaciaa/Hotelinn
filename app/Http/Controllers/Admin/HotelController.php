<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\hotel;
use App\alamat;
use App\provinsi;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.hotel-index')->with(['hotels' => alamat::all(), 'provinsis' => provinsi::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/add-hotel');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'star' => 'required',
            'rating' => 'nullable',
            'reviewers' => 'nullable',
            'photo' => 'required|image|max:1000',
            'namaProvinsi' => 'required',
            'namaKota' => 'required',
            'detailLengkap' => 'required|max:255'
        ]);

        $hotel = new hotel();
        $hotel->name = $request->name;
        $hotel->star = $request->star;
        $hotel->rating = $request->rating;
        $hotel->reviewers = $request->reviewers;
        
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); //image extension
            $filename = '/images/hotel/' . time() . '.' . $extension;
            $file->move('images/hotel/', $filename);
            $hotel->photo = $filename;
        } else {
            return $request;
            $hotel->photo = '';
        }
        $hotel->save();

        $alamat = new alamat();
        $alamat->hotel_id = $hotel->id;
        switch ($request->namaProvinsi) {
            case 'DKI Jakarta':
                $alamat->provinsi_id = 1;
                break;
            
            case 'D.I Yogyakarta':
                $alamat->provinsi_id = 2;
                break;

            case 'Banten':
                $alamat->provinsi_id = 3;
                break;
        }
        switch ($request->namaKota) {
            case 'Jakarta':
                $alamat->kota_id = 1;
                break;
            
            case 'Yogyakarta':
                $alamat->kota_id = 2;
                break;

            case 'Tangerang':
                $alamat->kota_id = 3;
                break;
            
            case 'Tangerang Selatan':
                $alamat->kota_id = 4;
                break;
            
            case 'Serang':
                $alamat->kota_id = 5;
                break;
        }
        $alamat->detailLengkap = $request->detailLengkap;

        $alamat->save();
        return redirect('/admin/hotels')->with('status', 'Hotel baru berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        return view('admin.hotel-detail', compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
