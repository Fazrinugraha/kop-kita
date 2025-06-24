<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PengabdianController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\sejarahController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RegulasiController;
use App\Http\Controllers\ManfaatController;
use App\Http\Controllers\KarirController;


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

Route::get('/faq', [App\Http\Controllers\BerandaController::class, 'faq'])->name('front.faq');

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/tentang', [BerandaController::class, 'tentang'])->name('tentang');
Route::get('/sejarah', [BerandaController::class, 'sejarah'])->name('sejarah');
// Route::get('/visi_misi', [BerandaController::class, 'visiMisi'])->name('visi_misi');
Route::get('/team', [BerandaController::class, 'team'])->name('team');

Route::get('/manfaat', [BerandaController::class, 'manfaat'])->name('manfaat');

Route::get('/event', [BerandaController::class, 'event'])->name('event');
Route::get('/event/{id}/{slug}', [BerandaController::class, 'event_detail'])->name('detail.event');

Route::get('/portofolio', [BerandaController::class, 'portofolio'])->name('portofolio');
Route::get('/portofolio/{id}/{slug}', [BerandaController::class, 'portofolio_detail'])->name('detail.portofolio');

Route::get('/kontak', [BerandaController::class, 'kontak'])->name('kontak');

// Frontend Regulasi Routes
Route::get('/regulasi', [BerandaController::class, 'regulasi'])->name('regulasi');
Route::get('/regulasi/download/{id}', [BerandaController::class, 'downloadRegulasi'])->name('regulasi.download');

Route::get('/artikel', [BerandaController::class, 'artikel'])->name('artikel');
Route::get('/artikel/{id}/{slug}', [BerandaController::class, 'artikel_detail'])->name('detail.artikel');

Route::get('/informasi/kegiatan', [BerandaController::class, 'kegiatan'])->name('kegiatan');
Route::get('/informasi/kegiatan/{id}/{slug}', [BerandaController::class, 'kegiatan_detail'])->name('detail.kegiatan');

Route::get('/informasi/pengabdian', [BerandaController::class, 'pengabdian'])->name('pengabdian');
Route::get('/informasi/pengabdian/{id}/{slug}', [BerandaController::class, 'pengabdian_detail'])->name('detail.pengabdian');

Route::get('/informasi/karir', [BerandaController::class, 'karir'])->name('karir');


Route::get('/informasi/karir/{id}/{slug}', [BerandaController::class, 'karir_detail'])->name('detail.karir');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Route::post('/post-login', [AuthController::class, 'login'])->'login';
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'index'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.siswa');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/ganti-password', [AuthController::class, 'ganti_password'])->name('ganti.password');

