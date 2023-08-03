<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetil;
use App\Models\Typebarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    public function index()
    {
        // return $request->all();
        // $sekolah = getSekolahData();
        // $transaksi = Transaksi::get();
        // $perusahaan = Perusahaan::get();
        // $TransaksiDetil = $transaksi
        //     ->transaksidetil()
        //     ->join('typebarang', 'transaksidetil.kodetype', '=', 'typebarang.kodetype')
        //     ->get();
        // $transaksiDetil = TransaksiDetil::join('transaksi', 'transaksidetil.transaksi_id', '=', 'transaksi.id')
        //     ->join('typebarang', 'transaksidetil.kodetype', '=', 'kodetype')
        //     ->select('transaksidetil.*', 'typebarang.nama AS typebarang_nama')
        //     ->where('transaksi.id', $transaksiId)
        //     ->get();
         $transaksidetil = Transaksidetil::join('transaksi', 'transaksi_detils.transaksi_id', '=', 'transaksi.id')
        ->select('transaksi_detils.*', 'transaksi.kode_transaksi', 'transaksi.tanggal', 'transaksi.perusahaan')
        ->get();
    
        // return view('users', compact('users'));
        // return $sekolah;
        return view('sbj.laporan.laporanharian', compact('transaksidetil'));
    }
    public function indexhargajual()
    {
        // return $request->all();
        // $sekolah = getSekolahData();
        // $transaksi = Transaksi::get();
        // $perusahaan = Perusahaan::get();
        // $TransaksiDetil = $transaksi
        //     ->transaksidetil()
        //     ->join('typebarang', 'transaksidetil.kodetype', '=', 'typebarang.kodetype')
        //     ->get();
        // $transaksiDetil = TransaksiDetil::join('transaksi', 'transaksidetil.transaksi_id', '=', 'transaksi.id')
        //     ->join('typebarang', 'transaksidetil.kodetype', '=', 'kodetype')
        //     ->select('transaksidetil.*', 'typebarang.nama AS typebarang_nama')
        //     ->where('transaksi.id', $transaksiId)
        //     ->get();
         $transaksidetil = Transaksidetil::join('transaksi', 'transaksi_detils.transaksi_id', '=', 'transaksi.id')
        ->select('transaksi_detils.*', 'transaksi.kode_transaksi', 'transaksi.tanggal', 'transaksi.perusahaan')
        ->get();
    
        // return view('users', compact('users'));
        // return $sekolah;
        return view('sbj.laporan.laporanharianhargajual', compact('transaksidetil'));
    }
    public function indexminggu()
    {
        // $tanggal1 = $request->input('tanggal1');
        // $tanggal2 = $request->input('tanggal2');
         $transaksidetil = Transaksidetil::join('transaksi', 'transaksi_detils.transaksi_id', '=', 'transaksi.id')
        ->select('transaksi_detils.*', 'transaksi.kode_transaksi', 'transaksi.tanggal', 'transaksi.perusahaan')
        ->get();
        // $transaksidetilcari = Transaksidetil::whereBetween('tanggal', [$tanggal1, $tanggal2])->get();
        // return view('users', compact('users'));
        // return $sekolah;
        return view('sbj.laporan.laporanmingguan', compact('transaksidetil'));
    }
    // public function search(Request $request)
    // {
    //     return view('search_results', compact('transaksidetil'));
    // }
}
