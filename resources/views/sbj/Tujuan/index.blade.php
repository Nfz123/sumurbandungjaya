@extends('sbj.main')

@section('content')
<div class="container mt-4">
    <h4>Data Tujuan</h4>

    <!-- Form Input -->
    <form id="formTujuan" class="row row-cols-1 row-cols-md-3 g-2 mb-4">
        @csrf
        <div class="col">
            <input type="text" name="namatujuan" class="form-control" placeholder="Nama Tujuan" required>
        </div>
        <div class="col">
            <input type="text" name="lokasi" class="form-control" placeholder="Lokasi" required>
        </div>
        <div class="col d-grid">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>

    <!-- Alert -->
    <div id="alertBox" style="display:none;" class="alert alert-success"></div>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-sm" id="tableTujuan">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Tujuan</th>
                    <th>Lokasi</th>
                    <th>Waktu Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tujuan as $index => $tujuan)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $tujuan->namatujuan }}</td>
                        <td>{{ $tujuan->lokasi }}</td>
                        <td class="text-center">{{ $tujuan->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                        <button class="btn btn-sm btn-danger" onclick="hapusTujuan({{ $tujuan->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data tujuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection
@push('styles')
    <!-- Bootstrap CSS (di <head>) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush
<!-- Tambahkan ini di bawah halaman -->
@push('scripts')
<!-- Tambahkan sebelum </body> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JS dan Popper (sebelum </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("formTujuan");
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        const alertBox = document.getElementById("alertBox");

        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch("{{ route('tujuan.simpan') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Terjadi kesalahan saat menyimpan.");
                }
                return response.json();
            })
            .then(data => {
                if (data.status === "success") {
                    // Tampilkan alert
                    alertBox.style.display = "block";
                    alertBox.textContent = "Data tujuan berhasil disimpan!";

                    // Kosongkan form
                    form.reset();

                    // Tambahkan row ke tabel secara dinamis
                    const table = document.getElementById("tableTujuan").querySelector("tbody");
                    const rowCount = table.rows.length;
                    const newRow = table.insertRow();

                    newRow.innerHTML = `
                        <td class="text-center">${rowCount + 1}</td>
                        <td>${data.data.namatujuan}</td>
                        <td>${data.data.lokasi}</td>
                        <td class="text-center">${new Date(data.data.created_at).toLocaleString("id-ID")}</td>
                    `;
                } else {
                    alert("Gagal menyimpan data.");
                }
            })
            .catch(error => {
                alertBox.style.display = "block";
                alertBox.classList.remove("alert-success");
                alertBox.classList.add("alert-danger");
                alertBox.textContent = error.message;
                console.error(error);
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#tableTujuan').DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ditemukan data yang cocok",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Data tidak tersedia",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });
</script>
<script>
    // function editTujuan(id) {
    //     // Contoh redirect ke halaman edit
    //     window.location.href = `/tujuan/${id}/edit`;
    // }

    function hapusTujuan(id) {
        if (confirm("Yakin ingin menghapus data ini?")) {
            fetch(`/tujuan/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    location.reload();
                } else {
                    alert("Gagal menghapus data.");
                }
            })
            .catch(err => {
                console.error(err);
                alert("Terjadi kesalahan.");
            });
        }
    }
</script>

@endpush