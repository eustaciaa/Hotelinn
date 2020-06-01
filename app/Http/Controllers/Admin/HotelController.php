<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\hotel;
use App\alamat;
use App\provinsi;
use App\history;
use App\room_details;

class HotelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(alamat::all());
        // dd(hotel::all());
        return view('admin.hotel-index')->with(['hotels' => hotel::withTrashed()->get(), 'provinsis' => provinsi::all()]);
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
            'rating' => 'nullable|numeric',
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

        $hotelFilename = strtolower(str_replace(" ","-",$request->name));

        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); //image extension
            $filename = '/images/hotel/'. $hotelFilename . '/home' . '.' . $extension;
            $file->move('images/hotel/'.$hotelFilename.'/', $filename);
            $hotel->photo = $filename;
        } else {
            return redirect('/admin/hotels')->with('unstatus', 'Hotel tidak berhasil ditambahkan !');
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
     * @param  \App\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        return view('admin.edit-hotel', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required|max:255',
            'star' => 'required',
            'rating' => 'nullable|numeric',
            'reviewers' => 'nullable',
            'photo' => 'image|max:1000'
        ]);

        Hotel::where('id', $hotel->id)
        ->update([
            'name' => $request->name,
            'star' => $request->star,
            'rating' => $request->rating,
            'reviewers' => $request->reviewers
        ]);

        $hotelFilename = strtolower(str_replace(" ","-",$request->name));

        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); //image extension
            $filename = '/images/hotel/'. $hotelFilename . '/home' . '.' . $extension;
            $file->move('images/hotel/'.$hotelFilename.'/', $filename);
            $hotel->photo = $filename;
        } else {
            return redirect('/admin/hotels')->with('unstatus', 'Hotel berhasil diubah dengan gambar yang sama !');
            $hotel->photo = '';
        }
        $hotel->save();

        return redirect('/admin/hotels')->with('status', 'Hotel berhasil diubah !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\hotel  $hotel
     * @return \Illuminate\Http\Response
     */

    public function editAlamat(Hotel $hotel)
    {
        return view('admin.edit-alamat', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function updateAlamat(Request $request, Hotel $hotel)
    {
        $request->validate([
            'namaProvinsi' => 'required',
            'namaKota' => 'required',
            'detailLengkap' => 'required|max:255'
        ]);

        Alamat::where('hotel_id', $hotel->id)
        ->update([
            'detailLengkap' => $request->detailLengkap,
            'provinsi_id' => $request->namaProvinsi,
            'kota_id' => $request->namaKota
        ]);

        return redirect('/admin/hotels')->with('status', 'Alamat Hotel berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {

        Hotel::destroy($hotel->id);
        $rooms = room_details::where('hotel_id',$hotel->id)->get();
        foreach($rooms as $room)
        {
            $room->delete();
        }


        return redirect('/admin/hotels')->with('status', 'Hotel berhasil dihapus !');
    }

    public function orderList(){
        return view('admin.orderList')->with(['histories' => history::all()]);
    }

    public function detailOrder($history){
        $order = history::where('id',$history)->get()->all();

        return view('admin.detailOrder')->with('histories',$order);
    }

    public function confirm($history){
        $true = 1;
        $confirm = history::where('id',$history)->update([
            'confirmed' =>  $true
        ]);

        return redirect()->back();
    }

    public function unconfirm($history){
        $false = 0;
        $confirm = history::where('id',$history)->update([
            'confirmed' =>  $false
        ]);

        return redirect()->back();
    }

    public function finish($history){
        $true = 1;
        $confirm = history::where('id',$history)->update([
            'finished' =>  $true
        ]);

        return redirect()->back();
    }

    public function unfinish($history){
        $false = 0;
        $confirm = history::where('id',$history)->update([
            'finished' =>  $false
        ]);

        return redirect()->back();
    }

    public function restore($id)
    {
         hotel::onlyTrashed()->find($id)->restore();

         $rooms = room_details::where('hotel_id',$id)->onlyTrashed()->get();
        foreach($rooms as $room)
        {
            $room->restore();
        }
         return redirect('/admin/hotels')->with('status', 'Hotel berhasil dipulihkan !');
    }

}
