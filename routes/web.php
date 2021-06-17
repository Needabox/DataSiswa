<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Login
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin')->name('postlogin');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    //Siswa
    Route::get('/siswa', 'SiswaController@index')->name('siswa');
    Route::post('/siswa/create', 'SiswaController@create')->name('siswa.tambah');
    Route::get('/siswa/edit/{id}', 'SiswaController@edit')->name('siswa.edit');
    Route::post('/siswa/edit/{id}', 'SiswaController@update')->name('siswa.update');
    Route::get('/siswa/hapus/{id}', 'SiswaController@destroy')->name('siswa.hapus');
    Route::get('/siswa/profile/{id}', 'SiswaController@profile')->name('siswa.profile');
    Route::post('/siswa/tambahnilai/{id}', 'SiswaController@tambahnilai')->name('siswa.tambah.nilai');
});

Route::group(['middleware' => ['auth', 'checkRole:admin,siswa']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});
