@extends('sbj.main')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <!-- ================= FORM FILTER TANGGAL ================= -->
                    <form action="{{ route('finance.index') }}" method="GET" class="row g-2 mb-3">
                        <div class="col-md-3">
                            <label>Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary w-100 mt-4">Filter</button>
                        </div>
                    </form>

                    <!-- ================= END FORM FILTER TANGGAL ================= -->


                    <div class="table-responsive">
                        <table id="typeTable" class="table table-bordered table-striped">

                            <thead class="table-dark text-center">
                                <tr>
                                    <th>Type</th>
                                    <th>Merek</th>
                                    <th>No Seri</th>
                                    <th>Angsuran (Rp)</th>
                                    <th>Total Service (Rp)</th>
                                    <th>Uang Jalan (Rp)</th>
                                    <th>TKBM (Rp)</th>
                                    <th>Ritasi (Rp)</th>
                                    <th>Total Ekspedisi (Rp)</th>
                                </tr>
                            </thead>

                            @php
                                $totalAngsuran = 0;
                                $totalAllService = 0;

                                $totalUangJalan = 0;
                                $totalRitasi = 0;
                                $totalTKBM = 0;

                                $totalGrandEkspedisi = 0;
                            @endphp

                            <tbody>

                                @foreach ($typebarang as $item)

                                    @php
                                        // Hitung angsuran
                                        $totalAngsuran += $item->nominal_angsuran;

                                        // Total service
                                        $totalService = $item->servicedDetil->sum('total');
                                        $totalAllService += $totalService;

                                        // Ekspedisi
                                        $uangJalan = $item->ekspedisi->sum('uangjalan');
                                        $ritasi    = $item->ekspedisi->sum('hargaritasi');
                                        $tkbm      = $item->ekspedisi->sum('tkbm');

                                        $totalUangJalan += $uangJalan;
                                        $totalRitasi    += $ritasi;
                                        $totalTKBM      += $tkbm;

                                        // Rumus baru total ekspedisi
                                        $totalEkspedisi = ($ritasi - $uangJalan) + $tkbm;

                                        if ($totalEkspedisi < 0) {
                                            $totalEkspedisi = 0;
                                        }

                                        $totalGrandEkspedisi += $totalEkspedisi;
                                    @endphp

                                    <tr>
                                        <td>{{ $item->namatype }}</td>
                                        <td>{{ $item->merek }}</td>
                                        <td>{{ $item->no_seri }}</td>

                                        <td class="text-end">Rp {{ number_format($item->nominal_angsuran, 0, ',', '.') }}</td>
                                        <td class="text-end">Rp {{ number_format($totalService, 0, ',', '.') }}</td>
                                        <td class="text-end">Rp {{ number_format($uangJalan, 0, ',', '.') }}</td>
                                        <td class="text-end">Rp {{ number_format($tkbm, 0, ',', '.') }}</td>
                                        <td class="text-end">Rp {{ number_format($ritasi, 0, ',', '.') }}</td>

                                        <td class="text-end fw-bold">
                                            Rp {{ number_format($totalEkspedisi, 0, ',', '.') }}
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                            <!-- =================== FOOTER =================== -->
                            <tfoot>

                                <tr class="fw-bold bg-light">
                                    <td colspan="3" class="text-end">TOTAL ANGSURAN :</td>
                                    <td class="text-end">Rp {{ number_format($totalAngsuran, 0, ',', '.') }}</td>
                                    <td colspan="5"></td>
                                </tr>

                                <tr class="fw-bold bg-light">
                                    <td colspan="4" class="text-end">TOTAL SELURUH SERVICE :</td>
                                    <td class="text-end">Rp {{ number_format($totalAllService, 0, ',', '.') }}</td>
                                    <td colspan="4"></td>
                                </tr>

                                <tr class="fw-bold table-secondary">
                                    <td colspan="5" class="text-end">TOTAL UANG JALAN :</td>
                                    <td class="text-end">Rp {{ number_format($totalUangJalan, 0, ',', '.') }}</td>
                                    <td colspan="3"></td>
                                </tr>

                                <tr class="fw-bold table-secondary">
                                    <td colspan="5" class="text-end">TOTAL TKBM :</td>
                                    <td></td>
                                    <td class="text-end">Rp {{ number_format($totalTKBM, 0, ',', '.') }}</td>
                                    <td colspan="2"></td>
                                </tr>

                                <tr class="fw-bold table-secondary">
                                    <td colspan="5" class="text-end">TOTAL RITASI :</td>
                                    <td></td>
                                    <td class="text-end">Rp {{ number_format($totalRitasi, 0, ',', '.') }}</td>
                                    <td colspan="2"></td>
                                </tr>

                                <tr class="fw-bold table-dark text-white">
                                    <td colspan="7" class="text-end">GRAND TOTAL EKSPEDISI :</td>
                                    <td colspan="2" class="text-end">
                                        Rp {{ number_format($totalGrandEkspedisi, 0, ',', '.') }}
                                    </td>
                                </tr>

                                @php
                                    $selisih = $totalGrandEkspedisi - $totalAngsuran;
                                @endphp

                                <tr class="fw-bold table-primary">
                                    <td colspan="7" class="text-end">SELISIH EKSPEDISI - ANGSURAN :</td>
                                    <td colspan="2" class="text-end">
                                        Rp {{ number_format($selisih, 0, ',', '.') }}
                                        <br>
                                        <small>
                                            ({{ $selisih >= 0 ? 'LEBIH' : 'KURANG' }})
                                        </small>
                                    </td>
                                </tr>

                            </tfoot>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>







@endsection