@extends('sbj.main')
@section('content')
    <form action="{{ route('ekspedisi.store') }}" method="POST">
    @csrf

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Input Ekspedisi</h5>
        </div>

        <div class="card-body">
            <div class="row">
            <!-- Tanggal -->
                <div class="col-md-6 mb-3">
                    <label for="jenis" class="form-label">Jenis Kendaraan</label>
                    <select class="form-control" name="jenis" id="jenis" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="PYD Oncall">PYD Oncall</option>
                        <option value="Dedicated NR1">Dedicated NR1</option>
                        <option value="Dedicated R3">Dedicated R3</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                </div>
                
            </div>
            <input type="hidden" name="kendaraan_id" id="type_id">
            <input type="hidden" name="supir_id" id="supir_id">

            <div class="row">

                <!-- Kendaraan -->
                <div class="col-md-6 mb-3">
                    <label for="kendaraan" class="form-label">Kendaraan</label>
                    <select class="form-control" name="kendaraan" id="kendaraan" required style="width:100%"></select>
                </div>

                <!-- Supir -->
                <div class="col-md-6 mb-3">
                    <label for="supir" class="form-label">Supir</label>
                    <select class="form-control" name="supir" id="supir" required>
                        <option value="">-- Pilih Supir --</option>
                        @foreach ($supir as $supirItem)
                            <option value="{{ $supirItem->Id }}">{{ $supirItem->namasupir }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- TKBM -->
                <div class="col-md-6 mb-3">
                    <label for="tkbm" class="form-label">TKBM</label>
                    <input type="number" class="form-control" name="tkbm" id="tkbm" required>
                </div>

                <!-- Uang Jalan -->
                <div class="col-md-6 mb-3">
                    <label for="uangjalan" class="form-label">Uang Jalan</label>
                    <input type="number" class="form-control" name="uangjalan" id="uangjalan" required>
                </div>

                <!-- Harga Ritasi -->
                <div class="col-md-6 mb-3">
                    <label for="hargaritasi" class="form-label">Harga Ritasi</label>
                    <input type="number" class="form-control" name="hargaritasi" id="hargaritasi" required>
                </div>

            </div>
        </div>

        <hr>

        <div class="px-3">
            <h5>Detail Tujuan</h5>
        </div>

        <!-- TABLE RESPONSIVE WRAPPER -->
        <div class="table-responsive px-3">
            <table class="table table-bordered" id="tujuan-table">
                <thead class="table-light">
                    <tr>
                        <th>No Sales Order</th>
                        <th>Tujuan</th>
                        <th>Terima</th>
                        <th>Tolak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="nosalesorder[]" class="form-control" required>
                        </td>

                        <td>
                            <div class="d-flex">
                                <input type="text" name="tujuan[]" class="form-control tujuan-input me-1" placeholder="Pilih Tujuan" readonly required>
                                <button type="button" class="btn btn-secondary btn-sm open-modal">Cari</button>
                            </div>
                        </td>

                        <td><input type="number" name="qty_terima[]" class="form-control" required></td>
                        <td><input type="number" name="qty_tolak[]" class="form-control" required></td>

                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="px-3">
            <button type="button" class="btn btn-primary" id="add-row">+ Add Row</button>
        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div>

</form>

        <!-- Modal Pilih Tujuan -->
        <div class="modal fade" id="modalTujuan" tabindex="-1" aria-labelledby="modalTujuanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Tujuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-3" id="searchTujuan" placeholder="Cari tujuan...">
                <ul class="list-group" id="listTujuan">
                @foreach ($tujuans as $tujuan)
                    <li class="list-group-item tujuan-item" data-nama="{{ $tujuan->namatujuan }}">
                    {{ $tujuan->namatujuan }}
                    </li>
                @endforeach
                </ul>
            </div>
            </div>
        </div>
        
        </div>

@endsection
        

@push('styles')
   <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .tujuan-item:hover {
        background-color: #e9ecef;
        cursor: pointer;
    }
</style>

@endpush
@push('scripts')
    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <!-- Bootstrap 5 JS (tanpa jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    document.getElementById('supir').addEventListener('change', function () {
        document.getElementById('supir_id').value = this.value;
    });
</script>

    <script>
        $('#kendaraan').select2({
        placeholder: 'Cari kendaraan...',
        ajax: {
            url: '{{ route("Typebarang.search") }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id, // ← ID type disimpan di sini
                            text: item.namatype + ' - ' + item.merek,
                            namatype: item.namatype
                        };
                    })
                };
            },
            cache: true
        }
    }).on('select2:select', function (e) {
        var selected = e.params.data;
        $('#type_id').val(selected.id); // ← Simpan ID ke hidden input
    });

    </script>
    <script>
        document.getElementById('add-row').addEventListener('click', function () {
            let tableBody = document.querySelector('#tujuan-table tbody');
            let newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td><input type="text" name="nosalesorder[]" class="form-control" required></td>
                <td>
                    <div class="input-group">
                        <input type="text" name="tujuan[]" class="form-control tujuan-input" placeholder="Pilih Tujuan" readonly required>
                        <button type="button" class="btn btn-secondary btn-sm open-modal">Cari</button>
                    </div>
                </td>
                <td><input type="number" name="qty_terima[]" class="form-control" required></td>
                <td><input type="number" name="qty_tolak[]" class="form-control" required></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button></td>
            `;

            tableBody.appendChild(newRow);
        });

        // Hapus baris
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });
    </script>

    <script>
        let currentInput = null;

        // Buka modal ketika tombol diclick
        $(document).on('click', '.open-modal', function () {
            currentInput = $(this).closest('tr').find('.tujuan-input');
            $('#modalTujuan').modal('show');
        });

        // Pilih tujuan dari modal
      // Pilih tujuan dari modal dan fokus ke qty terima
            $(document).on('click', '.tujuan-item', function () {
                let nama = $(this).data('nama');
                if (currentInput) {
                    currentInput.val(nama);
                    // Fokus ke input Qty Terima di baris yang sama
                    currentInput.closest('tr').find('input[name="qty_terima[]"]').focus();
                }
                $('#modalTujuan').modal('hide');
            });

        // Fitur pencarian dalam modal
        $('#searchTujuan').on('keyup', function () {
            let keyword = $(this).val().toLowerCase();
            $('#listTujuan .tujuan-item').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1);
            });
        });
    </script>
<script>
    let currentInput = null;
    const modalTujuan = new bootstrap.Modal(document.getElementById('modalTujuan'));

    // Buka modal saat tombol cari diklik
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('open-modal')) {
            currentInput = e.target.closest('tr').querySelector('.tujuan-input');
            modalTujuan.show();
        }
    });

    // Pilih tujuan dari modal dan autofokus ke qty_terima
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('tujuan-item')) {
            const nama = e.target.dataset.nama;
            if (currentInput) {
                currentInput.value = nama;
                currentInput.closest('tr').querySelector('input[name="qty_terima[]"]').focus();
            }
            modalTujuan.hide();
        }
    });

    // Fitur pencarian
    document.getElementById('searchTujuan').addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll('#listTujuan .tujuan-item').forEach(item => {
            const match = item.textContent.toLowerCase().includes(keyword);
            item.style.display = match ? '' : 'none';
        });
    });
</script>

@endpush