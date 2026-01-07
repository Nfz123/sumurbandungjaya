<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Ekspedisi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h2, h4 { text-align: center; margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; font-size: 13px; }
        .periode { margin-top: 10px; text-align: center; }
        tfoot th { background:#f2f2f2; }
    </style>
</head>
<body>

    <h2>LAPORAN EKSPEDISI</h2>
    <h4 class="periode">Periode: {{ \Carbon\Carbon::parse($awal)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($akhir)->format('d/m/Y') }}</h4>

    @php
        $totalTerima = 0;
        $totalTolak = 0;
        $grandTKBM = 0;
        $grandRitasi = 0;
        $no = 1;
    @endphp

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Sales Order</th>
                <th>Supir</th>
                <th>Kendaraan</th>
                <th>Tujuan</th>
                <th>Qty Terima</th>
                <th>Qty Tolak</th>
                <th>TKBM</th>
                <th>Harga Ritasi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($ekspedisi as $item)
                @php
                    $firstRow = true;
                    
                    // akumulasi grand total (tkbm + ritasi dihitung sekali per ekspedisi)
                    $grandTKBM += ($item->tkbm ?? 0);
                    $grandRitasi += ($item->hargaritasi ?? 0);
                @endphp

                @foreach($item->detail as $detail)
                    @php
                        $totalTerima += $detail->qty_terima;
                        $totalTolak += $detail->qty_tolak;
                    @endphp

                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $firstRow ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '' }}</td>
                        <td>{{ $detail->nosalesorder }}</td>
                        <td>{{ $firstRow ? ($item->Supir->namasupir ?? '-') : '' }}</td>
                        <td>{{ $firstRow ? ($item->Typebarang->no_seri ?? '-') : '' }}</td>
                        <td>{{ $detail->tujuan }}</td>

                        <td>{{ $detail->qty_terima }}</td>
                        <td>{{ $detail->qty_tolak }}</td>

                        <td>
                            {{ $firstRow ? 'Rp ' . number_format($item->tkbm, 0, ',', '.') : '' }}
                        </td>
                        <td>
                            {{ $firstRow ? 'Rp ' . number_format($item->hargaritasi, 0, ',', '.') : '' }}
                        </td>
                    </tr>

                    @php $firstRow = false; @endphp
                @endforeach
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="6" class="right">TOTAL</th>
                <th>{{ number_format($totalTerima) }}</th>
                <th>{{ number_format($totalTolak) }}</th>
                <th>Rp {{ number_format($grandTKBM, 0, ',', '.') }}</th>
                <th>Rp {{ number_format($grandRitasi, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>

