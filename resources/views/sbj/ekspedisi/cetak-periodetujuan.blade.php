<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Ekspedisi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h2, h4 { text-align: center; margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; font-size: 14px; }
        .periode { margin-top: 10px; text-align: center; }
    </style>
</head>
<body>

    <h2>LAPORAN EKSPEDISI</h2>
    <h4 class="periode">Periode: {{ \Carbon\Carbon::parse($awal)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($akhir)->format('d/m/Y') }}</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Supir</th>
                <th>Kendaraan</th>
                <th>Tujuan 1</th>
                <th>Qty Box</th>
                <th>Tujuan 2</th>
                <th>Qty Box</th>
                <th>Tujuan 3</th>
                <th>Qty Box</th>
                <th>Total Box</th>
                <th>Harga Ritasi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($ekspedisi as $item)
                @php
                    $details = $item->detail;
                    $max = 3;
                    $totalQty = $details->sum('qty_terima');
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $item->Supir->namasupir ?? '-' }}</td>
                    <td style="text-align: left;">{{ $item->typebarang->namatype ?? '-' }}</td>

                    @for ($i = 0; $i < $max; $i++)
                        <td style="text-align: left;">{{ $details[$i]->tujuan ?? '' }}</td>
                        <td>{{ $details[$i]->qty_terima ?? '' }}</td>
                    @endfor

                    <td><strong>{{ $totalQty }}</strong></td>
                    <td>{{ 'Rp ' . number_format($item->hargaritasi ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach

            {{-- total harga ritasi --}}
            @php $totalRitasi = $ekspedisi->sum('hargaritasi'); 
            $totalBox = 0;
                foreach ($ekspedisi as $e) {
                    $totalBox += $e->detail->sum('qty_terima');
            }@endphp
            <tr>
                <td colspan="10" style="text-align: right;"><strong></strong></td>
                <td><strong>{{ $totalBox }}</strong></td>
                <td><strong>Rp {{ number_format($totalRitasi, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
            

    </table>
            {{-- @php
                $totalRitasi = $ekspedisi->sum('hargaritasi');
                
            @endphp
        <tr>
            {{-- <td colspan="10" style="text-align: right;"><strong>Total Keseluruhan</strong></td> --}}
            {{-- <td><strong>{{ $totalBox }}</strong></td> --}}
            {{-- <td><strong>Rp {{ number_format($totalRitasi, 0, ',', '.') }}</strong></td> --}}



    <script>
        window.print();
    </script>
</body>
</html>
