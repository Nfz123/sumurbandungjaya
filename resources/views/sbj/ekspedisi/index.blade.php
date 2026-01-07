@extends('sbj.main')
@section('content')
<div class="card my-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Cetak Laporan Berdasarkan ID Ekspedisi</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('ekspedisi.cetak', ['id' => 'ID_REPLACE']) }}" method="GET" target="_blank" onsubmit="return updateFormAction(this)">
            <div class="row">
                <div class="col-md-10">
                    <label for="ekspedisi_id" class="form-label">ID Ekspedisi</label>
                    <input type="number" id="ekspedisi_id" class="form-control" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">Cetak</button>
                </div>
            </div>
        </form>
        <br>
        <form action="{{ route('ekspedisi.cetakPeriode') }}" method="GET" target="_blank">
            <div class="row">
                <div class="col-md-4">
                    <label>Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" class="form-control" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </div>
        </form>
        <br>
        <form action="{{ route('ekspedisi.cetakPeriodesemua') }}" method="GET" target="_blank">
            <div class="row">
                <div class="col-md-4">
                    <label>Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" class="form-control" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </div>
        </form>
    </div>
    
</div>


<script>
    function updateFormAction(form) {
        const id = document.getElementById('ekspedisi_id').value;
        form.action = form.action.replace('ID_REPLACE', id);
        return true;
    }
</script>
@endsection