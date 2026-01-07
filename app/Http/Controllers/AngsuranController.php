<?php

namespace App\Http\Controllers;

use App\Models\Typebarang;
use App\Models\Angsuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DataTables;
class AngsuranController extends Controller
{

    public function getData()
    {
        $data = Typebarang::select('kodetype', 'namatype')->get();
        return response()->json($data);
    }
    public function create()
    {
        // $now = Carbon::now();
        // $years = $now->year;
        // $table_no = Angsuran::count('kode_transaksi');
        // $gar = '-';
        // $no = 'INV' . $years . $table_no;
        // $auto = substr($no, 7);
        // $auto = intval($auto) + 1;
        // $doku =  substr($no, 3, 4) . $gar . str_repeat('0', 5 - strlen($auto)) . $auto . 'SBJ3-DSC';

        $typebarang = Typebarang::get();
        return view('sbj.angsuran.create', compact('typebarang'));
    }
    public function index()
        {
        $angsurans = Angsuran::with('type')
        ->orderBy('tanggal_angsuran')
        ->get();
        $groupedAngsurans = $angsurans->groupBy('kodetype');
        return view('sbj.angsuran.index', compact('groupedAngsurans'));
        }
    public function store(Request $request)
    {
        $request->validate([
            'kode_id' => 'required',
            'kodetype' => 'required',
            'tanggal_angsuran' => 'required|date',
            'nominal_angsuran' => 'required',
        ]);

        // Bersihkan format Rp sebelum simpan
        $nominal = preg_replace('/[^0-9]/', '', $request->nominal_angsuran);

        Angsuran::create([
           'kode_id' => $request->kode_id,
            'kodetype' => $request->kodetype,
            'tanggal_angsuran' => $request->tanggal_angsuran,
            'nominal_angsuran' => $nominal,
        ]);

        return redirect()->back()->with('success', 'Data angsuran berhasil disimpan.');
    }
    public function print($kodetype)
{
    $angsuran = Angsuran::where('kodetype', $kodetype)->with('type')
    ->orderBy('tanggal_angsuran')->get();

    return view('sbj.angsuran.print', compact('angsuran', 'kodetype'));
}
}
