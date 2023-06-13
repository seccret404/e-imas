<?php

namespace App\Http\Controllers;

use App\Models\Surat;
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
}
