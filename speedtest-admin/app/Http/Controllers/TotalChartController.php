<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TotalChartController extends Controller
{
    public function index()
    {
        //$total = DB::select('SELECT id,COUNT(*) as co FROM users GROUP BY id');
        $address = '123 Bangkok';
        return View('index.home', compact('address'));
    }
}