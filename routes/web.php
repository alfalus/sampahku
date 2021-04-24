<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Posts;
use App\Http\Livewire\Orders;
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
    return view('homepage');
});

Route::middleware(
    ['auth:sanctum', 'verified'],
    ['prefix','transaksi'],
)->group(function(){
    // Route::get('/dashboard','App\Http\Controllers\NewsController@index')->name('dashboard');
    Route::get('/','App\Http\Controllers\NewsController@index')->name('dashboard');
    Route::get('/transaksi',Orders::class)->name('transaksi');
    Route::get('/reward','App\Http\Controllers\RewardController@index')->name('reward');
    Route::get('/lokasi','App\Http\Controllers\MapsController@index')->name('lokasi');
});

// Route::middleware(['auth:sanctum', 'verified'])->prefix('transaksi')->group(function(){
//     Route::get('/',Orders::class)->name('transaksi');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('post', Posts::class)->name('post');

//sample
Route::get('gis',function(){
    return view('gis-sample');
});

