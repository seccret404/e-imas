<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Hasil;
use App\Models\Surat;
use App\Models\Tugas;
use App\Models\Ujian;
use App\Models\KeahlianGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class GuruController extends Controller
{
    public function index()
    {
        $idUser = Auth::user()->id;
        $hariIni = Carbon::now();
        $tgl = $hariIni->format('d-m-Y');
        $hari = $hariIni->formatLocalized('%A');

        $idGuru = DB::table('users')
            ->join('guru', 'users.id_user', '=', 'guru.npdn')
            ->where('users.id', $idUser)
            ->select('guru.id', 'guru.kode_guru')
            ->first();

        $jadwal = DB::table('jadwal')
            ->join('ruangan', 'jadwal.ruangan', '=', 'ruangan.id')
            ->join('guru', 'jadwal.kode_guru', '=', 'guru.kode_guru')
            ->where('jadwal.kode_guru', $idGuru->id)
            ->where('jadwal.hari', $hari)
            ->orderByRaw("CASE
                                WHEN jadwal.hari = 'Monday' THEN 1
                                WHEN jadwal.hari = 'Tuesday' THEN 2
                                WHEN jadwal.hari = 'Wednesday' THEN 3
                                WHEN jadwal.hari = 'Thursday' THEN 4
                                WHEN jadwal.hari = 'Friday' THEN 5
                                WHEN jadwal.hari = 'Saturday' THEN 6
                                WHEN jadwal.hari = 'Sunday' THEN 7
                                ELSE 8
                          END")
            ->orderBy('jadwal.jam_masuk', 'asc')
            ->get();

        $allJadwal = DB::table('jadwal')
            ->join('ruangan', 'jadwal.ruangan', '=', 'ruangan.id')
            ->join('guru', 'jadwal.kode_guru', '=', 'guru.kode_guru')
            ->where('jadwal.kode_guru', $idGuru->kode_guru)
            ->orderByRaw("CASE
                            WHEN jadwal.hari = 'Monday' THEN 1
                            WHEN jadwal.hari = 'Tuesday' THEN 2
                            WHEN jadwal.hari = 'Wednesday' THEN 3
                            WHEN jadwal.hari = 'Thursday' THEN 4
                            WHEN jadwal.hari = 'Friday' THEN 5
                            WHEN jadwal.hari = 'Saturday' THEN 6
                            WHEN jadwal.hari = 'Sunday' THEN 7
                            ELSE 8
                      END")
            ->orderBy('jadwal.jam_masuk', 'asc')
            ->get();

        $pengumuman = DB::table('pengumuman')->orderBy('created_at', 'desc')->get();

        // dd($allJadwal);
        return view('guru.index', compact('jadwal', 'pengumuman', 'tgl', 'hari', 'allJadwal'));
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
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required|min:5',
            'mulai' => 'required',
            'selesai' => 'required',
        ]);

        $surat = Surat::find($id);

        $namafile = $surat->keterangan_tambahan;

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

        $surat->save();

        if ($surat) {
            return redirect('/suratguru')->with(['success' => "Surat Izin Berhasil Di Update!"]);
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
        $id_guru = Auth::user()->id;
        $mapel = DB::table('matapelajran')
            ->join('guru', 'matapelajran.kode_guru', '=', 'guru.kode_guru')
            ->join('users', 'users.id_user', '=', 'guru.npdn')
            ->where('users.id', $id_guru)
            ->select('matapelajran.nama_pelajaran')
            ->distinct()
            ->get();

        $today = date('Y-m-d');
        $tugas_lama = DB::table('tugas')
            ->where('id_guru', $id_guru)
            ->where('dedline', '<', $today)
            ->orderBy('dedline', 'desc')
            ->get();

        $tugas_baru = DB::table('tugas')
            ->where('id_guru', $id_guru)
            ->where('dedline', '>=', $today)
            ->orderBy('dedline', 'desc')
            ->get();

        return view('guru.tugas.index', compact('mapel', 'tugas_lama', 'tugas_baru'));
    }
    public function addtugas(Request $request)
    {
        $id_guru = Auth::user()->id;
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
            'id_guru' => $id_guru,
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

    public function edittugas($id)
    {
        $id_guru = Auth::user()->id;
        $tugas = Tugas::find($id);
        $tahun = DB::table('akademik')->get();
        $mapel = DB::table('matapelajran')
            ->join('guru', 'matapelajran.kode_guru', '=', 'guru.kode_guru')
            ->join('users', 'users.id_user', '=', 'guru.npdn')
            ->where('users.id', $id_guru)
            ->select('matapelajran.nama_pelajaran')
            ->distinct()
            ->get();

        return view('guru.tugas.edit', compact('tugas', 'tahun', 'mapel'));
    }

    public function edittugaspros(Request $request, $id)
    {
        $request->validate([
            'nama_pelajaran' => 'required',
            'judul' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'dedline' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'catatan' => 'required',
        ]);

        $tugas = Tugas::find($id);

        $namafile = $tugas->file;

        $tugas->nama_pelajaran = $request->nama_pelajaran;
        $tugas->judul = $request->judul;
        $tugas->dedline = $request->dedline;
        $tugas->jurusan = $request->jurusan;
        $tugas->kelas = $request->kelas;
        $tugas->catatan = $request->catatan;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/tugas';
            $file->move($tujuanFile, $namafile);
        }

        $tugas->file = $namafile;

        $tugas->save();

        if ($tugas) {
            return redirect('/tugasguru')->with(['success' => "Data Tugas Berhasil Diupdate!"]);
        } else {
            return redirect('/tugasguru')->with(['error' => "Data Gagal Di Edit"]);
        }
    }

    public function deletet($id)
    {
        $delete = DB::table('tugas')->where('id_tugas', $id)->delete();

        if ($delete) {
            return Redirect::back()->with(['success' => 'Tugas berhasil di hapus ']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal dihapus']);
        }
    }

    public function tugassubmitted()
    {
        $tugas = DB::table('tugas')
            ->orderBy('tugas.dedline', 'desc')
            ->get();

        $tugasIdArray = $tugas->pluck('id_tugas')->toArray();

        $jlhPengumpul = DB::table('tugas')
            ->join('siswa', function ($join) {
                $join->on('tugas.jurusan', '=', 'siswa.jurusan')
                    ->on('tugas.kelas', '=', 'siswa.kelas');
            })
            ->groupBy('tugas.id_tugas')
            ->select('tugas.id_tugas', DB::raw('count(siswa.id) as jumlah_pengumpul'))
            ->get();

        $jlhSudahMengumpul = DB::table('tugas')
            ->leftJoin('hasiltugas', 'tugas.id_tugas', '=', 'hasiltugas.id_tugas')
            ->groupBy('tugas.id_tugas')
            ->select('tugas.id_tugas', DB::raw('count(hasiltugas.id_hasil) as jumlah_sudah_mengumpulkan'))
            ->get();

        $jlhBelumMengumpul = [];
        foreach ($jlhPengumpul as $pengumpul) {
            foreach ($jlhSudahMengumpul as $mengumpulkan) {
                if ($pengumpul->id_tugas == $mengumpulkan->id_tugas) {
                    $jumlahBelumMengumpul = $pengumpul->jumlah_pengumpul - $mengumpulkan->jumlah_sudah_mengumpulkan;
                    $jlhBelumMengumpul[$pengumpul->id_tugas] = $jumlahBelumMengumpul;
                }
            }
        }

        // dd($tugas);
        return view('guru.tugas.tugasSubmitted', compact('tugas', 'jlhPengumpul', 'jlhSudahMengumpul', 'jlhBelumMengumpul'));
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
        $request->validate([
            'nilai' => 'required|numeric|min:1|max:100',
        ], [
            'nilai.min' => 'Nilai harus lebih besar dari atau sama dengan 1.',
            'nilai.max' => 'Nilai harus kurang dari atau sama dengan 100.',
        ]);

        $nilai = $request->nilai;
        $tugas_id = $request->id_tugas;

        $data = [
            'nilai' => $nilai,
        ];

        $id_tugas = DB::table('hasiltugas')->where('id_tugas', $tugas_id)->value('id_tugas');

        $simpan = DB::table('hasiltugas')
            ->where('id_hasil', $id)
            ->update($data);

        if ($simpan) {
            return redirect()->route('tugasguruall', ['id' => $id_tugas])->with(['success' => 'Nilai berhasil ditambahkan']);
        } else {
            return redirect()->route('tugasguruall', ['id' => $id_tugas])->with(['error' => 'Nilai gagal ditambahkan']);
        }
    }

    public function  ujian()
    {
        $ujian = DB::table('ujian')->where('id_guru', Auth::user()->id)->get();
        $nama = Auth::user()->name;
        $id_guru = Auth::user()->id;
        $tahun = DB::table('akademik')->get();
        $mapel = DB::table('matapelajran')
            ->join('guru', 'matapelajran.kode_guru', '=', 'guru.kode_guru')
            ->join('users', 'users.id_user', '=', 'guru.npdn')
            ->where('users.id', $id_guru)
            ->select('matapelajran.*')
            ->distinct()
            ->get();

        $today = date('Y-m-d');
        $ujian_lama = DB::table('ujian')
            ->where('id_guru', $id_guru)
            ->where('dedline', '<', $today)
            ->orderBy('dedline', 'desc')
            ->get();

        $ujian_baru = DB::table('ujian')
            ->where('id_guru', $id_guru)
            ->where('dedline', '>=', $today)
            ->orderBy('dedline', 'desc')
            ->get();

        return view('guru.ujian.index', compact('ujian_lama', 'ujian_baru', 'nama', 'tahun', 'mapel'));
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
            'mapel' => $mapel
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
        $request->validate([
            'judul' => 'required',
            'jenis' => 'required',
            'dedline' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'catatan' => 'required',
            'tahun_akademik' => 'required',
        ]);

        $ujian = Ujian::find($id);

        $namafile = $ujian->file;

        $ujian->judul = $request->judul;
        $ujian->jenis_ujian = $request->jenis;
        $ujian->dedline = $request->dedline;
        $ujian->jurusan = $request->jurusan;
        $ujian->kelas = $request->kelas;
        $ujian->catatan = $request->catatan;
        $ujian->tahun_akademik = $request->tahun_akademik;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/ujian';
            $file->move($tujuanFile, $namafile);
        }

        $ujian->file = $namafile;

        $ujian->save();

        if ($ujian) {
            return redirect('/ujianguru')->with(['success' => "Data Ujian Berhasil Di Update!"]);
        } else {
            return redirect('/ujianguru')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }

    public function deleteujian($id)
    {
        $delete = DB::table('ujian')->where('id', $id)->delete();

        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Ujian berhasil di hapus ']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal dihapus']);
        }
    }

    public function ujiansubmitted()
    {
        $ujian = DB::table('ujian')
            ->orderBy('dedline', 'desc')
            ->get();


        $ujianIdArray = $ujian->pluck('id')->toArray();

        $jlhPengumpul = DB::table('ujian')
            ->join('siswa', function ($join) {
                $join->on('ujian.jurusan', '=', 'siswa.jurusan')
                    ->on('ujian.kelas', '=', 'siswa.kelas');
            })
            ->groupBy('ujian.id')
            ->select('ujian.id', DB::raw('count(siswa.id) as jumlah_pengumpul'))
            ->get();

        $jlhSudahMengumpul = DB::table('ujian')
            ->leftJoin('hasilujian', 'ujian.id', '=', 'hasilujian.id_ujian')
            ->groupBy('ujian.id')
            ->select('ujian.id', DB::raw('count(hasilujian.id) as jumlah_sudah_mengumpulkan'))
            ->get();

        $jlhBelumMengumpul = [];
        foreach ($jlhPengumpul as $pengumpul) {
            foreach ($jlhSudahMengumpul as $mengumpulkan) {
                if ($pengumpul->id == $mengumpulkan->id) {
                    $jumlahBelumMengumpul = $pengumpul->jumlah_pengumpul - $mengumpulkan->jumlah_sudah_mengumpulkan;
                    $jlhBelumMengumpul[$pengumpul->id] = $jumlahBelumMengumpul;
                }
            }
        }
        // dd($jlhPengumpul);
        return view('guru.ujian.ujian_submitted', compact('ujian', 'jlhSudahMengumpul', 'jlhBelumMengumpul'));
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
            $latitudekantor = 3.597889;
            $longitudekantor = 98.747934;
            // $latitudekantor = 2.383129;
            // $longitudekantor = 99.148454;
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
                    if ($request->has('captured_image')) {
                        $imageDataUri = $request->input('captured_image');
                        $imagePath = 'public/absen/guru/' . uniqid() . '.jpg';
                        $image = Image::make($imageDataUri)->encode('jpg', 80);
                        Storage::disk('public')->put($imagePath, $image);

                        // Save the image path to the 'gambar' column
                        $gambar = $imagePath;
                    } else {
                        // If the image is not captured, you can set a default image path or handle it accordingly
                        $gambar = 'path/to/default/image.jpg';
                    }

                    $data = [
                        'id_guru' => $id,
                        'npdn' => $id_user,
                        'tgl_presensi' => $tgl_presensi,
                        'jam_masuk' => $jam,
                        'jam_keluar' => Null,
                        'gambar' => $gambar,
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

    public function keahlian()
    {
        $keahlian = DB::table('keahlianguru')->get();
        return view('guru.keahlian.index', compact('keahlian'));
    }

    public function addkeahlian(Request $request)
    {
        $id_user = Auth::user()->id;
        $nama_keahlian = $request->nama_keahlian;
        $catatan = $request->catatan;
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/keahlian';
        $file->move($tujuanFile, $namafile);

        $data = [
            'nama_keahlian' => $nama_keahlian,
            'id_user' => $id_user,
            'file' => $namafile,
            'catatan' => $catatan,
            'created_at' => now()
        ];

        $simpan = DB::table('keahlianguru')->insert($data);

        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data berhasil Tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal di proses']);
        }
    }

    public function deletekeahlian($id)
    {

        $delete = DB::table('keahlianguru')->where('id', $id)->delete();
        if ($delete) {
            return redirect('/keahlian')->with(['success' => "Keahlian Berhasil Di Hapus!"]);
        } else {
            return redirect('/keahlian')->with(['error' => "Gagal Di Hapus!"]);
        }
    }

    public function editkeahlian($id)
    {
        $keahlian = KeahlianGuru::find($id);

        return view('guru.keahlian.edit', compact('keahlian'));
    }

    public function editkeahlianpros(Request $request, $id)
    {
        // Validasi inputan jika diperlukan
        $request->validate([
            'nama_keahlian' => 'required',
            'catatan' => 'required',
        ]);

        // Ambil data surat berdasarkan ID
        $keahlian = KeahlianGuru::find($id);

        // Simpan gambar lama
        $namafile = $keahlian->file;

        // Update data surat dengan nilai inputan
        $keahlian->nama_keahlian = $request->nama_keahlian;
        $keahlian->catatan = $request->catatan;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/keahlian';
            $file->move($tujuanFile, $namafile);
        }

        $keahlian->file = $namafile;


        // Simpan perubahan
        $keahlian->save();

        if ($keahlian) {
            return redirect('/keahlian')->with(['success' => "Keahlian Berhasil Di Update!"]);
        } else {
            return redirect('/keahlian')->with(['error' => "Data Gagal Di Update"]);
        }
    }
}
