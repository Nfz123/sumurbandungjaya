@extends('sbj.main')
@section('content')
{{-- <pre>{{ dd($data) }}</pre> --}}
<div class="container mt-4">
    <h5>Laporan Service Berdasarkan Tanggal</h5>

    <form action="{{ route('serviced.cariLaporanServiced') }}" method="GET" class="row g-2 mb-3">
        <div class="col-md-3">
            <label>Tanggal Awal</label>
            <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label>Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control" required>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
        </div>
    </form>

    @if(isset($data))
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Kode Service</th>
                        <th>Tanggal</th>
                        <th>Kode Kendaraan</th>
                        <th>Nama Kendaraan</th>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; $grandTotal = 0; @endphp
                    @php $no = 1; $grandTotal = 0; @endphp
                    @forelse ($data as $item)
                       {{-- @dd($item) --}}
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $item->kode_serviced }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $item->kodetype }}</td>
                        <td>{{ $item->namatype }}</td>
                        <td>{{ $item->barang }}</td>
                        <td class="text-end">{{ $item->qty }}</td>
                        <td class="text-end">{{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="text-end">{{ number_format($item->total, 0, ',', '.') }}</td>
                        {{-- Tombol Aksi --}}
                        <td class="text-center">
                            {{-- <a href="{{ route('serviced.edit', $item->detil_serviced_id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                            {{-- <a href="{{ route('serviced.edit', $item->detil_id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                            <a href="{{ route('serviced.edit', $item->detil_id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('serviced.destroy', $item->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @php $grandTotal += $item->total; @endphp
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse

                    @if(count($data) > 0)
                        <tr class="fw-bold bg-light">
                            <td colspan="8" class="text-end">Grand Total</td>
                            <td class="text-end">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
