@extends('sbj.report')
@section('title', 'Laporan Bulanan')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h5 class="card-title">Laporan Harian</h5> --}}
                    <!-- Table with stripped rows -->
                    <table align="center" border="0" style="background-color: yellow; width: 100%; padding: 10px;"> 
                      
                            <tr>
                                {{-- <td style="width: 100px;" align="center">
                                    <img src="{{ asset('img/brand/sbjpng.png') }}" alt="Logo" width="80">
                                </td> --}}
                                <td align="center">
                                    <font size="5" >SUMUR BANDUNG JAYA</font><BR>
                                    {{-- <font size="2"><i>Jl. Raya Serang KM. 32 Desa. Sumurbandung Kec. Jayanti Kab. Tangerang Kode Pos: 15610</i></font><BR>
                                    <font size="2"><i>WEB : www.desaku.com EMAIL:desaku@gmail.com</i></font><BR> --}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center"><font size="3"><u>LAPORAN PEMBELIAN WASTE MAYORA JAYANTI 3 DSC</u></font></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                    </table>
                    <table id="typebarang-table" class="table" border="1">
                        <thead>
                            <tr>
                                <th scope="col" width="20%">NO TRANSAKSI</th>
                                <th scope="col" width="10%">TANGGAL</th>
                                <th scope="col" width="30%">TYPE</th>
                                <th scope="col" width="20%">UOM</th>
                                <th scope="col" width="20%">QTY</th>
                                <th scope="col" width="20%">Harga</th>
                                <th scope="col" width="20%">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                  $totalAmount = 0;
                            @endphp
                            @foreach ($transaksidetil as $item) 
                            <tr>
                                <td>{{$item->kode_transaksi}}</td>
                                <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                <td>{{$item->namatype}}</td>
                                <td>{{$item->uom}}</td>
                                <td>{{ number_format($item->qty, 0, ',', '.') }}</td>
                                <td>{{ number_format($item->ppn, 0, ',', '.') }}</td>
                                <td>{{ number_format($item->ppn * $item->qty, 0, ',', '.') }}</td>
                            </tr>
                            @php
                          
                            $totalAmount += $item->ppn * $item->qty;
                            @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" style="text-align: right;">Total:</th>
                                <th>{{ number_format($totalAmount, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                         <style>
                        .table-wrapper {
                            display: flex;
                            align-items: center;
                        }
                    
                        .table-content {
                            flex: 1;
                        }
                    
                        .table-image {
                            text-align: right;
                        }
                    </style>
                    </table>
                                        <table id="typebarang-table" class="table" border="0">
   
    <tr>
        <td colspan="5">
            <div class="table-wrapper">
                <div class="table-content">
                    <!-- Isi tabel di sini -->
                </div>
                <div class="table-image">
                    <img src="{{ URL::asset('assets/dist/img/frame.png') }}" alt="Image Description" width="150" height="150">
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <th colspan="5" style="text-align: right;">  Muhamad Naziullah</th>
    </tr>
</table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

