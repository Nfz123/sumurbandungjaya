@extends('sbj.main')
{{-- @section('title', 'Laporan Angsuran') --}}

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Laporan Angsuran</h1>
    <a href="{{ route('angsuran.create') }}" class="btn btn-primary">
        <i class="fa fa-plus"></i> Inputan Baru
    </a>
</div>
<div class="mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="Cari Kode Type atau Nama Type...">
</div>
<div id="cardContainer">
    @foreach ($groupedAngsurans as $kodetype => $items)
        <div class="card mb-4 shadow-sm angsuran-card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="namatype">Nama Type: {{ optional($items->first()->type)->namatype ?? 'Tidak ditemukan' }}</h5>
                    <small class="mb-0">Lising: {{ optional($items->first()->type)->Lising }}</small>
                </div>
                <a href="{{ route('angsuran.print', $kodetype) }}" target="_blank" class="btn btn-warning text-dark">
                    {{ $items->count() }} Angsuran
                </a>

            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Kolom Gambar --}}
                    <div class="col-md-3 text-center">
                        @php $gambar = optional($items->first()->type)->gambar; @endphp
                        @if ($gambar)
                            <img src="{{ asset('storage/typebarang/' . $gambar) }}" class="img-fluid rounded mb-2" alt="Gambar Type">
                        @else
                            <small class="text-muted">Tidak ada gambar</small>
                        @endif
                    </div>
                    {{-- Kolom Tabel --}}
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $angsuran)
                                        <tr>
                                             <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($angsuran->tanggal_angsuran)->translatedFormat('d F Y') }}</td>
                                            <td>Rp {{ number_format($angsuran->nominal_angsuran, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


@endsection
@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        var keyword = this.value.toLowerCase();
        var cards = document.querySelectorAll('.angsuran-card');

        cards.forEach(function (card) {
            var kode = card.querySelector('.card-header h5').textContent.toLowerCase();
            var nama = card.querySelector('.namatype').textContent.toLowerCase();

            if (kode.includes(keyword) || nama.includes(keyword)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
@endpush
