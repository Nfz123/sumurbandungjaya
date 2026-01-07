@extends('sbj.main')
@section('title', 'Laporan Bulanan')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Awal:</strong>
                    <input type="date" name="tglawal" id="tglawal" class="form-control" placeholder="Date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Akhir:</strong>
                    <input type="date" name="tglakhir" id="tglakhir" class="form-control" placeholder="Date">
                </div>
            </div>
            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
                </div>
            </div> --}}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <a href="#" onclick="this.href='/laporanbulananpertanggal/'+ document.getElementById('tglawal').value +
                '/'+document.getElementById('tglakhir').value" class="btn btn-primary" target="_blank">Cetak Laporan Pertanggal</a>
            </div>
              
            <div class="col-xs-12 col-sm-12 col-md-12">
                <a href="#" onclick="this.href='/laporanlaba/'+ document.getElementById('tglawal').value +
                '/'+document.getElementById('tglakhir').value" class="btn btn-primary" target="_blank">Cetak Laporan Laba</a>
            </div>
        
        </div>
    </div>
</section>
{{-- 
<script>
    document.getElementById('submitLink').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior

        var tanggalAwal = document.getElementById("tglawal").value;
        var tanggalAkhir = document.getElementById("tglakhir").value;

        // Lakukan tindakan atau manipulasi yang diperlukan dengan tanggalAwal dan tanggalAkhir
        // Misalnya, membuat URL dengan tanggal dan mengarahkan tautan ke URL tersebut
        var url = "/laporanbulananpertanggal/tanggal_awal=" + tanggalAwal + "&tanggal_akhir=" + tanggalAkhir;
        window.location.href = url;
    });
</script> --}}
@endsection

