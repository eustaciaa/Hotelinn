<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\hotel;
use App\room_details;

class RoomsController extends Controller
{
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

        return view('admin.room-index')->with(['room_details' => room_details::withTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Hotel $hotel)
    {
        return view('admin/add-room', compact('hotel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required|max:255',
            'available' => 'required|numeric',
            'capacity' => 'required',
            'cost' => 'required|numeric',
            'photo' => 'required|image|max:1000',
            'freeWifi' => 'required',
            'noSmoking' => 'required',
            'shower' => 'nullable|max:255',
            'scenery' => 'nullable|max:255',
            'entertainment' => 'nullable|max:255',
            'convenience' => 'nullable|max:255',
            'furniture' => 'nullable|max:255',
            'service' => 'nullable|max:255',
            'security_safety' => 'nullable|max:255',
            'laundry' => 'nullable|max:255',
            'food' => 'nullable|max:255',
        ]);

        $room_detail = new room_details();
        $room_detail->hotel_id = $hotel->id;
        $room_detail->name = $request->name;
        $room_detail->available = $request->available;
        $room_detail->capacity = $request->capacity;
        $room_detail->cost = $request->cost;

        $roomFilePath = strtolower(str_replace(" ","-",$hotel->name));
        $roomFileName = strtolower(str_replace(" ","-",$request->name));

        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); //image extension
            $filename = '/images/hotel/'.$roomFilePath.'/' . $roomFileName . '.' . $extension;
            $file->move('images/hotel/'.$roomFilePath.'/', $filename);
            $room_detail->photo = $filename;
        } else {
            return redirect('/admin/rooms')->with('unstatus', 'Kamar hotel tidak berhasil ditambahkan !');
            $room_detail->photo = '';
        }

        $room_detail->freeWifi = $request->freeWifi;
        $room_detail->noSmoking = $request->noSmoking;
        $room_detail->shower = $request->shower;
        $room_detail->scenery = $request->scenery;
        $room_detail->entertainment = $request->entertainment;
        $room_detail->convenience = $request->convenience;
        $room_detail->furniture = $request->furniture;
        $room_detail->service = $request->service;
        $room_detail->security_safety = $request->security_safety;
        $room_detail->laundry = $request->laundry;
        $room_detail->food = $request->food;
        $room_detail->save();

        return redirect('/admin/rooms')->with('status', 'Kamar hotel baru berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\room_details  $room_detail
     * @return \Illuminate\Http\Response
     */
    public function show(room_details $room_detail)
    {
        return view('admin.room-detail', compact('room_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\room_details  $room_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(room_details $room_detail)
    {
        return view('admin.edit-room', compact('room_detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\room_details  $room_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, room_details $room_detail)
    {
        $request->validate([
            'name' => 'required|max:255',
            'available' => 'required|numeric',
            'capacity' => 'required',
            'cost' => 'required|numeric',
            'photo' => 'required|image|max:1000',
            'freeWifi' => 'required',
            'noSmoking' => 'required',
            'shower' => 'nullable|max:255',
            'scenery' => 'nullable|max:255',
            'entertainment' => 'nullable|max:255',
            'convenience' => 'nullable|max:255',
            'furniture' => 'nullable|max:255',
            'service' => 'nullable|max:255',
            'security_safety' => 'nullable|max:255',
            'laundry' => 'nullable|max:255',
            'food' => 'nullable|max:255',
        ]);

        room_details::where('id', $room_detail->id)
        ->update([
            'name' => $request->name,
            'available' => $request->available,
            'capacity' => $request->capacity,
            'cost' => $request->cost,
            'freeWifi' => $request->freeWifi,
            'noSmoking' => $request->noSmoking,
            'shower' => $request->shower,
            'scenery' => $request->scenery,
            'entertainment' => $request->entertainment,
            'convenience' => $request->convenience,
            'furniture' => $request->furniture,
            'service' => $request->service,
            'security_safety' => $request->security_safety,
            'laundry' => $request->laundry,
            'food' => $request->food
        ]);

        $roomFilePath = strtolower(str_replace(" ","-",$room_detail->hotel->name));
        $roomFileName = strtolower(str_replace(" ","-",$request->name));

        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); //image extension
            $filename = '/images/hotel/'.$roomFilePath.'/' . $roomFileName . '.' . $extension;
            $file->move('images/hotel/'.$roomFilePath.'/', $filename);
            $room_detail->photo = $filename;
        } else {
            return redirect('/admin/rooms')->with('unstatus', 'Kamar hotel berhasil diubah dengan gambar yang sama !');
            $room_detail->photo = '';
        }
        $room_detail->save();

        return redirect('/admin/rooms')->with('status', 'Kamar hotel berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\room_details  $room_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(room_details $room_detail)
    {
        room_details::destroy($room_detail->id);
        return redirect('/admin/rooms')->with('status', 'Kamar hotel berhasil dihapus !');
    }

    public function restore($id){
        room_details::onlyTrashed()->find($id)->restore();

        return redirect('/admin/rooms')->with('status', 'Kamar hotel berhasil dipulihkan !');
    }
}
