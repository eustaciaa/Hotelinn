<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\history;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function history(Request $request)
    {
        $history = history::where('user_id',Auth::user()->id)->orderBy('id','asc')->get()->all();

        return view('history')->with('histories',$history);
    }
}
