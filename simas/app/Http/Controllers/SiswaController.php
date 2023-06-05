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

class SiswaController extends Controller
{
    public function index(){
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
        if($cek > 0){
            $status = "Hadir";
        }else{
            $status = "Tidak Hadir";
        }

        // $jadwal = Jadwal::where('hari', $hariSekarang)->get();
        $jadwal = DB::table('jadwal')->where('jurusan',$jurusan)->where('kelas',$kelas)->where('hari',$hariSekarang)->get();

        $pengumuman = DB::table('pengumuman')->orderBy('created_at','desc')->get();
        $prestasi = DB::table('prestasi')->where('id_user',$id)->count();
        $mapel = DB::table('jadwal')->where('jurusan',$jurusan)->where('kelas',$kelas) ->distinct('jadwal.nama_pelajaran')->count();

         return view('siswa.index',compact('jadwal','hari','tgl','status','pengumuman','prestasi','mapel'));


    }

    public function tugas(){
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

        $tugas = DB::table('tugas')->where('jurusan',$jurusan)->where('kelas',$kelas)->where('dedline','>=',$hariSekarang)
        ->orderBy('dedline', 'asc')
        ->get();

        $warna = DB::table('tugas')->get();
        if($warna > $hariSekarang){
            $bg = "text-primary";
        }else if($warna = $hariSekarang){
            $bg="text-warning";
        }


        return view('siswa.tugas',compact('tugas','hari','tgl','bg'));

    }



    public function absen(){
        return view('siswa.absen');
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

    public function store(Request $request){

       if(Auth::check()){
        $id_user = Auth::user()->id_user;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $latitudekantor = 2.379135;
        $longitudekantor = 99.151415;
        $latitudeuser = $request->input('lokasiin');
        $longitudeuser = $request->input('lokasion');
        $lokasi = $latitudeuser.','. $longitudeuser;
        $jarak = $this->distance($latitudekantor,$longitudekantor,$latitudeuser,$longitudeuser);
        $radius = round($jarak["meters"]);

        $cek = DB::table('presensisiswa')->where('tgl_presensi', $tgl_presensi)->where('nisn', $id_user)->count();


        if($radius > 1000){
            return Redirect::back()->with(['warning'=>"Anda Berada Diluar Radius Sekolah"]);
        }else{
            if($cek > 0){
                return redirect('/dashboard/siswa')->with(['success'=>"Telah Melakukan Absen"]);
            }else{
               $data = [
                        'nisn' => $id_user,
                        'tgl_presensi' => $tgl_presensi,
                        'jam masuk' => $jam,
                        'gambar'=>"idie",
                        'location'=>$lokasi


                ];

        $simpan = DB::table('presensisiswa')->insert($data);
        if($simpan){
            return redirect('/dashboard/siswa')->with(['success'=>"Absen Selesai Selamat Belajar"]);

        }else{
            return redirect('/dashboard/siswa')->with(['error'=>"Absen Gagal"]);
        }
            }


    }
}
}
    public function prestasi(){
        $id_user = Auth::user()->id;

        $prestasi = DB::table('prestasi')->where('id_user',$id_user)->get();
        return view('siswa.prestasi.index',compact('prestasi'));
    }
    public function addpres(Request $request){
        $id_user = Auth::user()->id;
        $nama_prestasi = $request->nama_prestasi;
        $catatan = $request->catatan;
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/prestasi';
        $file->move($tujuanFile,$namafile);

        $data = [
            'nama_prestasi'=>$nama_prestasi,
            'id_user'=>$id_user,
            'file'=>$namafile,
            'catatan'=>$catatan
        ];

        $simpan = DB::table('prestasi')->insert($data);

        if($simpan){
            return Redirect::back()->with(['success' => 'Data berhasil Tambah']);

        }else{
            return Redirect::back()->with(['error' => 'Data gagal di proses']);

        }

    }
    public function deletepres($id){

        $delete = DB::table('prestasi')->where('id',$id)->delete();
        if($delete){
            return redirect('/prestasi')->with(['success'=> "Prestasi Berhasil Di Hapus!"]);

        }else{
            return redirect('/prestasi')->with(['error'=> "Gagal Di Hapus!"]);

        }
    }

    public function addtugas($id){
        $tugas = Tugas::find($id);
        return view('siswa.upload_tugas',compact('tugas'));
    }

    public function unggah(Request $request){
        //d($request->all());
        $id_user = Auth::user()->id;
        $nama = Auth::user()->name;
        $id_tugas = $request->id_tugas;
        $mapel = $request->nama_pelajaran;
        $dedline = $request->dedline;

        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/hasil';
        $file->move($tujuanFile,$namafile);

        $data = [
            'id_tugas'=>$id_tugas,
            'nama_pengumpul'=>$nama,
            'id_user'=>$id_user,
            'mata_pelajaran'=>$mapel,
            'file_hasil_tugas'=>$namafile,
            'dedline'=>$dedline,
        ];

        $simpan = DB::table('hasiltugas')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success' => 'Data berhasil Tambah']);

        }else{
            return Redirect::back()->with(['error' => 'Data gagal di proses']);

        }

        }

     public function hasil($id_tugas){

        $id_user = Auth::user()->id;

        $item = Hasil::where('id_user', $id_user)

        ->where('id_tugas', $id_tugas)
        ->get();

        return view('siswa.finish',compact('item'));
     }

     public function detail($id_pengumuman){
        $pengumuman = Pengumuman::find($id_pengumuman);

        return view('siswa.detail_pengumuman',compact('pengumuman'));
     }

     public function profil($id_user){
        $id_user = Auth::user()->id_user;
        $siswa = DB::table('siswa')
        ->where('nisn',$id_user)->get();
        return view('siswa.profil',compact('siswa'));
     }




}
