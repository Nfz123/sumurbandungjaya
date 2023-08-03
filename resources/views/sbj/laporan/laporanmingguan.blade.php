@extends('sbj.main')
@section('title', 'Laporan Mingguan')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h5 class="card-title">Laporan Harian</h5> --}}
                        <!-- Table with stripped rows -->
                        <table id="typebarang-table" class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">NO TRANSAKSI</th>
                                    <th scope="col" width="30%">TANGGAL</th>
                                    <th scope="col" width="30%">TYPE</th>
                                    <th scope="col" width="20%">UOM</th>
                                    <th scope="col" width="20%">QTY</th>
                                    <th scope="col" width="20%">Harga</th>
                                    <th scope="col" width="20%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksidetil as $item)
                                    <tr>
                                        <td>{{ $item->kode_transaksi }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->namatype }}</td>
                                        <td>{{ $item->uom }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->ppn }}</td>
                                        <td>{{ $item->ppn * $item->qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6" style="text-align: right;">Total:</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        {{-- <div class="text-center">

                            <button id="searchBtn" class="btn btn-primary">Search</button>
                            <button id="resetBtn" class="btn btn-secondary">Reset</button>
                        </div> --}}
                    </div>
                </div>
            </div>
    </section>
@endsection
@push('scripts')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#typebarang-table').DataTable({
                responsive: true,
                footer: true
            });

            // Calculate the initial total
            var total = table.column(6).data().sum();
            $("tfoot th:last-child").text(formatRupiah(total));

            // $('#searchBtn').on('click', function() {
            //     var dateRange = $('#dateRangeInput').val();
            //     if (dateRange !== '') {
            //         var startDate = moment(dateRange.split(' - ')[0], 'YYYY-MM-DD').format('YYYY-MM-DD');
            //         var endDate = moment(dateRange.split(' - ')[1], 'YYYY-MM-DD').format('YYYY-MM-DD');

            //         table.columns(1).search(startDate + '|' + endDate, true, false).draw();

            //         // Recalculate the total after each search
            //         var total = table.column(6, {
            //             search: 'applied'
            //         }).data().sum();
            //         $('tfoot th:last-child').text(formatRupiah(total));
            //     }
            // });

            // $('#resetBtn').on('click', function() {
            //     $('#dateRangeInput').val('');
            //     table.columns(1).search('').draw();

            //     // Recalculate the total after resetting
            //     var total = table.column(6).data().sum();
            //     $('tfoot th:last-child').text(formatRupiah(total));
            // });
        });

        // Extend jQuery DataTables with a sum() function
        $.fn.dataTable.Api.register('sum()', function() {
            return this.flatten().reduce(function(a, b) {
                if (typeof a === 'string') {
                    a = a.replace(/[^\d.-]/g, '') * 1;
                }
                if (typeof b === 'string') {
                    b = b.replace(/[^\d.-]/g, '') * 1;
                }

                return a + b;
            }, 0);
        });

        // Format number as Indonesian Rupiah
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(number);
        }
    </script>
    <script>
        $(document).ready(function() {
            // Initialize the date range picker
            $('#dateRangeInput').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY-MM-DD'
                }
            });

            // Clear the date range input when the cancel button is clicked
            $('#dateRangeInput').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });

        // JavaScript code for table and search functionality here
    </script>
@endpush
