<!DOCTYPE html>
<html>
<head>
    <title>Cetak Angsuran</title>
    <style>
        body { font-family: Arial, sans-serif; }
        img { max-width: 200px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
    </head>
    <body onload="window.print()" style="font-family: Arial, sans-serif;">

    <small style="font-size: 16px; font-weight: bold;">
        Unit : {{ optional($angsuran->first()->type)->namatype ?? 'Tidak diketahui' }}
    </small>

    @php
        $gambarType = optional($angsuran->first()->type)->gambar;
        $totalAngsuran = 0;
    @endphp

    <div style="display: flex; gap: 20px; margin-top: 15px;">

        {{-- Gambar Kendaraan --}}
        <div style="flex: 0 0 300px; border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9; border-radius: 8px;">
            @if($gambarType)
                <img src="{{ asset('storage/typebarang/' . $gambarType) }}" alt="Foto Kendaraan"
                    style="max-width: 100%; height: auto; border-radius: 6px;">
            @else
                <p><em>Tidak ada foto kendaraan untuk tipe ini.</em></p>
            @endif
        </div>

        {{-- Tabel Angsuran --}}
        <div style="flex: 1;">
            <table border="1" cellpadding="8" cellspacing="0"
                style="width: 100%; border-collapse: collapse; background-color: #ffffff;">
                <thead style="background-color: #2c3e50; color: #fff;">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th style="width: 150px;">Tanggal</th>
                        <th>Nominal Angsuran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($angsuran as $item)
                        @php $totalAngsuran += $item->nominal_angsuran; @endphp
                        <tr style="background-color: {{ $loop->iteration % 2 == 0 ? '#f2f2f2' : '#ffffff' }};">
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal_angsuran }}</td>
                            <td>Rp {{ number_format($item->nominal_angsuran, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color: #ecf0f1; font-weight: bold;">
                        <td colspan="2" style="text-align: right;">Total</td>
                        <td>Rp {{ number_format($totalAngsuran, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</body>


</html>
