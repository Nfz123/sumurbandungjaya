<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Typebarang;
use App\Models\ServicedDetil;

class FinanceController extends Controller
{
    // public function index()
    // {
    //     // Ambil Typebarang beserta serviced_detil
    //     $typebarang = Typebarang::with('servicedDetil')->get();

    //     // Group berdasarkan kode_type
    //     $grouped = $typebarang->groupBy('kodetype');

    //     // Hitung total per group sekaligus total semua
    //     $totals = [];
    //     $grandTotal = 0;

    //     foreach ($grouped as $kodeType => $items) {

    //         // Ambil semua total dari serviced_detil milik group ini
    //         $totalServiced = 0;

    //         foreach ($items as $item) {
    //             $totalServiced += $item->servicedDetil->sum('total');
    //         }

    //         $totals[$kodeType] = $totalServiced;
    //         $grandTotal += $totalServiced;
    //     }

    //     return view('sbj.finance.indexhitung', compact('typebarang', 'grouped', 'totals', 'grandTotal'));
    // }
    public function index()
    {
        // Ambil Typebarang beserta relasi servis & ekspedisi
        $typebarang = Typebarang::with([
            'servicedDetil',
            'ekspedisi',
            'ekspedisi.detail'
        ])->get();

        // Group berdasarkan kodetype
        $grouped = $typebarang->groupBy('kodetype');

        $totals = [];
        $grandTotal = 0;

        foreach ($grouped as $kodeType => $items) {

            // Total dari servis
            $totalServis = 0;

            // Total dari ekspedisi
            $totalTKBM = 0;
            $totalRitasi = 0;
            $totalUangJalan = 0;

            foreach ($items as $item) {

                // SUM total servis
                $totalServis += $item->servicedDetil->sum('total');

                // SUM header ekspedisi
                $totalTKBM      += $item->ekspedisi->sum('tkbm');
                $totalRitasi    += $item->ekspedisi->sum('hargaritasi');
                $totalUangJalan += $item->ekspedisi->sum('uangjalan');
            }

            // Simpan total per group
            $totals[$kodeType] = [
                'servis'       => $totalServis,
                'tkbm'         => $totalTKBM,
                'ritasi'       => $totalRitasi,
                'uang_jalan'   => $totalUangJalan,
                'jumlah_total' => $totalTKBM + $totalRitasi + $totalUangJalan
            ];

            // Hitung grand total seluruh kodetype
            $grandTotal += ($totalServis + $totalTKBM + $totalRitasi + $totalUangJalan);
        }

        return view('sbj.finance.indexhitung', compact(
            'typebarang',
            'grouped',
            'totals',
            'grandTotal'
        ));
    }

}
