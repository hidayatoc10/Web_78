<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MuridController;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('loginView');
    Route::post('/login', [AuthController::class, 'loginPost']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard_admin', [AdminController::class, 'dashboard'])->name('dashboard_admin');
    Route::get('/data_kelas', [AdminController::class, 'data_kelas'])->name('data_kelas');
    Route::get('/hapus_kelas/{kelas}', [AdminController::class, 'hapus_kelas']);
    Route::put('/update_kelas/{kelas}', [AdminController::class, 'update_kelas'])->name('update_kelas');
    Route::post('/tambah_kelas', [AdminController::class, 'tambah_kelas'])->name('tambah_kelas');
    Route::get('/mata_pelajaran', [AdminController::class, 'mata_pelajaran'])->name('mata_pelajaran');
    Route::post('/tambah_pelajaran', [AdminController::class, 'tambah_pelajaran'])->name('tambah_pelajaran');
    Route::put('/update_pelajaran/{nama_pelajaran}', [AdminController::class, 'update_pelajaran'])->name('update_pelajaran');
    Route::get('/hapus_pelajaran/{nama_pelajaran}', [AdminController::class, 'hapus_pelajaran']);
    Route::get('/pengguna_sistem', [AdminController::class, 'pengguna_sistem'])->name('pengguna_sistem');
    Route::post('/tambah_pengguna', [AdminController::class, 'tambah_pengguna'])->name('tambah_pengguna');
    Route::put('/update_pengguna/{username}', [AdminController::class, 'update_pengguna'])->name('update_pengguna');
    Route::get('/hapus_pengguna/{username}', [AdminController::class, 'hapus_pengguna']);
    Route::get('/akun_saya', [AdminController::class, 'akun_saya'])->name('akun_saya');
    Route::put('/update_akun/{id}', [AdminController::class, 'update_akun'])->name('update_akun');
    Route::get('/siswa', [AdminController::class, 'siswa'])->name('siswa');
    Route::post('/tambah_siswa', [AdminController::class, 'tambah_siswa'])->name('tambah_siswa');
    Route::get('/hapus_siswa/{nisn}', [AdminController::class, 'hapus_siswa'])->name('hapus_siswa');
    Route::put('/update_siswa/{nisn}', [AdminController::class, 'update_siswa'])->name('update_siswa');
    Route::get('/guru', [AdminController::class, 'guru'])->name('guru');
    Route::post('/tambah_guru', [AdminController::class, 'tambah_guru'])->name('tambah_guru');
    Route::get('/hapus_guru/{nip}', [AdminController::class, 'hapus_guru'])->name('hapus_guru');
    Route::put('/update_guru/{nip}', [AdminController::class, 'update_guru'])->name('update_guru');
    Route::get('/materii', [AdminController::class, 'materi'])->name('materii');
    Route::get('/hapus_materii/{judul_materi}', [AdminController::class, 'hapus_materi'])->name('hapus_materi');
    Route::get('/tugass', [AdminController::class, 'tugas'])->name('tugass');
    Route::get('/hapus_tugass/{judul_tugas}', [AdminController::class, 'hapus_tugas'])->name('hapus_tugas');
    Route::get('/logoutAdmin', [AuthController::class, 'logoutAdmin']);
});

Route::middleware(['auth', 'guru'])->group(function () {
    Route::get('/dashboard_guru', [GuruController::class, 'dashboard_guru'])->name('dashboard_guru');
    Route::get('/materi', [GuruController::class, 'materi'])->name('materi');
    Route::post('/tambah_materi', [GuruController::class, 'tambah_materi'])->name('tambah_materi');
    Route::post('/tambah_tugas', [GuruController::class, 'tambah_tugas'])->name('tambah_tugas');
    Route::get('/hapus_materi/{judul_materi}', [GuruController::class, 'hapus_materi'])->name('hapus_materi');
    Route::get('/akun_saya', [GuruController::class, 'akun_saya'])->name('akun_saya');
    Route::get('/tugas', [GuruController::class, 'tugas'])->name('tugas');
    Route::get('/logoutGuru', [AuthController::class, 'logoutGuru']);
});

Route::middleware(['auth', 'murid'])->group(function () {
    Route::get('/dashboard_murid', [MuridController::class, 'dashboard_murid'])->name('dashboard_murid');
    Route::get('/logoutMurid', [AuthController::class, 'logoutMurid']);
});
