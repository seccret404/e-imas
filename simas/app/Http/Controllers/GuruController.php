<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Surat;
use App\Models\Tugas;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GuruController extends Controller
{
    public function index()
    {
        return view('guru.index');
    }

    public function surat()
    {
        $surat = DB::table('surat_izins')->where('id_user', Auth::user()->id)->get();
        $nama = Auth::user()->name;
        // dd($nama);
        return view('guru.surat_izin.index', compact('surat', 'nama'));
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

        return view('guru.surat_izin.edit', compact('surat'));
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
            return redirect('/suratguru')->with(['success' => "Data Siswa Berhasil Di Update!"]);
        } else {
            return redirect('/suratguru')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }

    public function deletesurat($id)
    {
        $delete = DB::table('surat_izins')->where('id', $id)->delete();

        if ($delete) {
            return redirect('/suratguru')->with(['success' => "Data Berhasil Di Hapus"]);
        } else {
            return redirect('/suratguru')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }

    public function indext()
    {
        $mapel = DB::table('matapelajran')->get();
        $tugas = DB::table('tugas')->get();
        return view('guru.tugas.index', compact('mapel', 'tugas'));
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
        $delete = DB::table('tugas')->where('id_tugas', $id)->delete();

        if ($delete) {
            return Redirect::back()->with(['success' => 'Data berhasil di hapus ']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal dihapus']);
        }
    }

    public function tugassubmitted()
    {
        $tugas = DB::table('tugas')
            ->orderBy('dedline', 'asc')
            ->get();

        return view('guru.tugas.tugasSubmitted', compact('tugas'));
    }

    public function tugasguruall($id_tugas)
    {
        $tugasall = DB::table('hasiltugas')->where('id_tugas', $id_tugas)->get();
        $tugas = DB::table('hasiltugas')->where('id_tugas', $id_tugas)->first();

        return view('guru.tugas.tugas_sub_all', compact('tugasall', 'tugas'));
    }

    public function tugasgurunilaishow($id)
    {
        $nilai = Hasil::find($id);

        return view('guru.tugas.submit_nilai', compact('nilai'));
    }

    public function tugasgurunilai(Request $request, $id)
    {
        $nilai = $request->nilai;
        $tugas_id = $request->id_tugas;

        $nilai = max(0, min(100, $nilai));

        $data = [
            'nilai' => $nilai,
        ];

        $id_tugas = DB::table('hasiltugas')->where('id_tugas', $tugas_id)->value('id_tugas');

        $simpan = DB::table('hasiltugas')
            ->where('id_hasil', $id)
            ->update($data);

        if ($simpan) {
            return redirect()->route('tugasguruall', ['id' => $id_tugas])->with(['success' => 'Data berhasil tambah']);
        } else {
            return redirect()->route('tugasguruall', ['id' => $id_tugas])->with(['error' => 'Data gagal tambah']);
        }
    }

    public function ujian()
    {
        $ujian = DB::table('ujian')->where('id_guru', Auth::user()->id)->get();
        $nama = Auth::user()->name;
        $tahun = DB::table('akademik')->get();
        $mapel = DB::table('matapelajran')->get();
        // dd($nama);
        return view('guru.ujian.index', compact('ujian', 'nama', 'tahun','mapel'));
    }

    public function addujian(Request $request)
    {
        $id_guru = Auth::user()->id;
        $email = Auth::user()->email;
        $jenis = $request->jenis;
        $judul = $request->judul;
        $dedline = $request->dedline;
        $jurusan = $request->jurusan;
        $kelas = $request->kelas;
        $catatan = $request->catatan;
        $tahun = $request->tahun_akademik;
        $mapel = $request->mapel;

        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/ujian';
        $file->move($tujuanFile, $namafile);

        $data = [
            'id_guru' => $id_guru,
            'jenis_ujian' => $jenis,
            'judul' => $judul,
            'dedline' => $dedline,
            'jurusan' => $jurusan,
            'kelas' => $kelas,
            'catatan' => $catatan,
            'file' => $namafile,
            'tahun_akademik' => $tahun,
            'mapel'=>$mapel
        ];

        $simpan = DB::table('ujian')->insert($data);

        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data berhasil Tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal di proses']);
        }
    }

    public function editujian($id)
    {
        $ujian = Ujian::find($id);
        $tahun = DB::table('akademik')->get();

        return view('guru.ujian.edit', compact('ujian', 'tahun'));
    }

    public function editujianpros(Request $request, $id)
    {
        // Validasi inputan jika diperlukan
        $request->validate([
            'judul' => 'required',
            'jenis' => 'required',
            'dedline' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'tahun_akademik' => 'required',
        ]);

        // Ambil data surat berdasarkan ID
        $ujian = Ujian::find($id);

        // Simpan gambar lama
        $namafile = $ujian->file;

        // Update data surat dengan nilai inputan
        $ujian->judul = $request->judul;
        $ujian->jenis_ujian = $request->jenis;
        $ujian->dedline = $request->dedline;
        $ujian->jurusan = $request->jurusan;
        $ujian->kelas = $request->kelas;
        $ujian->tahun_akademik = $request->tahun_akademik;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/ujian';
            $file->move($tujuanFile, $namafile);
        }

        $ujian->file = $namafile;


        // Simpan perubahan
        $ujian->save();

        if ($ujian) {
            return redirect('/ujianguru')->with(['success' => "Data Siswa Berhasil Di Update!"]);
        } else {
            return redirect('/ujianguru')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }

    public function deleteujian($id)
    {
        $delete = DB::table('ujian')->where('id', $id)->delete();

        if ($delete) {
            return Redirect::back()->with(['success' => 'Data berhasil di hapus ']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal dihapus']);
        }
    }

    public function ujiansubmitted()
    {
        $ujian = DB::table('ujian')
            ->orderBy('dedline', 'asc')
            ->get();

        return view('guru.ujian.ujian_submitted', compact('ujian'));
    }

    public function ujianguruall($id_ujian)
    {
        $ujianall = DB::table('hasilujian')->where('id_ujian', $id_ujian)->get();
        $ujian = DB::table('hasilujian')->where('id_ujian', $id_ujian)->first();

        return view('guru.ujian.ujian_sub_all', compact('ujianall', 'ujian'));
    }

    public function ujiangurunilaishow($id)
    {
        $nilai = DB::table('hasilujian')->find($id);

        return view('guru.ujian.submit_nilai', compact('nilai'));
    }

    public function ujiangurunilai(Request $request, $id)
    {
        $nilai = $request->nilai;
        $ujian_id = $request->id_ujian;

        $nilai = max(0, min(100, $nilai));

        $data = [
            'nilai' => $nilai,
        ];

        $id_ujian = DB::table('hasilujian')->where('id_ujian', $ujian_id)->value('id_ujian');

        $simpan = DB::table('hasilujian')
            ->where('id', $id)
            ->update($data);

        if ($simpan) {
            return redirect()->route('ujianguruall', ['id' => $id_ujian])->with(['success' => 'Data berhasil tambah']);
        } else {
            return redirect()->route('ujianguruall', ['id' => $id_ujian])->with(['error' => 'Data gagal tambah']);
        }
    }

    public function absen()
    {
        $status = DB::table('presensiguru')->first();

        return view('guru.guruabsen', compact('status'));
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

            $cek = DB::table('presensiguru')->where('tgl_presensi', $tgl_presensi)->where('npdn', $id_user)->count();
            if ($radius > 1000) {
                return Redirect::back()->with(['warning' => "Anda Berada Diluar Radius Sekolah"]);
            } else {
                if ($cek > 0) {
                    return redirect('/dashboard/guru')->with(['success' => "Telah Melakukan Absen"]);
                } else {
                    $data = [
                        'id_guru' => $id,
                        'npdn' => $id_user,
                        'tgl_presensi' => $tgl_presensi,
                        'jam_masuk' => $jam,
                        'jam_keluar' => Null,
                        'gambar' => "nul",
                        'location_masuk' => $lokasi,
                        'lokasi_keluar' => Null


                    ];

                    $simpan = DB::table('presensiguru')->insert($data);
                    if ($simpan) {
                        return redirect('/detail-absen-guru')->with(['success' => "Absen Selesai Selamat Mengajar"]);
                    } else {
                        return redirect('/detail-absen-guru')->with(['error' => "Absen Gagal"]);
                    }
                }
            }
        }
    }
}
