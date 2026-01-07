<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use App\Models\EkspedisiDetail;
use App\Models\Tujuan;
use App\Models\Supir;
use App\Models\Transaksi;
use App\Models\TransaksiDetil;
use App\Models\Typebarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DataTables;
class EkspedisiController extends Controller
{
    public function index()
    {
       
        return view('sbj.ekspedisi.index');
    }
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
        $supir= Supir::get();
         $tujuans = Tujuan::all(); 
        return view('sbj.ekspedisi.create', compact('tujuans','supir','typebarang', 'doku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'        => 'required|date',
            'jenis'          => 'required|string', // FIX: sebelumnya array
            'kendaraan_id'   => 'required|integer',
            'supir_id'       => 'required|integer',
            'tkbm'           => 'required|integer',
            'uangjalan'      => 'required|integer',
            'hargaritasi'    => 'required|integer',

            'nosalesorder'   => 'required|array',
            'nosalesorder.*' => 'required|string',

            'tujuan'         => 'required|array',
            'tujuan.*'       => 'required|string',

            'qty_terima'     => 'required|array',
            'qty_terima.*'   => 'nullable|numeric',

            'qty_tolak'      => 'required|array',
            'qty_tolak.*'    => 'nullable|numeric',
        ]);

        // Pastikan jumlah array detail sama
        $count = count($request->nosalesorder);
        if ($count !== count($request->tujuan)
            || $count !== count($request->qty_terima)
            || $count !== count($request->qty_tolak)) {
            return back()->withInput()->with('error',
                'Jumlah elemen nosalesorder/tujuan/qty_terima/qty_tolak tidak sama.'
            );
        }

        \DB::beginTransaction();

        try {

            // Simpan Header
            $ekspedisi = Ekspedisi::create([
                'tanggal'       => $request->tanggal,
                'jenis'         => $request->jenis, // FIX: langsung string
                'kendaraan_id'  => $request->kendaraan_id,
                'supir_id'      => $request->supir_id,
                'tkbm'          => $request->tkbm,
                'uangjalan'     => $request->uangjalan,
                'hargaritasi'   => $request->hargaritasi,
            ]);

            // Simpan Detail
            foreach ($request->nosalesorder as $index => $nosalesorder) {
                EkspedisiDetail::create([
                    'ekspedisi_id'  => $ekspedisi->id,
                    'nosalesorder'  => $nosalesorder,
                    'tujuan'        => $request->tujuan[$index] ?? null,
                    'qty_terima'    => $request->qty_terima[$index] ?? 0,
                    'qty_tolak'     => $request->qty_tolak[$index] ?? 0,
                ]);
            }

            \DB::commit();
            return back()->with('success', 'Data ekspedisi berhasil disimpan!');

        } catch (\Throwable $e) {
            \DB::rollback();
            \Log::error('Ekspedisi store error: '.$e->getMessage());

            return back()->withInput()->with(
                'error',
                'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()
            );
        }
    }

    public function cetak($id)
    {
        $ekspedisi = Ekspedisi::with(['detail', 'supir',])->findOrFail($id);

        return view('sbj.ekspedisi.cetak', compact('ekspedisi'));
    }
    public function cetakPeriode(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $ekspedisi = Ekspedisi::with(['supir', 'Typebarang', 'detail'])
            ->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();

        return view('sbj.ekspedisi.cetak-periodetujuan', [
            'ekspedisi' => $ekspedisi,
            'awal' => $request->tanggal_awal,
            'akhir' => $request->tanggal_akhir,
        ]);
    }
    public function cetakPeriodesemua(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $ekspedisi = Ekspedisi::with(['supir', 'Typebarang', 'detail'])
            ->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();

        return view('sbj.ekspedisi.cetak-periode', [
            'ekspedisi' => $ekspedisi,
            'awal' => $request->tanggal_awal,
            'akhir' => $request->tanggal_akhir,
        ]);
    }
}
