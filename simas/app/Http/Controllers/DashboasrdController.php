<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\Pelajaran;
use App\Models\KeahlianGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class DashboasrdController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now()->toDateString();
        $twoDaysAgo = Carbon::now()->addDays(2)->toDateString();

        $pengumuman = DB::table('pengumuman')
            ->where('created_at', '>=', $currentDate)
            ->where('created_at', '<=', $twoDaysAgo)
            ->orderBy('created_at', 'desc')
            ->get();

        $siswa = Siswa::count();
        $guruman = DB::table('guru')
            ->where('jenis_kelamin', "laki-laki")
            ->count();
        $guruwoman = DB::table('guru')
            ->where('jenis_kelamin', "perempuan")
            ->count();
        $man = DB::table('siswa')
            ->where('jenis_kelamin', "laki-laki")
            ->count();
        $woman = DB::table('siswa')
            ->where('jenis_kelamin', "perempuan")
            ->count();
        $suratgurumenunggu = DB::table('surat_izins')
            ->where('role', "guru")
            ->where('status', "0")
            ->count();
        $suratguruapprove = DB::table('surat_izins')
            ->where('role', "guru")
            ->where('status', "1")
            ->count();
        $suratgurutolak = DB::table('surat_izins')
            ->where('role', "guru")
            ->where('status', "2")
            ->count();
        $suratsiswamenunggu = DB::table('surat_izins')
            ->where('role', "siswa")
            ->where('status', "0")
            ->count();
        $suratsiswaapprove = DB::table('surat_izins')
            ->where('role', "siswa")
            ->where('status', "1")
            ->count();
        $suratsiswatolak = DB::table('surat_izins')
            ->where('role', "siswa")
            ->where('status', "2")
            ->count();

        // $currentDate = date('Y-m-d');

        // DB::table('presensiguru')
        //     ->whereDate('created_at', '<', $currentDate)
        //     ->delete();

        // DB::table('presensisiswa')
        //     ->whereDate('created_at', '<', $currentDate)
        //     ->delete();

        // Get the current date

        $absenguruterlambat = DB::table('presensiguru')
            ->where('tgl_presensi', $currentDate)
            ->where('jam_masuk', '>', '08:00:00')
            ->count();
        $absengurutepat = DB::table('presensiguru')
            ->where('tgl_presensi', $currentDate)
            ->where('jam_masuk', '<=', '08:00:00')
            ->count();
        $absengurubelum = DB::table('guru')
            ->leftJoin('presensiguru', 'guru.id', '=', 'presensiguru.id_guru')
            ->whereNull('presensiguru.id_guru')
            ->count();
        $absensiswaterlambat = DB::table('presensisiswa')
            ->where('tgl_presensi', $currentDate)
            ->where('jam_masuk', '>', '08:00:00')
            ->count();
        $absensiswatepat = DB::table('presensisiswa')
            ->where('tgl_presensi', $currentDate)
            ->where('jam_masuk', '<=', '08:00:00')
            ->count();
        $absensiswabelum = DB::table('siswa')
            ->leftJoin('presensisiswa', 'siswa.id', '=', 'presensisiswa.id_siswa')
            ->whereNull('presensisiswa.id_siswa')
            ->count();
        $guru = Guru::count();
        $gender = [
            'Laki-laki' => intval($man),
            'Perempuan' => intval($woman)
        ];
        $genderguru = [
            'Laki-laki' => intval($guruman),
            'Perempuan' => intval($guruwoman)
        ];
        $suratizinguru = [
            'menunggu' => intval($suratgurumenunggu),
            'approve' => intval($suratguruapprove),
            'tolak' => intval($suratgurutolak)
        ];
        $suratizinsiswa = [
            'menunggu' => intval($suratsiswamenunggu),
            'approve' => intval($suratsiswaapprove),
            'tolak' => intval($suratsiswatolak)
        ];
        $absenguru = [
            'terlambat' => intval($absenguruterlambat),
            'tepat' => intval($absengurutepat),
            'belum' => intval($absengurubelum)
        ];
        $absensiswa = [
            'terlambat' => intval($absenguruterlambat),
            'tepat' => intval($absengurutepat),
            'belum' => intval($absensiswabelum)
        ];
        // dd($twoDaysAgo);
        return view('admin.index', compact('pengumuman', 'siswa', 'guru', 'man', 'woman', 'gender', 'genderguru', 'suratizinguru', 'suratizinsiswa', 'absenguru', 'absensiswa'));
    }

    public function guru()
    {

        // $guru =  DB::table('guru')->where('status', "aktif")->get();
        $guruAktif =  DB::table('guru')->where('status', "aktif")->get();
        $guruTidakAktif =  DB::table('guru')->where('status', "non-aktif")->get();

        return view('admin.guru.index', compact('guruAktif', 'guruTidakAktif'));
    }
    public function updateStatus($id)
    {
        Guru::where('id', $id)->update(['status' => "non-aktif"]);
        return redirect('/guru')->with(['success', "Guru Berhasil Di Nonaktifka!!"]);
    }
    public function updateAktifStatus($id)
    {
        Guru::where('id', $id)->update(['status' => "aktif"]);
        return redirect('/guru')->with(['success', "Guru Berhasil Di Aktifkan Kembali!!"]);
    }

    public function addguru(Request $request)
    {
        $nama = $request->nama;
        $npdn = $request->npdn;
        $kode_guru = $request->kode_guru;
        $alamat = $request->alamat;
        $tempat = $request->tempat_lahir;
        $email = $request->email;
        $tanggal = $request->tanggal_lahir;
        $no_hp = $request->no_hp;
        $jenis_kelamin = $request->jenis_kelamin;
        $file = $request->file('profil');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/guru';
        $file->move($tujuanFile, $namafile);

        $extensi = "@guru.com";
        $j = "Null";
        $k = "Null";
        $buatUsername = $kode_guru . $extensi;
        $role = "guru";

        $exgmail = DB::table('users')->where('email', $email)->first();
        $exnpdn = DB::table('guru')->where('npdn', $npdn)->first();

        if ($exnpdn) {
            return redirect()->back()->withInput($request->input())->with(['exemail' => 'NPDN sudah digunakan.']);
        } elseif ($exgmail) {
            return redirect()->back()->withInput($request->input())->with(['exemail' => 'Email sudah digunakan.']);
        }

        $tambahuser = User::create([
            'name' => $request->input('nama'),
            'jurusan' => $j,
            'kelas' => $k,
            'id_user' => $npdn,
            'email' => $email,
            'password' => Hash::make($request->input('no_hp')),
            'role' => $role
        ]);

        if ($exgmail && $exnpdn) {
            return redirect()->back()->withInput($request->input())->with(['exemail' => 'Email atau NPDN sudah digunakan.']);
        }
        $data = [
            'nama' => $nama,
            'npdn' => $npdn,
            'kode_guru' => $kode_guru,
            'alamat' => $alamat,
            'email' => $email,
            'no_hp' => $no_hp,
            'jenis_kelamin' => $jenis_kelamin,
            'tempat_lahir' => $tempat,
            'tanggal_lahir' => $tanggal,
            'profil' => $namafile
        ];
        $simpan = DB::table('guru')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal tambah']);
        }
    }





    public function siswa()
    {
        $siswa = DB::table('siswa')
            ->join('guru', 'siswa.id_guru', '=', 'guru.id')
            ->select('siswa.*', 'guru.nama as nama_guru')
            ->get();
        $guru = DB::table('guru')->get();
        return view('admin.siswa.index', compact('siswa', 'guru'));
    }
    public function addsiswa(Request $request)
    {
        $nama = $request->nama;
        $nisn = $request->nisn;
        $jenis_kelamin = $request->jenis_kelamin;
        $jurusan = $request->jurusan;
        $kelas = $request->kelas;
        $wali_kelas = $request->wali_kelas;
        $tempat = $request->tempat_lahir;
        $tanggal = $request->tanggal_lahir;
        $email = $request->email;
        $siswa_hp = $request->no_hp_siswa;
        $wali = $request->nama_ibu_kandung;
        $wali_hp = $request->no_hp_wali;

        $alamat = $request->alamat;
        $file = $request->file('profil');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/profil';
        $file->move($tujuanFile, $namafile);

        $extensi = "@siswa.com";
        $buatUsername = $nisn . $extensi;
        $role = "siswa";

        $exgmail = DB::table('users')->where('email', $email)->first();
        $exnisn = DB::table('siswa')->where('nisn', $nisn)->first();

        if ($exnisn) {
            return redirect()->back()->withInput($request->input())->with(['exesiswa' => 'NPDN sudah digunakan.']);
        } elseif ($exgmail) {
            return redirect()->back()->withInput($request->input())->with(['exesiswa' => 'Email sudah digunakan.']);
        }

        $pengguna = User::create([
            'name' => $request->input('nama'),
            'id_user' => $nisn,
            'jurusan' => $jurusan,
            'kelas' => $kelas,
            'email' => $email,
            'password' => Hash::make($request->input('nisn')),
            'role' => $role,
        ]);
        if ($exgmail && $exnisn) {
            return redirect()->back()->withInput($request->input())->with(['exesiswa' => 'Email atau NISN sudah digunakan.']);
        }
        $data = [
            'nama' => $nama,
            'nisn' => $nisn,
            'id_guru' => $wali_kelas,
            'jenis_kelamin' => $jenis_kelamin,
            'jurusan' => $jurusan,
            'kelas' => $kelas,
            'alamat' => $alamat,
            'email' => $email,
            'tempat_lahir' => $tempat,
            'tanggal_lahir' => $tanggal,
            'no_hp_siswa' => $siswa_hp,
            'no_hp_wali' => $wali_hp,
            'nama_ibu_kandung' => $wali,
            'profil' => $namafile
        ];

        $simpan = DB::table('siswa')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal tambah']);
        }
    }

    public function akademik()
    {
        $akademik = DB::table('akademik')->get();
        return view('admin.akademik.index', compact('akademik'));
    }

    public function addakademik(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $tahun = $request->tahun;
        $nama = $request->nama;

        // Check if the data already exists and appears twice in the database
        $countData = DB::table('akademik')
            ->where('tahun', $tahun)
            ->where('nama', $nama)
            ->count();

        if ($countData >= 1) {
            return Redirect::back()->with(['error' => 'Data sudah ada dan mencapai batas maksimal (1 kali)']);
        }

        $data = [
            'tahun' => $tahun,
            'nama' => $nama
        ];

        $simpan = DB::table('akademik')->insert($data);

        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal tambah']);
        }
    }


    public function mapel()
    {
        $akademik = DB::table('akademik')->get();

        $guru = DB::table('guru')->where('status', 'aktif')->get();

        $mapel = DB::table('matapelajran')->get();
        return view('admin.pelajaran.matapelajaran', compact('akademik', 'guru', 'mapel'));
    }

    public function addmapel(Request $request)
    {

        $nama_pelajaran = $request->nama_pelajaran;
        $kode_guru = $request->kode_guru;
        // $nama = $request->nama;
        $jurusan = $request->jurusan;
        $kelas = $request->kelas;

        $data = [
            'nama_pelajaran' => $nama_pelajaran,
            'kode_guru' => $kode_guru,
            // 'nama' => $nama,
            'jurusan' => $jurusan,
            'kelas' => $kelas
        ];

        $simpan = DB::table('matapelajran')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal tambah']);
        }
    }

    public function kelasipax()
    {
        $guru = DB::table('guru')->get();
        $room = DB::table('ruangan')->get();
        $mapel = DB::table('matapelajran')
            ->join('guru', 'matapelajran.kode_guru', '=', 'guru.kode_guru')
            ->where('guru.status', 'aktif')
            ->where('kelas', 10)
            ->where('jurusan', 'IPA')
            ->get();

        $jadwal = DB::table('jadwal')
            ->join('ruangan', 'jadwal.ruangan', '=', 'ruangan.id')
            ->join('guru', 'jadwal.kode_guru', '=', 'guru.kode_guru')
            ->select('jadwal.*', 'ruangan.nama_ruangan', 'guru.nama')
            ->where('kelas', 10)
            ->where('jurusan', "IPA")
            ->get();
        // dd($jadwal);
        return view('admin.pelajaran.ipa.kelas10', compact('mapel', 'guru', 'jadwal', 'room'));
    }

    public function kelasipaxi()
    {
        $room = DB::table('ruangan')->get();
        $guru = DB::table('guru')->get();
        $mapel = DB::table('matapelajran')
            ->join('guru', 'matapelajran.kode_guru', '=', 'guru.kode_guru')
            ->where('guru.status', 'aktif')
            ->where('kelas', 11)
            ->where('jurusan', "IPA")
            ->get();

        $jadwal = DB::table('jadwal')
            ->join('ruangan', 'jadwal.ruangan', '=', 'ruangan.id')
            ->join('guru', 'jadwal.kode_guru', '=', 'guru.kode_guru')
            ->select('jadwal.*', 'ruangan.nama_ruangan', 'guru.nama')
            ->where('kelas', 11)
            ->where('jurusan', "IPA")
            ->get();

        return view('admin.pelajaran.ipa.kelas11', compact('guru', 'mapel', 'jadwal', 'room'));
    }

    public function kelasipaxii()
    {
        $room = DB::table('ruangan')->get();
        $guru = DB::table('guru')->get();
        $mapel = DB::table('matapelajran')
            ->join('guru', 'matapelajran.kode_guru', '=', 'guru.kode_guru')
            ->where('guru.status', 'aktif')
            ->where('kelas', 12)
            ->where('jurusan', "IPA")
            ->get();
        $jadwal = DB::table('jadwal')
            ->join('ruangan', 'jadwal.ruangan', '=', 'ruangan.id')
            ->join('guru', 'jadwal.kode_guru', '=', 'guru.kode_guru')
            ->select('jadwal.*', 'ruangan.nama_ruangan', 'guru.nama')
            ->where('kelas', 12)
            ->where('jurusan', "IPA")
            ->get();
        return view('admin.pelajaran.ipa.kelas12', compact('guru', 'mapel', 'jadwal', 'room'));
    }

    public function kelasipsx()
    {
        $room = DB::table('ruangan')->get();
        $guru = DB::table('guru')->get();
        $mapel = DB::table('matapelajran')
            ->join('guru', 'matapelajran.kode_guru', '=', 'guru.kode_guru')
            ->where('guru.status', 'aktif')
            ->where('kelas', 10)
            ->where('jurusan', "IPS")
            ->get();
        $jadwal = DB::table('jadwal')
            ->join('ruangan', 'jadwal.ruangan', '=', 'ruangan.id')
            ->join('guru', 'jadwal.kode_guru', '=', 'guru.kode_guru')
            ->select('jadwal.*', 'ruangan.nama_ruangan', 'guru.nama')
            ->where('kelas', 10)
            ->where('jurusan', "IPS")
            ->get();
        return view('admin.pelajaran.ips.kelas10', compact('guru', 'mapel', 'jadwal', 'room'));
    }

    public function kelasipsxi()
    {
        $room = DB::table('ruangan')->get();
        $guru = DB::table('guru')->get();
        $mapel = DB::table('matapelajran')
            ->join('guru', 'matapelajran.kode_guru', '=', 'guru.kode_guru')
            ->where('guru.status', 'aktif')
            ->where('kelas', 11)
            ->where('jurusan', "IPS")
            ->get();
        $jadwal = DB::table('jadwal')
            ->join('ruangan', 'jadwal.ruangan', '=', 'ruangan.id')
            ->join('guru', 'jadwal.kode_guru', '=', 'guru.kode_guru')
            ->select('jadwal.*', 'ruangan.nama_ruangan', 'guru.nama')
            ->where('kelas', 11)
            ->where('jurusan', "IPS")
            ->get();
        return view('admin.pelajaran.ips.kelas11', compact('guru', 'mapel', 'jadwal', 'room'));
    }

    public function kelasipsxii()
    {
        $room = DB::table('ruangan')->get();
        $guru = DB::table('guru')->get();
        $mapel = DB::table('matapelajran')
            ->join('guru', 'matapelajran.kode_guru', '=', 'guru.kode_guru')
            ->where('guru.status', 'aktif')
            ->where('kelas', 12)
            ->where('jurusan', "IPS")
            ->get();
        $jadwal = DB::table('jadwal')
            ->join('ruangan', 'jadwal.ruangan', '=', 'ruangan.id')
            ->join('guru', 'jadwal.kode_guru', '=', 'guru.kode_guru')
            ->select('jadwal.*', 'ruangan.nama_ruangan', 'guru.nama')
            ->where('kelas', 12)
            ->where('jurusan', "IPS")
            ->get();
        return view('admin.pelajaran.ips.kelas12', compact('guru', 'mapel', 'jadwal', 'room'));
    }

    public function addjadwal(Request $request)
    {
        $hari = $request->hari;
        $nama_pelajaran = $request->nama_pelajaran;
        $jam_masuk = $request->jam_masuk;
        $jam_selesai = $request->jam_selesai;
        $kode_guru = $request->kode_guru; // Ambil kode guru dari request
        $ruangan = $request->ruangan;
        $jurusan = $request->jurusan;
        $kelas = $request->kelas;

        $data = [
            'hari' => $hari,
            'nama_pelajaran' => $nama_pelajaran,
            'jam_masuk' => $jam_masuk,
            'jam_selesai' => $jam_selesai,
            'ruangan' => $ruangan,
            'kode_guru' => $kode_guru, // Gunakan kode guru yang diambil dari request
            'jurusan' => $jurusan,
            'kelas' => $kelas
        ];

        $simpan = DB::table('jadwal')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal tambah']);
        }
    }


    public function room()
    {

        $ruangan = DB::table('ruangan')->get();
        return view('admin.ruangan.index', compact('ruangan'));
    }
    public function adroom(Request $request)
    {
        $nama_ruangan = $request->nama_ruangan;
        $kode_ruangan = $request->kode_ruangan;
        $status = $request->status;
        $keterangan = $request->keterangan;

        if (empty($keterangan)) {
            $keterangan = '-';
        }

        $ruanganExists = DB::table('ruangan')
            ->where('nama_ruangan', $nama_ruangan)
            ->orWhere('kode_ruangan', $kode_ruangan)
            ->exists();

        if ($ruanganExists) {
            return Redirect::back()->with(['error' => 'Nama atau kode ruangan sudah ada']);
        }

        $data = [
            'nama_ruangan' => $nama_ruangan,
            'kode_ruangan' => $kode_ruangan,
            'status' => $status,
            'keterangan' => $keterangan
        ];
        $simpan = DB::table('ruangan')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal tambah']);
        }
    }

    public function deleter($id)
    {
        $delete = DB::table('ruangan')->where('id', $id)->delete();
        if ($delete) {
            return redirect('/ruangan')->with(['success' => "Ruangan Berhasil Di Hapus!"]);
        } else {
            return redirect('/ruangan')->with(['error' => "Gagal Di Hapus!"]);
        }
    }

    public function editr($id)
    {
        $ruangan = Ruangan::find($id);

        return view('admin.ruangan.edit', compact('ruangan'));
    }

    public function editpros(Request $request, $id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->update($request->all());

        return redirect('/ruangan')->with(['success' => "Ruangan Berhasil Di Update!"]);
    }

    public function deletea($id)
    {
        $delete = DB::table('akademik')->where('id', $id)->delete();

        if ($delete) {
            return redirect('/tahun-akademik')->with(['success' => "Tahun Akademik Berhasil Dihapus"]);
        } else {
            return redirect('/tahun-akademik')->with(['error' => "Tahun Akademik Gagal Dihapus"]);
        }
    }

    public function editg($id)
    {
        $guru = Guru::find($id);
        return view('admin.guru.edit', compact('guru'));
    }


    public function editprosg(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'npdn' => 'required',
            'kode_guru' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'jenis_kelamin' => 'required',
            'profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $guru = Guru::find($id);

        $existingnpdn = DB::table('guru')->where('npdn', $request->npdn)->where('id', '!=', $id)->first();

        if ($existingnpdn) {
            return redirect()->back()->withInput($request->input())->with(['existingnpdn' => 'NPDN sudah digunakan. Silakan coba dengan NPDN yang berbeda.']);
        }

        $guru->update($request->all());

        $namafile = $guru->profil;

        $guru->nama = $request->nama;
        $guru->npdn = $request->npdn;
        $guru->kode_guru = $request->kode_guru;
        $guru->alamat = $request->alamat;
        $guru->no_hp = $request->no_hp;
        $guru->jenis_kelamin = $request->jenis_kelamin;

        if ($request->hasFile('profil')) {
            $file = $request->file('profil');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/guru';
            $file->move($tujuanFile, $namafile);
        }

        $guru->profil = $namafile;

        $guru->save();

        if ($guru) {
            return redirect('/guru')->with(['success' => "Data Guru Berhasil Di Update!"]);
        } else {
            return redirect('/guru')->with(['error' => "Data Gagal Di Update"]);
        }
    }


    public function deleteg($id)
    {
        $delete = DB::table('guru')->where('id', $id)->delete();

        if ($delete) {
            return redirect('/guru')->with(['success' => "Data Guru Berhasil Di Hapus!"]);
        } else {
            return redirect('/guru')->with(['error' => "Data Guru Gagal Di Hapus!"]);
        }
    }

    public function deletes($id)
    {
        $delete = DB::table('siswa')->where('id', $id)->delete();

        if ($delete) {
            return redirect('/siswa')->with(['success' => "Data Siwa Berhasil Di Hapus"]);
        } else {
            return redirect('/siswa')->with(['success' => "Data Siwa Gagal Di Hapus"]);
        }
    }

    public function edits($id)
    {
        $siswa = Siswa::find($id);

        return view('admin.siswa.edit', compact('siswa'));
    }

    public function editpross(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nisn' => 'required',
            'jenis_kelamin' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
        ]);

        $siswa = Siswa::find($id);

        $existingnisn = DB::table('siswa')->where('nisn', $request->nisn)->where('id', '!=', $id)->first();

        if ($existingnisn) {
            return redirect()->back()->withInput($request->input())->with(['existingnisn' => 'NISN sudah digunakan. Silakan coba dengan NISN yang berbeda.']);
        }

        $siswa->update($request->all());

        $namafile = $siswa->profil;

        $siswa->nama = $request->nama;
        $siswa->nisn = $request->nisn;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->jurusan = $request->jurusan;
        $siswa->kelas = $request->kelas;

        if ($request->hasFile('profil')) {
            $file = $request->file('profil');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/profil';
            $file->move($tujuanFile, $namafile);
        }

        $siswa->profil = $namafile;

        $siswa->save();

        if ($siswa) {
            return redirect('/siswa')->with(['success' => "Data Siswa Berhasil Di Update!"]);
        } else {
            return redirect('/siswa')->with(['error' => "Data Gagal Di Update"]);
        }
    }

    public function deletep($id)
    {
        $delete = DB::table('matapelajran')->where('id', $id)->delete();

        if ($delete) {
            return redirect('/mata-pelajaran')->with(['success' => "Data Berhasil Di Hapus"]);
        } else {
            return redirect('/mata-pelajaran')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }

    public function editp($id)
    {
        $akademik = DB::table('akademik')->get();
        $guru = DB::table('guru')->get();
        $pelajaran = Pelajaran::find($id);

        return view('admin.pelajaran.edit', compact('pelajaran', 'akademik', 'guru'));
    }

    public function editprosp(Request $request, $id)
    {
        $pelajaran = Pelajaran::find($id);
        $pelajaran->update($request->all());

        return redirect('/mata-pelajaran')->with(['success' => "Matapelajaran Berhasil Di Update"]);
    }

    public function editj($id)
    {
        session(['previous_url' => url()->previous()]);
        $siswa = Jadwal::find($id);
        $room = DB::table('ruangan')->get();
        $mapel = DB::table('matapelajran')
            ->join('guru', 'matapelajran.kode_guru', '=', 'guru.kode_guru')
            ->where('guru.status', 'aktif')
            ->get();

        $jadwal = DB::table('jadwal')
            ->join('ruangan', 'jadwal.ruangan', '=', 'ruangan.id')
            ->join('guru', 'jadwal.kode_guru', '=', 'guru.kode_guru')
            ->select('jadwal.*', 'ruangan.nama_ruangan', 'guru.nama')
            ->get();
        // dd($siswa);
        return view('admin.jadwal.edit', compact('siswa', 'mapel', 'jadwal', 'room'));
    }

    public function editprosj(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required',
            'nama_pelajaran' => 'required',
            'ruangan' => 'required',
            'jam_masuk' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal = Jadwal::find($id);

        if (!$jadwal) {
            return redirect()->back()->with(['error' => "Data tidak ditemukan"]);
        }

        $jadwal->hari = $request->hari;
        $jadwal->nama_pelajaran = $request->nama_pelajaran;
        $jadwal->ruangan = $request->ruangan;
        $jadwal->jam_masuk = $request->jam_masuk;
        $jadwal->jam_selesai = $request->jam_selesai;

        $jadwal->save();

        if ($jadwal) {
            return redirect()->to(session('previous_url'))->with(['success' => "Data Jadwal Jurusan Berhasil Di Update!"]);
        } else {
            return redirect()->to(session('previous_url'))->with(['error' => "Data Gagal Di Update"]);
        }
    }

    public function deletej($id)
    {
        $delete = DB::table('jadwal')->where('id', $id)->delete();

        if ($delete) {
            return Redirect::back()->with(['success' => 'Data berhasil dihapus']);
        }
    }

    public function indext()
    {
        $mapel = DB::table('matapelajran')->get();
        $tugas = DB::table('tugas')->get();
        return view('admin.tugas.index', compact('mapel', 'tugas'));
    }
    public function addtugas(Request $request)
    {

        $mapel = $request->nama_pelajaran;
        $judul = $request->judul;
        $dedline = $request->dedline;
        $jurusan = $request->jurusan;
        $kelas = $request->kelas;
        $catatan = $request->catatan;

        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/tugas';
        $file->move($tujuanFile, $namafile);

        $data = [
            'nama_pelajaran' => $mapel,
            'judul' => $judul,
            'dedline' => $dedline,
            'jurusan' => $jurusan,
            'kelas' => $kelas,
            'catatan' => $catatan,
            'file' => $namafile
        ];

        $simpan = DB::table('tugas')->insert($data);

        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data berhasil Tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal di proses']);
        }
    }
    public function deletet($id)
    {
        $delete = DB::table('tugas')->where('id', $id)->delete();

        if ($delete) {
            return Redirect::back()->with(['success' => 'Data berhasil di hapus ']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal dihapus']);
        }
    }

    public function ahli()
    {
        $guru = DB::table('users')
            ->join('keahlianguru', 'users.id', '=', 'keahlianguru.id_user')
            ->select('users.name as nama_guru', 'users.id as id', DB::raw('COUNT(keahlianguru.id) as jumlah_keahlian'))
            ->groupBy('users.id', 'users.name')
            ->get();

        return view('admin.guru.keahlian', compact('guru'));
    }

    public function detailahli($id)
    {
        $guru = User::find($id);

        $kode = DB::table('guru')
            ->join('users', 'guru.npdn', '=', 'users.id_user')
            ->select('guru.id')
            ->where('users.id', '=', $id)
            ->first();

        if ($kode) {
            $pj = DB::table('jadwal')
                ->select('nama_pelajaran', DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(jam_selesai, jam_masuk)) / 3600) AS jumlah_jam_masuk'))
                ->where('kode_guru', $kode->id)
                ->groupBy('nama_pelajaran')
                ->get();

            return view('admin.guru.detail', compact('guru', 'pj'));
        } else {
            "oke";
        }
    }



    public function pengumumanadd(Request $request)
    {
        $judul = $request->judul;
        $info = $request->info;

        $file = $request->file('file');

        if ($file) {
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/pengumuman';
            $file->move($tujuanFile, $namafile);
        } else {
            // Jika file kosong, atur nilai default
            $namafile = '-';
        }

        $data = [
            'judul' => $judul,
            'info' => $info,
            'file' => $namafile,
            'created_at' => now()
        ];

        $simpan = DB::table('pengumuman')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Pengumuman berhasil ditambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal diproses']);
        }
    }


    public function delete($id_pengumuman)
    {
        $delete = DB::table('pengumuman')->where('id_pengumuman', $id_pengumuman)->delete();
        if ($delete) {
            return redirect('/dashboard')->with(['success' => "Postingan Berhasil Di Hapus!"]);
        } else {
            return redirect('/dashboard')->with(['error' => "Gagal Di Hapus!"]);
        }
    }

    //siswa
    public function pmb()
    {
        return view('admin.siswabaru.index');
    }
}
