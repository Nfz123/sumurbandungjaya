<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetil;
use App\Models\Typebarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DataTables;
class TransaksiController extends Controller
{
    public function getData(Request $request)
    {
        $data = TypeBarang::all();

        return response()->json($data);
    }
    public function create()
    {
        $now = Carbon::now();
        $years = $now->year;
        $table_no = Transaksi::count('kode_transaksi');
        $gar = '-';
        $no = 'INV' . $years . $table_no;
        $auto = substr($no, 7);
        $auto = intval($auto) + 1;
        $doku =  substr($no, 3, 4) . $gar . str_repeat('0', 5 - strlen($auto)) . $auto . 'SBJ3-DSC';

        $typebarang = Typebarang::get();
        return view('sbj.transaksi.create', compact('typebarang', 'doku'));
    }

    public function simpantrans(Request $request)
    {
        $transaksi = Transaksi::create([
            'kode_transaksi' => $request->input('kode_transaksi'),
            'tanggal' => $request->input('tanggal'),
            'perusahaan' => $request->input('perusahaan'),
        ]);
        for ($i = 0; $i < count($request->kodetype); $i++) {
            if (!empty($request->kodetype[$i]) && !empty($request->namatype[$i]) && !empty($request->uom[$i]) && !empty($request->qty[$i]) && !empty($request->ppn[$i]) && !empty($request->hargajual[$i])) {
                $transaksiDetil = new TransaksiDetil();
                $transaksiDetil->transaksi_id = $transaksi->id;
                $transaksiDetil->kodetype = $request->kodetype[$i];
                $transaksiDetil->namatype = $request->namatype[$i];
                $transaksiDetil->uom = $request->uom[$i];
                $transaksiDetil->qty = $request->qty[$i];
                $transaksiDetil->ppn = $request->ppn[$i];
                $transaksiDetil->hargajual = $request->hargajual[$i];
                $transaksiDetil->save();
            }
        }
        // Berikan respons atau lakukan tindakan lainnya setelah data berhasil disimpan

        return response()->json(['message' => 'Data saved successfully']);
    }
}
