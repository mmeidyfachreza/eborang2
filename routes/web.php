<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;

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
Auth::routes();

Route::get('/','indexController@index');
Route::post('/pencarian/pt','indexController@search1')->name('guest.searchpt');
Route::post('/pencarian/sarjana','indexController@search2')->name('guest.searchsarjana');
Route::post('/pencarian/sarjana/{title}','indexController@searchbykat1')->name('guest.searchsarjana2');
Route::post('/pencarian/pt/{title}','indexController@searchbykat2')->name('guest.searchpt2');
Route::get('/dokumen-sarjana/{slug}','indexController@showSarjana');
Route::get('/dokumen-perguruan-tinggi/{slug}','indexController@showPerguruanTinggi');


Route::middleware(['Khusus:admin'])->group(function () {
    Route::resource('katdokpt', 'KatdokptController');
    Route::resource('katdoksarjana', 'KatdoksarjanaController');
    Route::resource('admin/user', 'userController');
    Route::get('admin','adminController@index')->name('admin.dashboard');
    Route::post('/user','userController@search')->name('user.search');
    //Route::resource('admin/dokumen', 'DokumenController');
});

Route::middleware(['Khusus:prodi|admin'])->group(function () {
    Route::get('/prodi','operatorController@index')->name('prodi.dashboard');
    Route::resource('dok_sarjana', 'DokSarjanaController');
    Route::resource('dok_pt', 'DokPtController');

});

Route::middleware(['Khusus:admin|prodi|pemimpin'])->group(function () {
    Route::get('dok_sarjana/{uuid}/download','DokSarjanaController@download')->name('dok_sarjana.download'); 
    Route::get('dok_pt/{uuid}/download','DokPtController@download')->name('dok_pt.download');    
});


Route::get('/tes', function () {
    return view('auth.login2');
});


