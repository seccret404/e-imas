<?php

use App\Models\Guru;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\SiswaBaruController;
use App\Http\Controllers\DashboasrdController;
use App\Http\Middleware\RedirectIfAuthenticated;

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

Route::group(['middleware' => 'prevent-back-history'], function () {

        Route::middleware([RedirectIfAuthenticated::class . ':admin,guru,siswa'])->group(function () {
                Route::get('/', [AuthController::class, 'login'])->name('login');
        });
        Route::post('/login', [AuthController::class, 'proseslogin']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::middleware(['auth', 'role:admin'])->group(function () {
                Route::get('/dashboard', [DashboasrdController::class, 'index']);

                Route::get('/guru', [DashboasrdController::class, 'guru']);
                Route::post('/guru-add', [DashboasrdController::class, 'addguru']);
                Route::get('/guru/edit/{id}', [DashboasrdController::class, 'editg']);
                Route::post('/guru/edit/{id}', [DashboasrdController::class, 'editprosg']);
                Route::post('/guru/{id}/delete', [DashboasrdController::class, 'deleteg']);
                Route::get('/keahlian', [DashboasrdController::class, 'ahli']);
                Route::get('/keahlian/guru/{id}', [DashboasrdController::class, 'detailahli']);



                Route::get('/siswa', [DashboasrdController::class, 'siswa']);
                Route::post('/siswa-add', [DashboasrdController::class, 'addsiswa']);
                Route::get('/siswa/edit/{id}', [DashboasrdController::class, 'edits']);
                Route::post('/siswa/edit/{id}', [DashboasrdController::class, 'editpross']);
                Route::post('/siswa/{id}/delete', [DashboasrdController::class, 'deletes']);


                Route::get('/tahun-akademik', [DashboasrdController::class, 'akademik']);
                Route::post('/akademik-add', [DashboasrdController::class, 'addakademik']);
                Route::post('/akademik/{id}/delete', [DashboasrdController::class, 'deletea']);



                Route::get('/mata-pelajaran', [DashboasrdController::class, 'mapel']);
                Route::post('/matapelajaran-add', [DashboasrdController::class, 'addmapel']);
                Route::post('/pelajaran/{id}/delete', [DashboasrdController::class, 'deletep']);
                Route::get('/pelajaran/edit/{id}', [DashboasrdController::class, 'editp']);
                Route::post('/pelajaran/edit/{id}', [DashboasrdController::class, 'editprosp']);



                //ipa
                Route::get('/ipa-kelas-10', [DashboasrdController::class, 'kelasipax']);
                Route::get('/ipa-kelas-11', [DashboasrdController::class, 'kelasipaxi']);
                Route::get('/ipa-kelas-12', [DashboasrdController::class, 'kelasipaxii']);

                //ips
                Route::get('/ips-kelas-10', [DashboasrdController::class, 'kelasipsx']);
                Route::get('/ips-kelas-11', [DashboasrdController::class, 'kelasipsxi']);
                Route::get('/ips-kelas-12', [DashboasrdController::class, 'kelasipsxii']);

                //jadwal
                Route::post('/jadwal-add', [DashboasrdController::class, 'addjadwal']);
                Route::post('/jadwal/{id}/delete', [DashboasrdController::class, 'deletej']);

                //tugas
                Route::get('/tugas', [DashboasrdController::class, 'indext']);
                Route::post('/tugas-add', [DashboasrdController::class, 'addtugas']);
                Route::post('/tugas/{id}/delete', [DashboasrdController::class, 'deletet']);

                Route::get('/ruangan', [DashboasrdController::class, 'room']);
                Route::post('/ruangan-add', [DashboasrdController::class, 'adroom']);
                Route::post('/ruangan/{id}/delete', [DashboasrdController::class, 'deleter']);
                Route::get('/ruangan/edit/{id}', [DashboasrdController::class, 'editr']);
                Route::post('/ruangan/edit/{id}', [DashboasrdController::class, 'editpros']);

                //pengumuman

                Route::post('/posting', [DashboasrdController::class, 'pengumumanadd']);
                Route::post('/pengumuman/{id_pengumuman}/delete', [DashboasrdController::class, 'delete']);

                Route::get('/pmb.siswabaru/register', [SiswaBaruController::class, 'index']);
                Route::get('/siswa-terdaftar', [DashboasrdController::class, 'pmb']);

                //pesam
                Route::get('/email-all', [PesanController::class, 'pesan']);
                Route::post('/admin/kirim-pesan', [PesanController::class, 'sendMessage']);
                Route::get('/siswa-email',[PesanController::class,'siswa']);
                Route::post('/admin/kirim-siswa',[PesanController::class,'sendsiswa']);
                Route::get('/guru-email',[PesanController::class,'guru']);
                Route::post('/admin/kirim-guru',[PesanController::class,'sendguru']);
                Route::get('/wali-email',[PesanController::class,'wali']);

                //surat masuk
                Route::get('/guru-surat', [SuratController::class, 'guru']);
                Route::get('/siswa-surat', [SuratController::class, 'siswa']);
                Route::post('/konfirmasi-izin/{id}', [SuratController::class, 'konfirmasi']);
                Route::post('/konfirmasi-tolak/{id}', [SuratController::class, 'tolak']);


                //prestasi
                Route::get('/prestasi-admin',[PrestasiController::class,'index']);
        });

        Route::middleware(['auth', 'role:siswa'])->group(function () {

                //siswa
                Route::get('/dashboard/siswa', [SiswaController::class, 'index']);
                //crud surat
                Route::get('/surat', [SiswaController::class, 'surat']);
                Route::post('/surat-add', [SiswaController::class, 'addsurat']);
                Route::get('/surat/edit/{id}', [SiswaController::class, 'editsurat']);
                Route::post('/surat/edit/{id}', [SiswaController::class, 'editsuratpros']);
                Route::post('/surat/{id}/delete', [SiswaController::class, 'deletesurat']);

                Route::get('/tugas-siswa', [SiswaController::class, 'tugas']);

                Route::get('/absen', [SiswaController::class, 'absen']);
                //ruangan
                Route::post('/presensi/store', [SiswaController::class, 'store']);


                //forum
                Route::get('/forum', [ForumController::class, 'forum']);
                Route::post('/pertanyaan-add', [ForumController::class, 'addforum']);
                Route::get('/jawaban-detail/{id_q}', [ForumController::class, 'detail']);
                Route::delete('posts/{id}', [ForumController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
                Route::delete('jawaban/{id}', [ForumController::class, 'destroyj'])->name('jawaban.destroy')->middleware('auth');
                Route::post('/jawaban-add', [ForumController::class, 'jawban']);

                //prestasi
                Route::get('/prestasi', [SiswaController::class, 'prestasi']);
                Route::post('/prestasi-add', [SiswaController::class, 'addpres']);
                Route::post('/prestasi/{id}/delete', [SiswaController::class, 'deletepres']);
                //tugas
                Route::get('/upload/{id}', [SiswaController::class, 'addtugas']);
                Route::post('/upload-tugas', [SiswaController::class, 'unggah']);

                Route::get('/hasil-tugas/view/{id_user}/{id_tugas}', [SiswaController::class, 'hasil'])->name('hasil-tugas.view');

                //pengumuman
                Route::get('/pengumuman/{id_pengumuman}', [SiswaController::class, 'detail']);


        //profil
        Route::get('/profil/{id}', [SiswaController::class, 'profil']);


        //absen
        Route::get('/detail-absen',[AbsensiController::class,'absens_siswa']);
        Route::post('/update-absen/{id}',[AbsensiController::class,'update']);
});

        Route::middleware(['auth', 'role:guru'])->group(function () {
                Route::get('/dashboard/guru', [GuruController::class, 'index']);
                //crud surat
                Route::get('/suratguru', [GuruController::class, 'surat']);
                Route::post('/suratguru-add', [GuruController::class, 'addsurat']);
                Route::get('/suratguru/edit/{id}', [GuruController::class, 'editsurat']);
                Route::post('/suratguru/edit/{id}', [GuruController::class, 'editsuratpros']);
                Route::post('/suratguru/{id}/delete', [GuruController::class, 'deletesurat']);

                //tugas
                Route::get('/tugasguru', [GuruController::class, 'indext']);
                Route::post('/tugasguru-add', [GuruController::class, 'addtugas']);
                Route::post('/tugasguru/{id}/delete', [GuruController::class, 'deletet']);
        });

        //siswa baru
        Route::get('/pmb.siswabaru/register', [SiswaBaruController::class, 'index']);
});
