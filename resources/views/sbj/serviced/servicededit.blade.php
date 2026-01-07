@extends('sbj.main')
@section('content')

<div class="container mt-4">
    <h4>Edit Data Service</h4>

    <form action="{{ route('serviced.update', $data->detil_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Barang</label>
            <input type="text" name="barang" value="{{ $data->barang }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Qty</label>
            <input type="number" name="qty" value="{{ $data->qty }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $data->harga }}" class="form-control" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
