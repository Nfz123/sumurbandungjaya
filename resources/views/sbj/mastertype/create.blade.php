@extends('sbj.app')
@section('content')
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <section class="section">
                        <div class="row">
                            <div class="col-lg-12">

                                      <!-- End Table with stripped rows -->
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Tambah Data Type Barang</h3>
                                            </div>


                                            <form action="{{ route('Typebarang.store') }}" method="POST">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Kode Type</label>
                                                        <input type="text" value="{{$doku}}" class="form-control" name="kodetype"
                                                            >
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="exampleInputFile">Nama Type</label>
                                                      <input type="text" class="form-control" name="namatype"
                                                          >
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="exampleInputFile">Uom</label>
                                                      <input type="text" class="form-control" name="uom"
                                                          >
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="exampleInputFile">Harga Lama</label>
                                                    <input type="text" class="form-control" name="hargalama"
                                                        >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Harga Baru</label>
                                                    <input type="text" class="form-control" name="hargabaru"
                                                        >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">PPN</label>
                                                    <input type="text" class="form-control" name="ppn"
                                                        >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">HARGA JUAL</label>
                                                    <input type="text" class="form-control" name="hargajual"
                                                        >
                                                </div>
                                                    
                                                    
                                                    {{-- <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Check me
                                                            out</label>
                                                    </div> --}}
                                                </div>

                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <button type="button" class="btn btn-danger">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                @endsection
