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
    Route::delete('/data/hapus/{id}', [TypebarangController::class, 'hapus'])->name('Typebarang.hapus');
    Route::get('/typebarang/edit/{id}', [TypebarangController::class, 'edit'])->name('Typebarang.edit');
    Route::put('/data/update/{id}', [TypebarangController::class, 'update'])->name('Typebarang.update');

    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksicreate', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('simpantrans', [TransaksiController::class, 'simpantrans'])->name('transaksi.simpantrans');
    Route::get('getData', [TransaksiController::class, 'getData'])->name('transaksi.getData');
    

    Route::get('laporanhari', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('indexhargajual', [LaporanController::class, 'indexhargajual'])->name('laporan.indexhargajual');
    Route::get('laporanminggu', [LaporanController::class, 'indexminggu'])->name('laporan.indexminggu');



    Route::get('chart', [ChartController::class, 'index'])->name('chart.index');
    // Route::get('indexhargajual', [LaporanController::class, 'indexhargajual'])->name('laporan.indexhargajual');
    // Route::get('laporanminggu', [LaporanController::class, 'indexminggu'])->name('laporan.indexminggu');
    // Route::get('/get-data', function (Request $request) {
    //     // Dapatkan data dari request (contoh: hardcoded array)
    //     $data = [
    //         [
    //             'kodetype' => 'KT001',
    //             'namatype' => 'Type A',
    //             'uom' => 'PCS',
    //             'hargabaru' => '10000',
    //             'ppn' => '10'
    //         ],
    //         [
    //             'kodetype' => 'KT002',
    //             'namatype' => 'Type B',
    //             'uom' => 'BOX',
    //             'hargabaru' => '50000',
    //             'ppn' => '5'
    //         ],
    //         [
    //             'kodetype' => 'KT003',
    //             'namatype' => 'Type C',
    //             'uom' => 'KG',
    //             'hargabaru' => '20000',
    //             'ppn' => '8'
    //         ]
    //     ];
    
    //     return response()->json($data);
    // });

    // Route::post('/simpantransaksi', [TransaksiController::class,'simpantransaksi'])->name('transaksi.simpantransaksi');
});
