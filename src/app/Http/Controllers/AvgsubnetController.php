<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvgsubnetController extends Controller
{
    function index()
    {
        $data = DB::table('speedtest_users')->select(DB::raw('subnet, FORMAT(AVG(dl),2) as dl,FORMAT(AVG(ul),2) as ul,FORMAT(AVG(ping),2) as ping,FORMAT(AVG(jitter),2) as jitter'))->where('apname','!=','undefine')->groupBy('subnet')->paginate(1000);
        return view('graph.avgsubnet', compact('data'));
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = DB::table('speedtest_users')
                ->select(DB::raw('subnet, FORMAT(AVG(dl),2) as dl,FORMAT(AVG(ul),2) as ul,FORMAT(AVG(ping),2) as ping,FORMAT(AVG(jitter),2) as jitter'))
                ->where('apname','!=','undefine')
                ->where('subnet', 'like', '%'.$query.'%')
                ->groupBy('subnet')
                ->paginate(1000);
            return view('graph.avgsubnet_data', compact('data'))->render();
        }
    }
}
