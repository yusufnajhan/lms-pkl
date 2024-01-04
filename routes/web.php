<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

// admin
Route::get('/dashboardAdmin', function () {
    return view('admin/dashboard');
});

// guru
Route::get('/dashboardGuru', function () {
    return view('guru/dashboard');
});

// siswa
Route::get('/berandaSiswa', function () {
    return view('siswa/beranda');
});
Route::get('/dasborSiswa', function () {
    return view('siswa/dasbor');
});
Route::get('/kelasSiswa', function () {
    return view('siswa/kelas');
});
Route::get('/kelasMatematika', function () {
    return view('siswa/mat');
});