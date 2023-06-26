<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Hasil;
use App\Models\Tugas;
use App\Models\Jadwal;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Surat;
use App\Models\Ujian;

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
        //dd($hariSekarang);
        $tgl_presensi = date("Y-m-d");

        $cek = DB::table('presensisiswa')->where('tgl_presensi', $tgl_presensi)->where('nisn', $id_user)->count();
        if ($cek > 0) {
            $status = "Hadir";
        } else {
            $status = "Tidak Hadir";
        }

        // $jadwal = Jadwal::where('hari', $hariSekarang)->get();
        $jadwal = DB::table('jadwal')
            ->join('guru', 'jadwal.kode_guru', '=', 'guru.id')
            ->join('ruangan','jadwal.ruangan','=','ruangan.id')
            ->where('jurusan', $jurusan)
            ->where('kelas', $kelas)
            ->where('hari', $hariSekarang)
            ->select('jadwal.*', 'guru.nama as nama_guru','ruangan.nama_ruangan')
            ->orderBy('jadwal.jam_masuk', 'asc')
            ->get();


        $pengumuman = DB::table('pengumuman')->orderBy('created_at', 'desc')->get();
        $prestasi = DB::table('prestasi')->where('id_user', $id)->count();

        $mapel = DB::table('jadwal')
            ->where('jurusan', $jurusan)->where('kelas', $kelas)->distinct('jadwal.nama_pelajaran')->count();

        $jmlhsiswa = DB::table('siswa')->where('jurusan', $jurusan)->where('kelas', $kelas)->count();

        $nisn = Auth::user()->id_user;
        $namaWali = DB::table('siswa')->join('guru', 'siswa.id_guru', '=', 'guru.id')->select('guru.nama as nama_guru')
        ->where('nisn',$nisn)
        ->get();

        return view('siswa.index', compact('jadwal', 'hari', 'tgl', 'status', 'pengumuman', 'prestasi', 'mapel', 'jmlhsiswa', 'namaWali'));
    }

    public function surat()
    {
        $surat = DB::table('surat_izins')->where('id_user', Auth::user()->id)->get();
        $nama = Auth::user()->name;
        // dd($nama);
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
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);
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
            return redirect('/surat')->with(['success' => "Data Siswa Berhasil Di Update!"]);
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
        //dd($hariSe$karang);
        $tgl_presensi = date("Y-m-d");

        $tugas = DB::table('tugas')
            ->leftJoin('hasiltugas', function ($join) use ($id_user) {
                $join->on('tugas.id_tugas', '=', 'hasiltugas.id_tugas')
                    ->where('hasiltugas.id_user', $id_user)
                    ->orWhereNull('hasiltugas.id_user');
            })
            ->where('tugas.jurusan', $jurusan)
            ->where('tugas.kelas', $kelas)
            ->where('tugas.dedline', '>=', $hariSekarang)
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
            $latitudekantor = 2.379135;
            $longitudekantor = 99.151415;
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
                    $data = [
                        'id_siswa' => $id,
                        'nisn' => $id_user,
                        'tgl_presensi' => $tgl_presensi,
                        'jam_masuk' => $jam,
                        'jam_keluar' => Null,
                        'gambar' => "nul",
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
            return Redirect::back()->with(['success' => 'Data berhasil Tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal di proses']);
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
        //d($request->all());
        $id_user = Auth::user()->id;
        $nama = Auth::user()->name;
        $id_tugas = $request->id_tugas;
        $mapel = $request->nama_pelajaran;
        $dedline = $request->dedline;

        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/hasil';
        $file->move($tujuanFile, $namafile);

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
            return redirect('/tugas-siswa')->with(['success' => 'Data berhasil Tambah']);
        } else {
            return redirect('/tugas-siswa')->with(['error' => 'Data gagal di proses']);
        }
    }

    public function hasil($id_tugas)
    {

        $id_user = Auth::user()->id;

        $item = DB::table('hasiltugas')
            ->join('tugas', 'tugas.id_tugas', '=', 'hasiltugas.id_tugas')
            ->where('hasiltugas.id_user', $id_user)
            ->select('tugas.dedline', 'hasiltugas.file_hasil_tugas', 'hasiltugas.created_at')
            ->first();

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
        //dd($hariSe$karang);
        $tgl_presensi = date("Y-m-d");

        $ujian = DB::table('ujian')
            ->leftJoin('hasilujian', function ($join) use ($id_user) {
                $join->on('ujian.id', '=', 'hasilujian.id_ujian')
                    ->where('hasilujian.id_siswa', $id_user)
                    ->orWhereNull('hasilujian.id_siswa');
            })
            ->where('ujian.jurusan', $jurusan)
            ->where('ujian.kelas', $kelas)
            ->where('ujian.dedline', '>=', $hariSekarang)
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

    public function addujian($id)
    {
        $ujian = Ujian::find($id);
        return view('siswa.upload_ujian', compact('ujian'));
    }

    public function unggahujian(Request $request)
    {
        //d($request->all());
        $id_siswa = Auth::user()->id;
        $nama = Auth::user()->name;
        $id_ujian = $request->id_ujian;
        $jenis = $request->jenis;
        $dedline = $request->dedline;

        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/hasil';
        $file->move($tujuanFile, $namafile);

        $data = [
            'id_ujian' => $id_ujian,
            'id_siswa' => $id_siswa,
            'nama_pengumpul' => $nama,
            'jenis_ujian' => $jenis,
            'file_hasil_ujian' => $namafile,
            'dedline' => $dedline,
            'uploaded' => 1,
            'created_at' => Carbon::now(),
        ];

        $simpan = DB::table('hasilujian')->insert($data);
        if ($simpan) {
            return redirect('/ujian-siswa')->with(['success' => 'Data berhasil Tambah']);
        } else {
            return redirect('/ujian-siswa')->with(['error' => 'Data gagal di proses']);
        }
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
            ->select('ujian.dedline', 'hasilujian.file_hasil_ujian', 'hasilujian.created_at')
            ->first();

        return view('siswa.finish_ujian', compact('item'));
    }
}
