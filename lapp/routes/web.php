<?php
use Carbon\Carbon;
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
Route::get('/carbon', function () {

    $date = '2020-01-16 07:58:04';
    return Carbon::createFromFormat('M d, Y', $date)->toDateTimeString();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/item', 'HomeController@item');
Route::post('/simpan_item', 'HomeController@save_item');
Route::post('/simpancustomer', 'HomeController@save_customer');
Route::post('/add_masterdata', 'HomeController@save_masterdata');
Route::POST('/getbiaya', 'HomeController@get_masterdata_trx');
Route::post('/simpanmasterdata', 'HomeController@simpanmasterdata');
Route::get('/pilih_bce', 'HomeController@bce_template');
Route::get('/pilih_vt', 'HomeController@vt_template');
Route::get('/pilih_rbc', 'HomeController@rbc_template');
Route::get('/pilih_dwb', 'HomeController@dwb_template');
Route::get('/pilih_bpb', 'HomeController@bpb_template');
Route::get('/pilih_lwn', 'HomeController@lwn_template');
Route::get('/pilih_hbw', 'HomeController@hbw_template');
Route::get('/pilih_ghs', 'HomeController@ghs_template');
Route::get('/pilih_pm', 'HomeController@pm_template');
Route::get('/masterdata', 'HomeController@masterdata');
Route::get('/render', 'HomeController@add_tes');
Route::get('/pembayaran', 'HomeController@pembayaran');
Route::get('selectoptioncustomer', 'HomeController@selectoptioncustomer');
Route::get('/tes', 'HomeController@get_session');
Route::get('/add_masterdata', 'HomeController@add_masterdatacustomer');
Route::get('/customer', 'HomeController@add_customer');
Route::post('/save_pembayaran', 'HomeController@simpanPembayaran');
Route::post('/list_transaksi', 'HomeController@list_transaksi');
Route::get('/transaksi', 'HomeController@filter_transaksi');
Route::get('/pengeluaran', 'HomeController@pengeluaran');
Route::post('/save_pengeluaran', 'HomeController@save_pengeluaran');
Route::get('/delete_item/{id_item}', 'HomeController@delete_item');
Route::get('/edit_item/{id}', 'HomeController@edit_item');
Route::post('/simpan_edit_item', 'HomeController@simpan_edit_item');
Route::get('/beverage', 'HomeController@beverage');
Route::get('/selectoptionitem', 'HomeController@selectoptionitem');
Route::get('/export_transaksi', 'HomeController@export_transaksi');
Route::POST('/finditemid', 'HomeController@get_item_id');
Route::POST('/simpanbeverage', 'HomeController@simpanbeverage');
Route::POST('/list_pengeluaran', 'HomeController@list_pengeluaran');
Route::get('/reportpengeluaran', 'HomeController@reportpengeluaran');
Route::POST('/save_transaksi', 'HomeController@simpan_transaksi');

Route::POST('/list_beverage', 'HomeController@list_beverage');
Route::get('/reportbeverage', 'HomeController@reportbeverage');
Route::get('/logout', 'HomeController@logout');
Route::get('/cookie/set', 'HomeController@set_cookie_beverage');
Route::get('/cookie/get', 'HomeController@get_cookie_beverage');
Route::post('/simpan_item_trx', 'HomeController@simpan_item_trx');
Route::get('/flash_msg', function () {
    Session::flash('success', 'Transaksi Berhasil di Input');
    return back();
});
Route::get('/error', function () {
    Session::flash('gagal', 'Stok dan Jumlah Tidak Boleh Kosong');
    return back();
});

Route::get('/invoice/{no}', 'HomeController@get_invoice_detail');
Route::post('/addtochart', 'HomeController@addtochart');
Route::get('/session/hapus', 'HomeController@clear_session');
Route::get('/searchdate', 'HomeController@searchCustomers');
Route::get('/result/{startdate}/{todate}', 'HomeController@searchDateResult');
Route::get('/invoice_trx/{id}', 'HomeController@invoice_trx');
Route::get('/remove-item/{id}', 'HomeController@slice_cart');
Route::get('/inventory', 'HomeController@inventory');
Route::post('/inventory-save', 'HomeController@save_inventory');
Route::get('/inventory-all', 'HomeController@inventory_all');
Route::post('/inventory-get', 'HomeController@get_inventory');
Route::post('/inventory-save-update', 'HomeController@inventorySaveUpdate');
Route::get('/pengeluaran-search', 'HomeController@pengeluaranSearch');
Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/beverage-bills', 'HomeController@beverageBills');
Route::post('/beverage-list', 'HomeController@beverageList');
Route::get('/clear-beverage', 'HomeController@clearBeverageCart');
Route::get('/beverage-post/{id}', 'HomeController@beveragePost');
Route::get('/beverage-search', 'HomeController@beverageSearch');
Route::get('/beverage-remove/{id}', 'HomeController@removeItem');
