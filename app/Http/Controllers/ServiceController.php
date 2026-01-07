<?php

namespace App\Http\Controllers;

use App\Models\Serviced;
use App\Models\ServicedDetil;
use App\Models\Typebarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
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
        $table_no = Serviced::count('kode_serviced');
        $gar = '-';
        $no = 'SBJ' . $years . $table_no;
        $auto = substr($no, 7);
        $auto = intval($auto) + 1;
        $doku =  substr($no, 3, 4) . $gar . str_repeat('0', 5 - strlen($auto)) . $auto . 'SBJ_Srv';

        $typebarang = Typebarang::get();
        return view('sbj.serviced.create', compact('typebarang', 'doku'));
    }

    public function simpanserviced(Request $request)
    {
        // ✅ Validasi dasar
        $request->validate([
            'kode_serviced' => 'required',
            'tanggal'       => 'required|date',
            'perusahaan'    => 'required',
        ]);

        DB::beginTransaction();

        try {
            // ✅ Simpan data utama (serviced)
            $serviced = Serviced::create([
                'kode_serviced' => $request->input('kode_serviced'),
                'tanggal'       => $request->input('tanggal'),
                'perusahaan'    => $request->input('perusahaan'),
            ]);

            // ✅ Simpan data detil (serviced_detil)
            for ($i = 0; $i < count($request->kodetype); $i++) {
                if (
                    !empty($request->kodetype[$i]) &&
                    !empty($request->namatype[$i]) &&
                    !empty($request->barang[$i]) &&
                    !empty($request->qty[$i]) &&
                    !empty($request->harga[$i]) &&
                    !empty($request->total[$i])
                ) {
                    ServicedDetil::create([
                        'serviced_id' => $serviced->id,
                        'kodetype'    => $request->kodetype[$i],
                        'namatype'    => $request->namatype[$i],
                        'barang'      => $request->barang[$i],
                        'qty'         => $request->qty[$i],
                        'harga'       => $request->harga[$i],
                        'total'       => $request->total[$i],
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Data berhasil disimpan',
                'id'      => $serviced->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Gagal menyimpan data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function laporanServiced()
    {
        return view('sbj.serviced.serviced');
    }

    public function cariLaporanServiced(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

    $data = DB::table('serviced')
    ->join('serviced_detil', 'serviced.id', '=', 'serviced_detil.serviced_id')
    ->whereBetween('serviced.tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
    ->orderBy('serviced.tanggal')
    ->select(
        'serviced.id as serviced_id',
        'serviced_detil.id as detil_id',

        'serviced.kode_serviced',
        'serviced.tanggal',
        'serviced_detil.kodetype',
        'serviced_detil.namatype',
        'serviced_detil.barang',
        'serviced_detil.qty',
        'serviced_detil.harga',
        'serviced_detil.id',
        'serviced_detil.total'
    )
    ->get();



        return view('sbj.serviced.serviced', compact('data') + [
                'tanggal_awal' => $request->tanggal_awal,
                'tanggal_akhir' => $request->tanggal_akhir,
            ]);
    }
    public function edit($id)
    {
        $data = ServicedDetil::findOrFail($id);
        return view('sbj.serviced.servicededit', compact('data'));
    }
public function update(Request $request, $id)
{
    $request->validate([
        'barang' => 'required|string',
        'qty'    => 'required|numeric',
        'harga'  => 'required|numeric',
    ]);

    // Cari data berdasarkan ID serviced_detil
    $detil = ServicedDetil::findOrFail($id);

    $detil->barang = $request->barang;
    $detil->qty    = $request->qty;
    $detil->harga  = $request->harga;
    $detil->total  = $request->qty * $request->harga;

    $detil->save();

    return redirect()->back()->with('success', 'Data berhasil diperbarui.');
}

public function destroy($id)
{
    $data = ServicedDetil::findOrFail($id);
    $data->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus.');
}


}
