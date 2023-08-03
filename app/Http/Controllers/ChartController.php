<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetil;
use App\Models\Typebarang;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        $data = TransaksiDetil::all();
        return view('sbj.chart.index', compact('data'));
    }
}
