<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TypebarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TujuanController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FinanceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {
      Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);

    Route::get('typecek', [TypebarangController::class, 'index'])->name('Typebarang.index');
    Route::get('typecreate', [TypebarangController::class, 'create'])->name('Typebarang.create');
    Route::post('type', [TypebarangController::class, 'store'])->name('Typebarang.store');
    Route::POST('/updateTypebarang/{id}', [TypebarangController::class, 'updateTypebarang'])->name('Typebarang.updateTypebarang');
    Route::get('/getTypebarang/{id}', [TypebarangController::class, 'getTypebarang'])->name('Typebarang.getTypebarang');
    Route::delete('/deleteTypebarang/{id}', [TypebarangController::class, 'deleteTypebarang'])->name('Typebarang.deleteTypebarang');
    Route::get('/typebarang/search', [TypebarangController::class, 'search'])->name('Typebarang.search');


    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksicreate', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('simpantrans', [TransaksiController::class, 'simpantrans'])->name('transaksi.simpantrans');
    Route::get('getData', [TransaksiController::class, 'getData'])->name('transaksi.getData');

    Route::get('angsuran', [AngsuranController::class, 'index'])->name('angsuran.index');
    Route::get('/angsurancreate', [AngsuranController::class, 'create'])->name('angsuran.create');
    Route::get('getData', [AngsuranController::class, 'getData'])->name('angsuran.getData');
    Route::post('/angsuran/simpan', [AngsuranController::class, 'store'])->name('angsuran.store');
    Route::get('/angsuran/print/{kodetype}', [AngsuranController::class, 'print'])->name('angsuran.print');



    Route::get('/ekpedisicreate', [EkspedisiController::class, 'create'])->name('ekspedisi.create');
    Route::post('/ekspedisi/store', [EkspedisiController::class, 'store'])->name('ekspedisi.store');
    Route::get('/ekspedisi/cetak/{id}', [EkspedisiController::class, 'cetak'])->name('ekspedisi.cetak');
    Route::get('/ekspedisi/cetak-periode', [EkspedisiController::class, 'cetakPeriode'])->name('ekspedisi.cetakPeriode');
    Route::get('/ekspedisi/cetak-periodesemua', [EkspedisiController::class, 'cetakPeriodesemua'])->name('ekspedisi.cetakPeriodesemua');
    Route::get('ekspedisi', [EkspedisiController::class, 'index'])->name('ekspedisi.index');
    Route::get('/servicecreate', [ServiceController::class, 'create'])->name('serviced.create');
    Route::post('/simpanserviced', [ServiceController::class, 'simpanserviced'])->name('serviced.simpanserviced');


    Route::POST('/tujuan', [TujuanController::class, 'simpan'])->name('tujuan.simpan');
    Route::get('/tujuan', [TujuanController::class, 'index'])->name('tujuan.index');
    Route::get('/cek-tujuan', [TujuanController::class,'cekduplikat'])->name('tujuan.cekduplikat');
    Route::delete('/tujuan/{id}', [TujuanController::class, 'destroy'])->name('tujuan.hapus');
    Route::get('/tujuan/{id}/edit', [TujuanController::class, 'edit']);
    Route::put('/tujuan/{id}', [TujuanController::class, 'update']);
    // Tampilkan form pencarian
    Route::get('/service/pertanggal-type', [ServiceController::class, 'laporanServiced'])->name('serviced.laporanServiced');
    // Proses filter data
    Route::get('/service/cari-pertanggal-type', [ServiceController::class, 'cariLaporanServiced'])->name('serviced.cariLaporanServiced');
    Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('serviced.edit');
    Route::put('/service/update{id}', [ServiceController::class, 'update'])->name('serviced.update');
    Route::delete('/service/delete/{id}', [ServiceController::class, 'destroy'])->name('serviced.destroy');




    Route::get('laporanhari', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('indexhargajual', [LaporanController::class, 'indexhargajual'])->name('laporan.indexhargajual');
    Route::get('laporanminggu', [LaporanController::class, 'indexminggu'])->name('laporan.indexminggu');

    Route::get('inputlaporanbulananpertanggal', [LaporanController::class, 'inputlaporanbulananpertanggal'])->name('laporan.inputlaporanbulananpertanggal');
    Route::get('laporanbulananpertanggal/{tglawal}/{tglakhir}', [LaporanController::class, 'laporanbulananpertanggal'])->name('laporan.laporanbulananpertanggal');
    Route::get('laporanlaba/{tglawal}/{tglakhir}', [LaporanController::class, 'laporanlaba'])->name('laporan.laporanlaba');


    Route::get('chart', [ChartController::class, 'index'])->name('chart.index');



    Route::get('Supirsearch', [DriverController::class, 'search'])->name('Supir.search');

    // Finance keuangan
    Route::get('index', [financeController::class, 'index'])->name('finance.index');

});