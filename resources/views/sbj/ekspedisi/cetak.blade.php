<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Ekspedisi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        h2, h4 { text-align: center; }
        .header-info { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>LAPORAN EKSPEDISI</h2>

    <div class="header-info">
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($ekspedisi->tanggal)->format('d-m-Y') }}</p>
        <p><strong>Supir:</strong> {{ $ekspedisi->Supir->namasupir ?? '-' }}</p>
        <p><strong>Kendaraan:</strong> {{ $ekspedisi->Typebarang->namatype ?? '-' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tujuan</th>
                <th>Qty Terima</th>
                <th>Qty Tolak</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ekspedisi->detail as $i => $detail)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $detail->tujuan }}</td>
                    <td>{{ $detail->qty_terima }}</td>
                    <td>{{ $detail->qty_tolak }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.print(); // Otomatis print saat dibuka
    </script>
</body>
</html>
