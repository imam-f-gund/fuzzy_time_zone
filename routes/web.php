<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendapatanController;


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
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return view('login');;
    }
});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('cek-login', [LoginController::class, 'cek_login'])->name('cek_login');

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('pendapatan', PendapatanController::class);

Route::get('cek', [PendapatanController::class, 'cek']);
