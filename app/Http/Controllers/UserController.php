<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\history;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{   

    public function history(Request $request)
    {
        $history = history::where('user_id',Auth::user()->id)->orderBy('id','asc')->get()->all();

        return view('user.history')->with('histories',$history);
    }

    public function profile (Request $request)
    {   
            
        return view('user.profile');
    
    }

    public function updateProfile(Request $request){

        $f_name = $request->input('fName');
        $l_name = $request->input('lName');
        $birthdate = $request->input('birthdate');

        $updateProfile = User::where('id', Auth::user()->id)->update([
            'fName' => $f_name,
            'lName' => $l_name,
            'birthdate' => $birthdate
        ]);

        return redirect(view('home.home'));
        
    }

}
