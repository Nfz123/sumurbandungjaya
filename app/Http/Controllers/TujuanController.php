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
            'uangjalan' => 'required|string|max:255',
            'ritasi' => 'required|string|max:255',
        ]);

        $tujuan = Tujuan::create([
            'namatujuan' => $request->namatujuan,
            'lokasi' => $request->lokasi,
            'uangjalan' => $request->uangjalan,
            'ritasi' => $request->ritasi,
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
    // ambil data
public function edit($id)
{
    $tujuan = Tujuan::findOrFail($id);

    return response()->json([
        'status' => 'success',
        'data' => $tujuan
    ]);
}

// update
public function update(Request $request, $id)
{
    $request->validate([
        'namatujuan' => 'required',
        'lokasi'     => 'required',
        'uangjalan'  => 'required',
        'ritasi'     => 'required',
    ]);

    $tujuan = Tujuan::findOrFail($id);
    $tujuan->update($request->all());

    return response()->json([
        'status' => 'success'
    ]);
}




}
