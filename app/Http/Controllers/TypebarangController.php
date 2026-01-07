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
    public function search(Request $request)
    {
        $search = $request->q;

        $result = Typebarang::where('namatype', 'like', '%' . $search . '%')
                    ->orWhere('merek', 'like', '%' . $search . '%')
                    ->limit(10)
                    ->get(['id', 'namatype', 'merek']);

        return response()->json($result);
    }
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
        $no = 'SBJ' . $years . $table_no;
        $auto = substr($no, 7);
        $auto = intval($auto) + 1;
        $doku = 'SBJ' . substr($no, 3, 4) . $gar . str_repeat('0', 5 - strlen($auto)) . $auto;
        
        $typebarang = Typebarang::get();

        // // return view('users', compact('users'));
        return view('sbj.mastertype.create', compact('doku', 'typebarang'));
    }

    public function store(Request $request)
    {
        try {
            $typebarang = new Typebarang();
            $typebarang->kodetype = $request->input('kodetype');
            // Tambahan: simpan gambar jika ada
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/typebarang', $filename); // simpan di storage/app/public/typebarang
                $typebarang->gambar = $filename; // pastikan ada kolom 'gambar' di tabel
            }
            $typebarang->namatype = $request->input('namatype');
            $typebarang->merek = $request->input('merek');
            $typebarang->no_rangka = $request->input('no_rangka');
            $typebarang->no_mesin = $request->input('no_mesin');
            $typebarang->pajak_tahun = $request->input('pajak_tahun');
            $typebarang->pajak_kir = $request->input('pajak_kir');
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
    public function deleteTypebarang($id)
    {
    
            $typebarang = Typebarang::findOrFail($id); // Mengambil data typebarang berdasarkan ID
            $typebarang->delete(); // Menghapus data
    }

    public function getTypebarang($id)
    {
        $typebarang = Typebarang::findOrFail($id); // Mengambil data typebarang berdasarkan ID
        return response()->json($typebarang); // Mengembalikan data dalam format JSON
    }
    public function updateTypebarang(Request $request, $id)
    {
        $typebarang = Typebarang::findOrFail($id);

        $typebarang->namatype = $request->namatype;
        $typebarang->merek = $request->input('merek');
        $typebarang->no_rangka = $request->input('no_rangka');
        $typebarang->no_mesin = $request->input('no_mesin');
        $typebarang->pajak_tahun = $request->input('pajak_tahun');
        $typebarang->pajak_kir = $request->input('pajak_kir');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/typebarang', $filename);
            $typebarang->gambar = $filename;
        }

        $typebarang->save();

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }
    // public function updateTypebarang(Request $request, $id)
    // {
    //     $typebarang = Typebarang::findOrFail($id); // Mengambil data typebarang berdasarkan ID
    //     $typebarang->namatype = $request->input('namatype');
    //     $typebarang->merek = $request->input('merek');
    //     $typebarang->no_rangka = $request->input('no_rangka');
    //     $typebarang->no_mesin = $request->input('no_mesin');
    //     $typebarang->pajak_tahun = $request->input('pajak_tahun');
    //     $typebarang->pajak_kir = $request->input('pajak_kir');
    //  // Cek apakah ada file gambar baru yang diupload
    //     if ($request->hasFile('gambar')) {
    //         $file = $request->file('gambar');

    //         // Hapus gambar lama jika ada dan file lama ada di storage
    //         if ($typebarang->gambar && \Storage::exists('public/typebarang/' . $typebarang->gambar)) {
    //             \Storage::delete('public/typebarang/' . $typebarang->gambar);
    //         }

    //         // Simpan gambar baru
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $file->storeAs('public/typebarang', $filename);
    //         $typebarang->gambar = $filename;
    //     }
    //     $typebarang->save(); // Simpan perubahan

    //    // return redirect()->route('Typebarang.index')->with('success', 'Data updated successfully');
    // }
}
