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

        $Adownload = DB::table('speedtest_users')->select(DB::raw('ROUND(AVG(CAST(dl as float)),2) as adl'))->where('subnet','=','Jumbo wifi')->get();
        $Aupload = DB::table('speedtest_users')->select(DB::raw('ROUND(AVG(CAST(ul as float)),2) as aul'))->where('subnet','=','Jumbo wifi')->get();
        $Aping = DB::table('speedtest_users')->select(DB::raw('ROUND(AVG(CAST(ping as float)),2) as aping'))->where('subnet','=','Jumbo wifi')->get();
        $Ajitter = DB::table('speedtest_users')->select(DB::raw('ROUND(AVG(CAST(jitter as float)),2) as ajitter'))->where('subnet','=','Jumbo wifi')->get();

        $MXdownload = DB::table('speedtest_users')->select(DB::raw('MAX(CAST(dl as float)) as mxdl'))->where('subnet','=','Jumbo wifi')->get();
        $MXupload = DB::table('speedtest_users')->select(DB::raw('MAX(CAST(ul as float)) as mxul'))->where('subnet','=','Jumbo wifi')->get();
        $MXping = DB::table('speedtest_users')->select(DB::raw('MAX(CAST(ping as float)) as mxping'))->where('subnet','=','Jumbo wifi')->get();
        $MXjitter = DB::table('speedtest_users')->select(DB::raw('MAX(CAST(jitter as float)) as mxjitter'))->where('subnet','=','Jumbo wifi')->get();

        $MNdownload = DB::table('speedtest_users')->select(DB::raw('MIN(CAST(dl as float)) as mndl'))->where('subnet','=','Jumbo wifi')->get();
        $MNupload = DB::table('speedtest_users')->select(DB::raw('MIN(CAST(ul as float)) as mnul'))->where('subnet','=','Jumbo wifi')->get();
        $MNping = DB::table('speedtest_users')->select(DB::raw('MIN(CAST(ping as float)) as mnping'))->where('subnet','=','Jumbo wifi')->get();
        $MNjitter = DB::table('speedtest_users')->select(DB::raw('MIN(CAST(jitter as float)) as mnjitter'))->where('subnet','=','Jumbo wifi')->get();

        $SDdownload = DB::table('speedtest_users')->select(DB::raw('FORMAT(STDDEV_SAMP(CAST(dl as float)),2) as sddl'))->where('subnet','=','Jumbo wifi')->get();
        $SDupload = DB::table('speedtest_users')->select(DB::raw('FORMAT(STDDEV_SAMP(CAST(ul as float)),2) as sdul'))->where('subnet','=','Jumbo wifi')->get();
        $SDping = DB::table('speedtest_users')->select(DB::raw('FORMAT(STDDEV_SAMP(CAST(ping as float)),2) as sdping'))->where('subnet','=','Jumbo wifi')->get();
        $SDjitter = DB::table('speedtest_users')->select(DB::raw('FORMAT(STDDEV_SAMP(CAST(jitter as float)),2) as sdjitter'))->where('subnet','=','Jumbo wifi')->get();

        $address = '123 Bangkok';
        return view('home.index', compact('data','table','subnet','apname','Adownload','Aupload','Aping','Ajitter','MXdownload','MXupload','MXping','MXjitter','MNdownload','MNupload','MNping','MNjitter','SDdownload','SDupload','SDping','SDjitter'));
    }
}