<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Hasil;
use App\Models\Surat;
use App\Models\Tugas;
use App\Models\Ujian;
use App\Models\Jadwal;
use App\Models\Prestasi;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Symfony\Contracts\Service\Attribute\Required;

class SiswaController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::now();
        $id_user = Auth::user()->id_user;
        $id = Auth::user()->id;
        $tgl = $hariIni->format('d-m-Y');
        $jurusan = Auth::user()->jurusan;
        $kelas = Auth::user()->kelas;
        $hari = $hariIni->formatLocalized('%A');
        setlocale(LC_TIME, 'id_ID'); // Set locale ke Bahasa Indonesia
        $hariSekarang = strftime('%A');
        // dd($jurusan);
        $tgl_presensi = date("Y-m-d");

        $cek = DB::table('presensisiswa')->where('tgl_presensi', $tgl_presensi)->where('nisn', $id_user)->count();
        if ($cek > 0) {
            $status = "Hadir";
        } else {
            $status = "Tidak Hadir";
        }

        // $jadwal = Jadwal::where('hari', $hariSekarang)->get();
        $jadwal = DB::table('jadwal')
            ->join('guru', 'jadwal.kode_guru', '=', 'guru.kode_guru')
            ->join('ruangan', 'jadwal.ruangan', '=', 'ruangan.id')
            ->where('jurusan', $jurusan)
            ->where('kelas', $kelas)
            ->where('hari', $hariSekarang)
            ->select('jadwal.*', 'guru.nama as nama_guru', 'ruangan.nama_ruangan')
            ->orderBy('jadwal.jam_masuk', 'asc')
            ->get();


        $pengumuman = DB::table('pengumuman')->orderBy('created_at', 'desc')->get();
        $prestasi = DB::table('prestasi')->where('id_user', $id)->count();

        $mapel = DB::table('jadwal')
            ->where('jurusan', $jurusan)->where('kelas', $kelas)->distinct('jadwal.nama_pelajaran')->count();

        $jmlhsiswa = DB::table('siswa')->where('jurusan', $jurusan)->where('kelas', $kelas)->count();

        $nisn = Auth::user()->id_user;
        $namaWali = DB::table('siswa')->join('guru', 'siswa.id_guru', '=', 'guru.id')->select('guru.nama as nama_guru')
            ->where('nisn', $nisn)
            ->get();

        return view('siswa.index', compact('jadwal', 'hari', 'tgl', 'status', 'pengumuman', 'prestasi', 'mapel', 'jmlhsiswa', 'namaWali'));
    }

    public function surat()
    {
        $surat = DB::table('surat_izins')->where('id_user', Auth::user()->id)->get();
        $nama = Auth::user()->name;
        // dd($namasaya);
        return view('siswa.surat_izin.index', compact('surat', 'nama'));
    }

    public function addsurat(Request $request)
    {
        $id_user = Auth::user()->id;
        $nama_request = $request->nama;
        $jenis = $request->input('jenis');
        $keterangan = $request->keterangan;
        $mulai = $request->mulai;
        $selesai = $request->selesai;

        if ($request->hasFile('tambahan')) {
            $file = $request->file('tambahan');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/surat';
            $file->move($tujuanFile, $namafile);
        } else {
            $namafile = null;
        }

        $data = [
            'id_user' => $id_user,
            'nama_request' => $nama_request,
            'jenis_surat' => $jenis,
            'keterangan_surat' => $keterangan,
            'keterangan_tambahan' => $namafile,
            'waktu_mulai' => $mulai,
            'waktu_berakhir' => $selesai,
            'role' => Auth::user()->role,
            'status' => 0,
        ];

        $simpan = DB::table('surat_izins')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Surat Izin berhasil tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal tambah']);
        }
    }

    public function editsurat($id)
    {
        $surat = Surat::find($id);

        return view('siswa.surat_izin.edit', compact('surat'));
    }

    public function editsuratpros(Request $request, $id)
    {
        // Validasi inputan jika diperlukan
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ]);

        // Ambil data surat berdasarkan ID
        $surat = Surat::find($id);

        // Simpan gambar lama
        $namafile = $surat->keterangan_tambahan;

        // Update data surat dengan nilai inputan
        $surat->nama_request = $request->nama;
        $surat->jenis_surat = $request->jenis;
        $surat->keterangan_surat = $request->keterangan;
        $surat->waktu_mulai = $request->mulai;
        $surat->waktu_berakhir = $request->selesai;
        if ($request->hasFile('tambahan')) {
            $file = $request->file('tambahan');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/surat';
            $file->move($tujuanFile, $namafile);
        }

        $surat->keterangan_tambahan = $namafile;


        // Simpan perubahan
        $surat->save();

        if ($surat) {
            return redirect('/surat')->with(['success' => "Surat Izin Berhasil Di Update!"]);
        } else {
            return redirect('/surat')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }

    public function deletesurat($id)
    {
        $delete = DB::table('surat_izins')->where('id', $id)->delete();

        if ($delete) {
            return redirect('/surat')->with(['success' => "Data Berhasil Di Hapus"]);
        } else {
            return redirect('/surat')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }

    public function tugas()
    {
        $hariIni = Carbon::now();
        $id_user = Auth::user()->id;
        $tgl = $hariIni->format('d-m-Y');
        $jurusan = Auth::user()->jurusan;
        $kelas = Auth::user()->kelas;
        $hari = $hariIni->formatLocalized('%A');
        setlocale(LC_TIME, 'id_ID'); // Set locale ke Bahasa Indonesia
        $hariSekarang = strftime('%A');
        //dd($hariSekarang);
        $tgl_presensi = date("Y-m-d");

        $tugas = DB::table('tugas')
            ->leftJoin('hasiltugas', function ($join) use ($id_user) {
                $join->on('tugas.id_tugas', '=', 'hasiltugas.id_tugas')
                    ->where('hasiltugas.id_user', $id_user);
            })
            ->whereNull('hasiltugas.id_user')
            ->where('tugas.jurusan', $jurusan)
            ->where('tugas.kelas', $kelas)
            ->where('tugas.dedline', '>=', $tgl_presensi)
            ->orderBy('tugas.dedline', 'asc')
            ->select('tugas.*', 'hasiltugas.uploaded', 'hasiltugas.nilai')
            ->get();

        $warna = DB::table('tugas')->get();
        if ($warna > $hariSekarang) {
            $bg = "text-primary";
        } else if ($warna = $hariSekarang) {
            $bg = "text-warning";
        }

        return view('siswa.tugas', compact('tugas', 'hari', 'tgl', 'bg'));
    }


    public function tugasterkirim()
    {
        $hariIni = Carbon::now();
        $id_user = Auth::user()->id;
        $tgl = $hariIni->format('d-m-Y');
        $jurusan = Auth::user()->jurusan;
        $kelas = Auth::user()->kelas;
        $hari = $hariIni->formatLocalized('%A');
        setlocale(LC_TIME, 'id_ID'); // Set locale ke Bahasa Indonesia
        $hariSekarang = strftime('%A');
        //dd($hariSekarang);
        $tgl_presensi = date("Y-m-d");

        $tugas = DB::table('tugas')
            ->join('hasiltugas', 'tugas.id_tugas', '=', 'hasiltugas.id_tugas')
            ->where('hasiltugas.id_user', $id_user)
            ->where('tugas.jurusan', $jurusan)
            ->where('tugas.kelas', $kelas)
            // ->where('tugas.dedline', '>=', $tgl_presensi)
            ->orderBy('tugas.dedline', 'desc')
            ->select('tugas.*', 'hasiltugas.uploaded', 'hasiltugas.nilai')
            ->get();

        $warna = DB::table('tugas')->get();
        if ($warna > $hariSekarang) {
            $bg = "text-primary";
        } else if ($warna = $hariSekarang) {
            $bg = "text-warning";
        }

        return view('siswa.tugasterkirim', compact('tugas', 'hari', 'tgl', 'bg'));
    }


    public function tugasterlambat()
    {
        $hariIni = Carbon::now();
        $id_user = Auth::user()->id;
        $tgl = $hariIni->format('d-m-Y');
        $jurusan = Auth::user()->jurusan;
        $kelas = Auth::user()->kelas;
        $hari = $hariIni->formatLocalized('%A');
        setlocale(LC_TIME, 'id_ID'); // Set locale ke Bahasa Indonesia
        $hariSekarang = strftime('%A');
        //dd($hariSe$karang);
        $tgl_presensi = date("Y-m-d");

        $tugas = DB::table('tugas')
            ->leftJoin('hasiltugas', function ($join) use ($id_user) {
                $join->on('tugas.id_tugas', '=', 'hasiltugas.id_tugas')
                    ->where('hasiltugas.id_user', $id_user);
            })
            ->where('tugas.jurusan', $jurusan)
            ->where('tugas.kelas', $kelas)
            ->where('tugas.dedline', '<', $tgl_presensi)
            ->whereNull('hasiltugas.id_user')
            ->orderBy('tugas.dedline', 'asc')
            ->select('tugas.*', 'hasiltugas.uploaded', 'hasiltugas.nilai')
            ->get();

        $warna = DB::table('tugas')->get();
        if ($warna > $hariSekarang) {
            $bg = "text-primary";
        } else if ($warna = $hariSekarang) {
            $bg = "text-warning";
        }


        return view('siswa.tugasterlambat', compact('tugas', 'hari', 'tgl', 'bg'));
    }



    public function absen()
    {
        $status = DB::table('presensisiswa')->first();

        return view('siswa.absen', compact('status'));
    }
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $id_user = Auth::user()->id_user;
            $tgl_presensi = date("Y-m-d");
            $jam = date("H:i:s");
            $latitudekantor = 3.597889;
            $longitudekantor = 98.747934;
            $latitudeuser = $request->input('lokasiin');
            $longitudeuser = $request->input('lokasion');
            $lokasi = $latitudeuser . ',' . $longitudeuser;
            $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
            $radius = round($jarak["meters"]);

            $cek = DB::table('presensisiswa')->where('tgl_presensi', $tgl_presensi)->where('nisn', $id_user)->count();
            if ($radius > 1000) {
                return Redirect::back()->with(['warning' => "Anda Berada Diluar Radius Sekolah"]);
            } else {
                if ($cek > 0) {
                    return redirect('/dashboard/siswa')->with(['success' => "Telah Melakukan Absen"]);
                } else {
                    // Handle image upload
                    if ($request->has('captured_image')) {
                        $imageDataUri = $request->input('captured_image');
                        $imagePath = 'public/absen/siswa/' . uniqid() . '.jpg';
                        $image = Image::make($imageDataUri)->encode('jpg', 80);
                        Storage::disk('public')->put($imagePath, $image);

                        // Save the image path to the 'gambar' column
                        $gambar = $imagePath;
                    } else {
                        // If the image is not captured, you can set a default image path or handle it accordingly
                        $gambar = 'path/to/default/image.jpg';
                    }



                    $data = [
                        'id_siswa' => $id,
                        'nisn' => $id_user,
                        'tgl_presensi' => $tgl_presensi,
                        'jam_masuk' => $jam,
                        'jam_keluar' => Null,
                        'gambar' => $gambar, // Save the image path to the 'gambar' column
                        'location_masuk' => $lokasi,
                        'lokasi_keluar' => Null
                    ];

                    $simpan = DB::table('presensisiswa')->insert($data);
                    if ($simpan) {
                        return redirect('/detail-absen')->with(['success' => "Absen Selesai Selamat Belajar"]);
                    } else {
                        return redirect('/detail-absen')->with(['error' => "Absen Gagal"]);
                    }
                }
            }
        }
    }




    public function prestasi()
    {
        $id_user = Auth::user()->id;

        $prestasi = DB::table('prestasi')->where('id_user', $id_user)->get();
        return view('siswa.prestasi.index', compact('prestasi'));
    }
    public function addpres(Request $request)
    {
        $id_user = Auth::user()->id;
        $nama_prestasi = $request->nama_prestasi;
        $catatan = $request->catatan;
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/prestasi';
        $file->move($tujuanFile, $namafile);

        $data = [
            'nama_prestasi' => $nama_prestasi,
            'id_user' => $id_user,
            'file' => $namafile,
            'catatan' => $catatan
        ];

        $simpan = DB::table('prestasi')->insert($data);

        if ($simpan) {
            return Redirect::back()->with(['success' => 'Prestasi berhasil Tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal di proses']);
        }
    }

    public function editprestasi($id)
    {
        $prestasiId = Prestasi::find($id);
        $prestasi = DB::table('prestasi')->where('id', $id)->first();
        return view('siswa.prestasi.edit', compact('prestasi', 'prestasiId'));
    }

    public function editprestasipros(Request $request, $id)
    {
        $request->validate([
            'nama_prestasi' => 'required|min:2',
            'catatan' => 'required|min:5',
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $prestasi = Prestasi::find($id);

        $prestasi->nama_prestasi = $request->nama_prestasi;
        $prestasi->catatan = $request->catatan;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/prestasi';
            $file->move($tujuanFile, $namafile);
            $prestasi->file = $namafile;
        }

        $prestasi->save();

        if ($prestasi) {
            return redirect('/prestasi')->with(['success' => "Data Prestasi Berhasil Diupdate!"]);
        } else {
            return redirect('/prestasi')->with(['error' => "Data Gagal Di Edit"]);
        }
    }


    public function deletepres($id)
    {

        $delete = DB::table('prestasi')->where('id', $id)->delete();
        if ($delete) {
            return redirect('/prestasi')->with(['success' => "Prestasi Berhasil Di Hapus!"]);
        } else {
            return redirect('/prestasi')->with(['error' => "Gagal Di Hapus!"]);
        }
    }

    public function addtugas($id)
    {
        $tugas = Tugas::find($id);
        return view('siswa.upload_tugas', compact('tugas'));
    }

    public function unggah(Request $request)
    {
        $id_user = Auth::user()->id;
        $nama = Auth::user()->name;
        $id_tugas = $request->id_tugas;
        $mapel = $request->nama_pelajaran;
        $dedline = $request->dedline;

        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/hasil';
        $file->move($tujuanFile, $namafile);

        // Cek apakah sudah ada entri untuk tugas ini dari pengguna yang sama
        $existingSubmission = DB::table('hasiltugas')
            ->where('id_tugas', $id_tugas)
            ->where('id_user', $id_user)
            ->first();

        if ($existingSubmission) {
            // Jika ada, lakukan pembaruan data
            DB::table('hasiltugas')
                ->where('id_tugas', $id_tugas)
                ->where('id_user', $id_user)
                ->update([
                    'nama_pengumpul' => $nama,
                    'mata_pelajaran' => $mapel,
                    'file_hasil_tugas' => $namafile,
                    'dedline' => $dedline,
                    'uploaded' => 1,
                    'created_at' => Carbon::now(),
                ]);

            return redirect('/tugas-siswa')->with(['success' => 'Tugas Telah Diperbarui']);
        } else {
            // Jika tidak ada, buat entri baru
            $data = [
                'id_tugas' => $id_tugas,
                'nama_pengumpul' => $nama,
                'id_user' => $id_user,
                'mata_pelajaran' => $mapel,
                'file_hasil_tugas' => $namafile,
                'dedline' => $dedline,
                'uploaded' => 1,
                'created_at' => Carbon::now(),
            ];

            $simpan = DB::table('hasiltugas')->insert($data);
            if ($simpan) {
                return redirect('/tugas-siswa')->with(['success' => 'Tugas Telah Terkirim']);
            } else {
                return redirect('/tugas-siswa')->with(['error' => 'Tugas Gagal Di Kirim']);
            }
        }
    }


    public function hasil($id_tugas)
    {

        $id_user = Auth::user()->id;

        $item = DB::table('hasiltugas')
            ->join('tugas', 'tugas.id_tugas', '=', 'hasiltugas.id_tugas')
            ->where('hasiltugas.id_user', $id_user)
            ->where('hasiltugas.id_tugas', $id_tugas)
            ->select('tugas.dedline', 'hasiltugas.file_hasil_tugas', 'hasiltugas.created_at', 'tugas.id_tugas', 'hasiltugas.nilai')
            ->first();
        // dd($item);

        return view('siswa.finish', compact('item'));
    }

    public function detail($id_pengumuman)
    {
        $pengumuman = Pengumuman::find($id_pengumuman);

        return view('siswa.detail_pengumuman', compact('pengumuman'));
    }

    public function profil($id_user)
    {
        $id_user = Auth::user()->id_user;
        $siswa = DB::table('siswa')
            ->where('nisn', $id_user)->get();
        return view('siswa.profil', compact('siswa'));
    }

    public function ujian()
    {
        $hariIni = Carbon::now();
        $id_user = Auth::user()->id;
        $tgl = $hariIni->format('d-m-Y');
        $jurusan = Auth::user()->jurusan;
        $kelas = Auth::user()->kelas;
        $hari = $hariIni->formatLocalized('%A');
        setlocale(LC_TIME, 'id_ID'); // Set locale ke Bahasa Indonesia
        $hariSekarang = strftime('%A');
        $tgl_presensi = date("Y-m-d");

        $ujian = DB::table('ujian')
            ->leftJoin('hasilujian', function ($join) use ($id_user) {
                $join->on('ujian.id', '=', 'hasilujian.id_ujian')
                    ->where('hasilujian.id_siswa', $id_user);
            })
            ->where('hasilujian.id_siswa', null)
            ->where('ujian.jurusan', $jurusan)
            ->where('ujian.kelas', $kelas)
            ->where('ujian.dedline', '>=', $tgl_presensi)
            ->orderBy('ujian.dedline', 'asc')
            ->select('ujian.*', 'hasilujian.uploaded', 'hasilujian.nilai')
            ->get();

        $warna = DB::table('ujian')->get();
        if ($warna > $hariSekarang) {
            $bg = "text-primary";
        } else if ($warna = $hariSekarang) {
            $bg = "text-warning";
        }

        return view('siswa.ujian', compact('ujian', 'hari', 'tgl', 'bg'));
    }


    public function ujianterkirim()
    {
        $hariIni = Carbon::now();
        $id_user = Auth::user()->id;
        $tgl = $hariIni->format('d-m-Y');
        $jurusan = Auth::user()->jurusan;
        $kelas = Auth::user()->kelas;
        $hari = $hariIni->formatLocalized('%A');
        setlocale(LC_TIME, 'id_ID'); // Set locale ke Bahasa Indonesia
        $hariSekarang = strftime('%A');
        $tgl_presensi = date("Y-m-d");

        $ujian = DB::table('ujian')
            ->join('hasilujian', 'ujian.id', '=', 'hasilujian.id_ujian')
            ->where('hasilujian.id_siswa', $id_user)
            ->where('ujian.jurusan', $jurusan)
            ->where('ujian.kelas', $kelas)
            // ->where('ujian.dedline', '>=', $tgl_presensi)
            ->orderBy('ujian.dedline', 'desc')
            ->select('ujian.*', 'hasilujian.uploaded', 'hasilujian.nilai')
            ->get();

        $warna = DB::table('ujian')->get();
        if ($warna > $hariSekarang) {
            $bg = "text-primary";
        } else if ($warna = $hariSekarang) {
            $bg = "text-warning";
        }

        return view('siswa.ujianterkirim', compact('ujian', 'hari', 'tgl', 'bg'));
    }


    public function ujianterlambat()
    {
        $hariIni = Carbon::now();
        $id_user = Auth::user()->id;
        $tgl = $hariIni->format('d-m-Y');
        $jurusan = Auth::user()->jurusan;
        $kelas = Auth::user()->kelas;
        $hari = $hariIni->formatLocalized('%A');
        setlocale(LC_TIME, 'id_ID'); // Set locale ke Bahasa Indonesia
        $hariSekarang = strftime('%A');
        //dd($hariSe$karang);
        $tgl_presensi = date("Y-m-d");

        $ujian = DB::table('ujian')
            ->leftJoin('hasilujian', function ($join) use ($id_user) {
                $join->on('ujian.id', '=', 'hasilujian.id_ujian')
                    ->where('hasilujian.id_siswa', $id_user);
            })
            ->where('ujian.jurusan', $jurusan)
            ->where('ujian.kelas', $kelas)
            ->where('ujian.dedline', '<', $tgl_presensi)
            ->WhereNull('hasilujian.id_siswa')
            ->orderBy('ujian.dedline', 'asc')
            ->select('ujian.*', 'hasilujian.uploaded', 'hasilujian.nilai')
            ->get();

        $warna = DB::table('ujian')->get();
        if ($warna > $hariSekarang) {
            $bg = "text-primary";
        } else if ($warna = $hariSekarang) {
            $bg = "text-warning";
        }

        return view('siswa.ujianterlambat', compact('ujian', 'hari', 'tgl', 'bg'));
    }

    public function addujian($id)
    {
        $ujian = Ujian::find($id);
        return view('siswa.upload_ujian', compact('ujian'));
    }

    public function unggahujian(Request $request)
    {
        // Ambil data dari request
        $id_siswa = Auth::user()->id;
        $nama = Auth::user()->name;
        $id_ujian = $request->id_ujian;
        $jenis = $request->jenis;
        $dedline = $request->dedline;

        // Jika ada file yang diunggah, simpan ke direktori
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/hasil';
            $file->move($tujuanFile, $namafile);
        } else {
            // Jika tidak ada file yang diunggah, gunakan file hasil ujian sebelumnya
            $namafile = DB::table('hasilujian')
                ->where('id_ujian', $id_ujian)
                ->where('id_siswa', $id_siswa)
                ->value('file_hasil_ujian');
        }

        // Data yang akan diubah atau ditambahkan
        $data = [
            'nama_pengumpul' => $nama,
            'jenis_ujian' => $jenis,
            'file_hasil_ujian' => $namafile,
            'dedline' => $dedline,
            'uploaded' => 1,
            'created_at' => Carbon::now(),
        ];

        // Cek apakah data sudah ada di database, jika sudah, maka lakukan update, jika belum, lakukan insert
        DB::table('hasilujian')->updateOrInsert(
            ['id_ujian' => $id_ujian, 'id_siswa' => $id_siswa],
            $data
        );

        return redirect('/ujian-siswa')->with(['success' => 'Ujian Terkirim']);
    }


    public function hasilujian($id)
    {

        $id_user = Auth::user()->id;

        $item = DB::table('ujian')
            ->leftJoin('hasilujian', function ($join) use ($id_user) {
                $join->on('ujian.id', '=', 'hasilujian.id_ujian')
                    ->where('hasilujian.id_siswa', $id_user);
            })
            ->where('ujian.id', $id)
            ->select('ujian.dedline', 'hasilujian.file_hasil_ujian', 'hasilujian.created_at', 'hasilujian.id_ujian', 'hasilujian.nilai')
            ->first();

        return view('siswa.finish_ujian', compact('item'));
    }
}
