<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request) 
    {
        // $total = DB::select(DB:raw("SELECT username FROM users where email='test@hotmail.com'"));
        $data = DB::table('speedtest_users')->select(DB::raw('date(timestamp) as tt, count(*) as co'))->groupBy('tt')->get();

        $table = DB::table('speedtest_users')->select(DB::raw('timestamp,ip,userid,dl,ul,ping,subnet,apname'))->paginate(8);
        
        $subnet = DB::table('speedtest_users')->select(DB::raw('subnet, count(*) as co'))->groupBy('subnet')->orderBy('co','desc')->take(10)->get();

        $apname = DB::table('speedtest_users')->select(DB::raw('apname, count(*) as co'))->groupBy('apname')->orderBy('co','desc')->take(10)->get();

        $Adownload = DB::table('speedtest_users')->select(DB::raw('ROUND(AVG(dl),2) as adl'))->where('subnet','=','Jumbo wifi')->get();
        $Aupload = DB::table('speedtest_users')->select(DB::raw('ROUND(AVG(ul),2) as aul'))->where('subnet','=','Jumbo wifi')->get();
        $Aping = DB::table('speedtest_users')->select(DB::raw('ROUND(AVG(ping),2) as aping'))->where('subnet','=','Jumbo wifi')->get();
        $Ajitter = DB::table('speedtest_users')->select(DB::raw('ROUND(AVG(jitter),2) as ajitter'))->where('subnet','=','Jumbo wifi')->get();
        $address = '123 Bangkok';
        return view('home.index', compact('data','table','subnet','apname', 'Adownload','Aupload','Aping', 'Ajitter'));
    }
}