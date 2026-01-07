<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tujuan;

class TujuanController extends Controller
{
    public function cekduplikat(Request $request)
    {
        $exists = Tujuan::where('namatujuan', $request->namatujuan)
                        ->where('lokasi', $request->lokasi)
                        ->exists();

        return response()->json(['exists' => $exists]);
    }
    public function simpan(Request $request)
    {
        $request->validate([
            'namatujuan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        $tujuan = Tujuan::create([
            'namatujuan' => $request->namatujuan,
            'lokasi' => $request->lokasi,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $tujuan
        ]);
    }

    public function index()
    {
         $tujuan = Tujuan::get();
        return view('sbj.tujuan.index', compact('tujuan'));
    }
    public function destroy($id)
    {
        $tujuan = Tujuan::findOrFail($id);
        $tujuan->delete();

        return response()->json(['status' => 'success']);
    }

}
