<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Typebarang;
use Carbon\Carbon;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use DataTables;

class TypebarangController extends Controller
{
    
    public function index()
    {
        // $sekolah = getSekolahData();
        $typebarang = Typebarang::get();
        // $perusahaan = Perusahaan::get();
        // Lembaga::get();
        // return view('users', compact('users'));
        // return $sekolah;
        return view('sbj.mastertype.index', compact('typebarang'));
    }
    public function create()
    {
        $now = Carbon::now();
        $years = $now->year;
        $table_no = Typebarang::count('kodetype');
        $gar = '-';
        $no = 'INV' . $years . $table_no;
        $auto = substr($no, 7);
        $auto = intval($auto) + 1;
        $doku = 'INV' . substr($no, 3, 4) . $gar . str_repeat('0', 5 - strlen($auto)) . $auto;
        
        $typebarang = Typebarang::get();

        // // return view('users', compact('users'));
        return view('sbj.mastertype.create', compact('doku', 'typebarang'));
    }

    public function store(Request $request)
    {
        try {
            $typebarang = new Typebarang();
            $typebarang->kodetype = $request->input('kodetype');
            $typebarang->namatype = $request->input('namatype');
            $typebarang->uom = $request->input('uom');
            $typebarang->hargalama = $request->input('hargalama');
            $typebarang->hargabaru = $request->input('hargabaru');
            $typebarang->ppn = $request->input('ppn');
            $typebarang->hargajual = $request->input('hargajual');
            $typebarang->save();
            
            return redirect()
                ->route('Typebarang.index')
                ->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()
                ->route('Typebarang.index')
                ->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
    public function hapus($id)
    {
        $typebarang = Typebarang::findOrFail($id);
        $typebarang->delete();
        return response()->json(['message' => 'Data berhasil dihapus.']);
    }

    public function edit($id)
    {
        $typebarang = Typebarang::findOrFail($id);
        return response()->json([
            'namatype' => $namatype->namatype,
            'satuan' => $satuan->satuan,
            'namatype' => $namatype,
            'uom' => $uom,
            'hargalama' => $hargalama,
            'hargabaru' => $hargabaru,
            'ppn' => $ppn,
            'hargajual' => $hargajual
        ]);
    }
    public function update(Request $request, $id)
    {
        $typebarang = Typebarang::findOrFail($id);
        // $typebarang->namatype = $request->input('namatype');
        // $typebarang->satuan = $request->input('satuan');
        $typebarang->namatype = $request->input('namatype');
        $typebarang->uom = $request->input('uom');
        $typebarang->hargalama = $request->input('hargalama');
        $typebarang->hargabaru = $request->input('hargabaru');
        $typebarang->ppn = $request->input('ppn');
        $typebarang->hargajual = $request->input('hargajual');
        $typebarang->save();

        return redirect()
            ->route('Typebarang.index')
            // ->back()
            ->with('success', 'Data berhasil disimpan !');
    }
}