// ==================
// ADMIN AUTH ROUTES
// ==================
Route::group(['middleware' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/manage-slider', [SliderController::class, 'index'])->name('manage.slider');
    Route::post('/simpan-slider', [SliderController::class, 'store'])->name('store.slider');
    Route::put('/perbaharui-slider/{id}', [SliderController::class, 'update'])->name('update.slider');
    Route::delete('/hapus-slider/{id}', [SliderController::class, 'destroy'])->name('delete.slider');

    Route::get('/manage-tentang', [TentangController::class, 'index'])->name('manage.tentang');
    Route::put('/perbaharui-tentang/{id}', [TentangController::class, 'update'])->name('update.tentang');

    Route::get('/manage-team', [TeamController::class, 'index'])->name('manage.team');
    Route::post('/simpan-team', [TeamController::class, 'store'])->name('store.team');
    Route::put('/perbaharui-team/{id}', [TeamController::class, 'update'])->name('update.team');
    Route::delete('/hapus-team/{id}', [TeamController::class, 'destroy'])->name('delete.team');

    Route::get('/manage-service', [LayananController::class, 'index'])->name('manage.service');
    Route::post('/simpan-service', [LayananController::class, 'store'])->name('store.service');
    Route::put('/perbaharui-service/{id}', [LayananController::class, 'update'])->name('update.service');
    Route::delete('/hapus-service/{id}', [LayananController::class, 'destroy'])->name('delete.service');

    Route::get('/manage-jasa', [JasaController::class, 'index'])->name('manage.jasa');
    Route::post('/simpan-jasa', [JasaController::class, 'store'])->name('store.jasa');
    Route::put('/perbaharui-jasa/{id}', [JasaController::class, 'update'])->name('update.jasa');
    Route::delete('/hapus-jasa/{id}', [JasaController::class, 'destroy'])->name('delete.jasa');

    Route::get('/manage-portofolio', [PortofolioController::class, 'index'])->name('manage.portofolio');
    Route::post('/simpan-portofolio', [PortofolioController::class, 'store'])->name('store.portofolio');
    Route::put('/perbaharui-portofolio/{id}', [PortofolioController::class, 'update'])->name('update.portofolio');
    Route::delete('/hapus-portofolio/{id}', [PortofolioController::class, 'destroy'])->name('delete.portofolio');

    Route::get('/manage-kegiatan', [KegiatanController::class, 'index'])->name('manage.kegiatan');
    Route::post('/simpan-kegiatan', [KegiatanController::class, 'store'])->name('store.kegiatan');
    Route::put('/perbaharui-kegiatan/{id}', [KegiatanController::class, 'update'])->name('update.kegiatan');
    Route::delete('/hapus-kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('delete.kegiatan');

    Route::get('/manage-mitra', [MitraController::class, 'index'])->name('manage.mitra');
    Route::post('/simpan-mitra', [MitraController::class, 'store'])->name('store.mitra');
    Route::put('/perbaharui-mitra/{id}', [MitraController::class, 'update'])->name('update.mitra');
    Route::delete('/hapus-mitra/{id}', [MitraController::class, 'destroy'])->name('delete.mitra');

    Route::get('/manage-event', [EventController::class, 'index'])->name('manage.event');
    Route::post('/simpan-event', [EventController::class, 'store'])->name('store.event');
    Route::put('/perbaharui-event/{id}', [EventController::class, 'update'])->name('update.event');
    Route::delete('/hapus-event/{id}', [EventController::class, 'destroy'])->name('delete.event');

    Route::get('/manage-artikel', [ArtikelController::class, 'index'])->name('manage.artikel');
    Route::post('/simpan-artikel', [ArtikelController::class, 'store'])->name('store.artikel');
    Route::put('/perbaharui-artikel/{id}', [ArtikelController::class, 'update'])->name('update.artikel');
    Route::delete('/hapus-artikel/{id}', [ArtikelController::class, 'destroy'])->name('delete.artikel');

    Route::get('/manage-pengabdian', [PengabdianController::class, 'index'])->name('manage.pengabdian');
    Route::post('/simpan-pengabdian', [PengabdianController::class, 'store'])->name('store.pengabdian');
    Route::put('/perbaharui-pengabdian/{id}', [PengabdianController::class, 'update'])->name('update.pengabdian');
    Route::delete('/hapus-pengabdian/{id}', [PengabdianController::class, 'destroy'])->name('delete.pengabdian');

    Route::get('/manage-kontak', [KontakController::class, 'index'])->name('manage.kontak');
    Route::put('/perbaharui-kontak/{id}', [KontakController::class, 'update'])->name('update.kontak');

    Route::resource('sejarah', sejarahController::class)->except(['create', 'show']);
    Route::resource('visi_misi', VisiMisiController::class)->except(['show']);

    // Pindahkan route contact messages ke sini
    Route::get('/contact-messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])
        ->name('admin.contact-messages.index');
    Route::get('/contact-messages/{contact}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])
        ->name('admin.contact-messages.show');
    Route::delete('/contact-messages/{contact}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])
        ->name('admin.contact-messages.destroy');

    Route::resource('manage-faq', FaqController::class)->except(['show']);

    Route::resource('manage-regulasi', RegulasiController::class)->names([
        'index' => 'admin.manage-regulasi.index',
        'create' => 'admin.regulasi.create',
        'store' => 'admin.regulasi.store',
        'show' => 'admin.regulasi.show',
        'edit' => 'admin.regulasi.edit',
        'update' => 'admin.regulasi.update',
        'destroy' => 'admin.regulasi.destroy'
    ]);

    Route::get('/manage-manfaat', [ManfaatController::class, 'index'])->name('manage-manfaat');
    Route::post('/simpan-manfaat', [ManfaatController::class, 'store'])->name('store.manfaat');
    Route::put('/perbaharui-manfaat/{id}', [ManfaatController::class, 'update'])->name('update.manfaat');
    Route::delete('/hapus-manfaat/{id}', [ManfaatController::class, 'destroy'])->name('delete.manfaat');

    Route::get('/manage-karir', [KarirController::class, 'index'])->name('manage.karir');
    Route::post('/simpan-karir', [KarirController::class, 'store'])->name('store.karir');
    Route::put('/perbaharui-karir/{id}', [KarirController::class, 'update'])->name('update.karir');
    Route::delete('/hapus-karir/{id}', [KarirController::class, 'destroy'])->name('delete.karir');
});
