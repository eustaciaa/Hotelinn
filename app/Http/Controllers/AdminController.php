<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\hotel;
use App\history;

class AdminController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::count();
        $hotel = hotel::count();
        $order = history::count();

        return view('pane')->with(['user' => $user,'hotel' => $hotel,'order' => $order]);
    }

    public function showUserStat(){
        $user = User::count();

        return view('admin.userStat')->with(['user' => $user]);
    }

    public function showOrderStat(){
        $history = History::count();

        return view('admin.orderStat')->with(['order' => $history]);
    }

    public function getUserCount(){

        // $users = factory(User::class, 100)->create();

        $users = User::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $usermcount = [];
        $result = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if (!empty($usermcount[$i])) {
                if($i == 1) {
                    $result[$i] = $usermcount[$i];
                } else {
                    $result[$i] = $result[$i-1] + $usermcount[$i];
                }
            } else {
                if($i == 1) {
                    $result[$i] = 0;
                } else {
                    $result[$i] = $result[$i-1];
                }
            }
        }

        foreach($result as $res){
            $resultFinal[] = $res;
        }

        return json_encode($resultFinal);
    }

    public function getUserCountDetails(){

        // $users = factory(User::class, 100)->create();

        $users = User::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $usermcount = [];
        $result = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                $result[$i] = $usermcount[$i];
            } else {
                $result[$i] = 0;
            }
        }

        foreach($result as $res){
            $resultFinal[] = $res;
        }

        return json_encode($resultFinal);
    }

    public function showHotelStat(){
        $hotel = hotel::count();

        return view('admin.hotelStat')->with(['hotel' => $hotel]);
    }

    public function getHotelCount(){

        // $users = factory(User::class, 100)->create();

        // $result = hotel::selectRaw("MONTHNAME(created_at AS Month, ifnull(count(*),0)  as count")->groupByRaw('MONTHNAME(created_at)')->orderByRaw('MONTH(created_at)')->get();

        $hotels = hotel::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $hotelmcount = [];
        $result = [];

        foreach ($hotels as $key => $value) {
            $hotelmcount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($hotelmcount[$i])) {
                if($i == 1) {
                    $result[$i] = $hotelmcount[$i];
                } else {
                    $result[$i] = $result[$i-1] + $hotelmcount[$i];
                }
            } else {
                if($i == 1) {
                    $result[$i] = 0;
                } else {
                    $result[$i] = $result[$i-1];
                }
            }
        }
        foreach($result as $res){
            $resultFinal[] = $res;
        }


        return json_encode($resultFinal);

    }

    public function getHotelCountDetails(){

        // $users = factory(User::class, 100)->create();

        // $result = hotel::selectRaw("MONTHNAME(created_at AS Month, ifnull(count(*),0)  as count")->groupByRaw('MONTHNAME(created_at)')->orderByRaw('MONTH(created_at)')->get();

        $hotels = hotel::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $hotelmcount = [];
        $result = [];

        foreach ($hotels as $key => $value) {
            $hotelmcount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($hotelmcount[$i])) {
                    $result[$i] = $hotelmcount[$i];
            } else {
                    $result[$i] = 0;
            }
        }
        foreach($result as $res){
            $resultFinal[] = $res;
        }


        return json_encode($resultFinal);

    }

    public function getOrderCount(){

        // $users = factory(User::class, 100)->create();

        $history = history::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $historymcount = [];
        $result = [];

        foreach ($history as $key => $value) {
            $historymcount[(int)$key] = count($value);
        }
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($historymcount[$i])) {
                if($i == 1) {
                    $result[$i] = $historymcount[$i];
                } else {
                    $result[$i] = $result[$i-1] + $historymcount[$i];
                }
            } else {
                if($i == 1) {
                    $result[$i] = 0;
                } else {
                    $result[$i] = $result[$i-1];
                }
            }
        }

        foreach($result as $res){
            $resultFinal[] = $res;
        }

        return json_encode($resultFinal);
    }

    public function getOrderCountDetails(){

        // $users = factory(User::class, 100)->create();

        $history = history::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $historymcount = [];
        $result = [];

        foreach ($history as $key => $value) {
            $historymcount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($historymcount[$i])) {
                $result[$i] = $historymcount[$i];
            } else {
                $result[$i] = 0;
            }
        }

        foreach($result as $res){
            $resultFinal[] = $res;
        }

        return json_encode($resultFinal);
    }
}
