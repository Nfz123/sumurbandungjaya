@extends('layouts.app')

@section('content')
    <h1>Create Transaksi</h1>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="kode_transaksi">Kode Transaksi</label>
            <input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tanggal">namapelimik</label>
            <input type="text" name="nama_pemilik" id="tanggal" class="form-control" required>
        </div>
        <h3>Transaksi Detil</h3>

        <table id="transaksi-detil-table">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody id="transaksi-detil-container">
                <tr>
                    <td>
                        <input type="text" name="detil[0][barang]" class="form-control" required>
                    </td>
                    <td>
                        <input type="number" name="detil[0][jumlah]" class="form-control" required>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" id="add-transaksi-detil" class="btn btn-primary">Tambah Transaksi Detil</button>

        <br><br>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>

    <script>
        // Tambahkan fungsi untuk menambahkan baris transaksi detil ke tabel
        document.getElementById('add-transaksi-detil').addEventListener('click', function () {
            const container = document.getElementById('transaksi-detil-container');

            const newIndex = container.children.length;

            const row = document.createElement('tr');

            const barangCell = document.createElement('td');
            const barangInput = document.createElement('input');
            barangInput.type = 'text';
            barangInput.name = 'detil[' + newIndex + '][barang]';
            barangInput.className = 'form-control';
            barangInput.required = true;
            barangCell.appendChild(barangInput);

            const jumlahCell = document.createElement('td');
            const jumlahInput = document.createElement('input');
            jumlahInput.type = 'number';
            jumlahInput.name = 'detil[' + newIndex + '][jumlah]';
            jumlahInput.className = 'form-control';
            jumlahInput.required = true;
            jumlahCell.appendChild(jumlahInput);

            row.appendChild(barangCell);
            row.appendChild(jumlahCell);

            container.appendChild(row);
        });
    </script>
@endsection
