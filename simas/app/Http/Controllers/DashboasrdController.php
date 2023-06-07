<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Ruangan;
use App\Models\Pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DashboasrdController extends Controller
{
    public function index(){
        $pengumuman = DB::table('pengumuman')->orderBy('created_at', 'desc')->get ();
        $siswa = Siswa::count();
        $man = DB::table('siswa')
        ->where('jenis_kelamin',"laki-laki")
        ->count();
        $woman = DB::table('siswa')
        ->where('jenis_kelamin',"perempuan")
        ->count();
        $guru = Guru::count();
        return view('admin.index',compact('pengumuman','siswa','guru','man','woman'));
    }

    public function guru(){

        $guru =  DB::table('guru')->get();

        return view('admin.guru.index',compact('guru'));
    }

    public function addguru(Request $request){
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
        $file->move($tujuanFile,$namafile);


        $extensi = "@guru.com";
        $j = "Null";
        $k = "Null";
        $buatUsername = $kode_guru . $extensi;
        $role = "guru";
        $tambahuser = User::create([
            'name'=>$request->input('nama'),
            'jurusan'=>$j,
            'kelas'=>$k,
            'id_user'=>$npdn,
            'email'=>$buatUsername,
            'password'=>Hash::make($request->input('no_hp')),
            'role'=>$role
        ]);

        $data = [
            'nama'=>$nama,
            'npdn'=>$npdn,
            'kode_guru'=>$kode_guru,
            'alamat'=>$alamat,
            'email'=>$email,
            'no_hp'=>$no_hp,
            'jenis_kelamin'=>$jenis_kelamin,
            'tempat_lahir'=>$tempat,
             'tanggal_lahir'=>$tanggal,
             'profil'=>$namafile
        ];

        $simpan = DB::table('guru')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);

        }else{
            return Redirect::back()->with(['error' => 'Data gagal tambah']);

        }

    }
    public function siswa(){
        $siswa = DB::table('siswa')
        ->join('guru', 'siswa.id_guru', '=', 'guru.id')
        ->select('siswa.*', 'guru.nama as nama_guru')
        ->get();
        $guru = DB::table('guru')->get();
        return view('admin.siswa.index',compact('siswa','guru'));

    }
    public function addsiswa(Request $request){
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
        $file->move($tujuanFile,$namafile);

        $extensi = "@siswa.com";
        $buatUsername = $nisn . $extensi;
        $role = "siswa";


        $pengguna = User::create([
            'name' => $request->input('nama'),
            'id_user'=>$nisn,
            'jurusan'=>$jurusan,
            'kelas'=>$kelas,
            'email' => $buatUsername,
            'password' => Hash::make($request->input('nisn')),
            'role' => $role,
        ]);

        $data = [
             'nama'=> $nama,
             'nisn'=> $nisn,
             'id_guru'=>$wali_kelas,
             'jenis_kelamin'=>$jenis_kelamin,
             'jurusan'=>$jurusan,
             'kelas'=>$kelas,
             'alamat'=>$alamat,
             'email'=>$email,
             'tempat_lahir'=>$tempat,
             'tanggal_lahir'=>$tanggal,
             'no_hp_siswa'=>$siswa_hp,
             'no_hp_wali'=>$wali_hp,
             'nama_ibu_kandung'=>$wali,
             'profil'=>$namafile
        ];

        $simpan = DB::table('siswa')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);

        }else{
            return Redirect::back()->with(['error' => 'Data gagal tambah']);

        }
    }

    public function akademik(){
        $akademik = DB::table('akademik')->get();
        return view('admin.akademik.index',compact('akademik'));
    }

    public function addakademik(Request $request){
        $tahun = $request->tahun;
        $nama = $request->nama;

        $data = [
            'tahun'=>$tahun,
            'nama'=>$nama
        ];

        $simpan = DB::table('akademik')->insert($data);

        if($simpan){
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);

        }else{
            return Redirect::back()->with(['error' => 'Data gagal tambah']);

        }
    }


    public function mapel(){
        $akademik = DB::table('akademik')->get();

        $guru = DB::table('guru')->get();

        $mapel = DB::table('matapelajran')->get();
        return view('admin.pelajaran.matapelajaran',compact('akademik','guru','mapel'));
    }

    public function addmapel(Request $request){


        $nama_pelajaran = $request->nama_pelajaran;
        $nama = $request->nama;
        $kode_guru = $request->kode_guru;
        $jurusan = $request->jurusan;
        $kelas = $request->kelas;

        $data = [
            'nama_pelajaran'=>$nama_pelajaran,
            'nama'=>$nama,
            'kode_guru'=>$kode_guru,
            'jurusan'=>$jurusan,
            'kelas'=>$kelas
        ];

        $simpan = DB::table('matapelajran')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);

        }else{
            return Redirect::back()->with(['error' => 'Data gagal tambah']);

        }



    }

    public function kelasipax(){
        $guru = DB::table('guru')->get();
        $room = DB::table('ruangan')->get();
        $mapel = DB::table('matapelajran')
        ->where('kelas',10)
        ->get();


        $jadwal = DB::table('jadwal')
        ->join('ruangan','jadwal.ruangan','=','ruangan.id')
        ->join('guru','jadwal.kode_guru','=','guru.id')
        ->select('jadwal.*','ruangan.nama_ruangan','guru.nama')
        ->where('kelas',10)
        ->where('jurusan',"IPA")
        ->get();
        return view('admin.pelajaran.ipa.kelas10',compact('mapel','guru','jadwal','room'));
    }

    public function kelasipaxi(){
        $guru = DB::table('guru')->get();
        $mapel = DB::table('matapelajran')
        ->where('kelas',11)
        ->where('jurusan',"IPA")
        ->get();
        $jadwal = DB::table('jadwal')
        ->join('ruangan','jadwal.ruangan','=','ruangan.id')
        ->select('jadwal.*','ruangan.nama_ruangan')
        ->get();

        return view('admin.pelajaran.ipa.kelas11',compact('guru','mapel','jadwal'));
    }

    public function kelasipaxii(){
        $guru = DB::table('guru')->get();
        $mapel = DB::table('matapelajran')
        ->where('kelas',12)
        ->where('jurusan',"IPA")
        ->get();
        $jadwal = DB::table('jadwal')
        ->where('kelas', 12)
        ->get();
        return view('admin.pelajaran.ipa.kelas12',compact('guru','mapel','jadwal'));

    }

    public function kelasipsx(){
        $guru = DB::table('guru')->get();
        $mapel = DB::table('matapelajran')
        ->where('jurusan', "IPS")
        ->get();
        $jadwal = DB::table('jadwal')
        ->where('kelas', 10)
        ->where('jurusan',"IPS")
        ->get();
        return view('admin.pelajaran.ips.kelas10',compact('guru','mapel','jadwal'));
    }

    public function kelasipsxi(){
        $guru = DB::table('guru')->get();
        $mapel = DB::table('matapelajran')
        ->where('jurusan', "IPS")
        ->get();
        $jadwal = DB::table('jadwal')
        ->where('kelas', 11)
        ->where('jurusan',"IPS")
        ->get();
        return view('admin.pelajaran.ips.kelas11',compact('guru','mapel','jadwal'));
    }

    public function kelasipsxii(){
        $guru = DB::table('guru')->get();
        $mapel = DB::table('matapelajran')
        ->where('jurusan', "IPS")
        ->get();
        $jadwal = DB::table('jadwal')
        ->where('kelas', 12)
        ->where('jurusan',"IPS")
        ->get();
        return view('admin.pelajaran.ips.kelas12',compact('guru','mapel','jadwal'));
    }

    public function addjadwal(Request $request){
        $hari = $request->hari;
        $nama_pelajaran = $request->nama_pelajaran;
        $jam_masuk = $request->jam_masuk;
        $jam_selesai = $request->jam_selesai;
        $kode_guru = $request->kode_guru;
        $ruangan = $request->ruangan;
        $jurusan = $request->jurusan;
        $kelas = $request->kelas;

        $data = [
            'hari'=>$hari,
            'nama_pelajaran'=>$nama_pelajaran,
            'jam_masuk'=>$jam_masuk,
            'jam_selesai'=>$jam_selesai,
            'ruangan'=>$ruangan,
            'kode_guru'=>$kode_guru,
            'jurusan'=>$jurusan,
            'kelas'=>$kelas

        ];

        $simpan = DB::table('jadwal')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);

        }else{
            return Redirect::back()->with(['error' => 'Data gagal tambah']);

        }


    }

    public function room(){

        $ruangan = DB::table('ruangan')->get();
        return view('admin.ruangan.index',compact('ruangan'));
    }
    public function adroom(Request $request){
        $nama_ruangan = $request->nama_ruangan;
        $kode_ruangan = $request->kode_ruangan;
        $status = $request->status;
        $keterangan = $request->keterangan;


        $data = [
            'nama_ruangan'=>$nama_ruangan,
            'kode_ruangan'=>$kode_ruangan,
            'status'=>$status,
            'keterangan'=>$keterangan
        ];
    $simpan = DB::table('ruangan')->insert($data);
     if($simpan){
            return Redirect::back()->with(['success' => 'Data berhasil tambah']);

        }else{
            return Redirect::back()->with(['error' => 'Data gagal tambah']);

        }

    }

    public function deleter($id){
        $delete = DB::table('ruangan')->where('id',$id)->delete();
        if($delete){
            return redirect('/ruangan')->with(['success'=> "Ruangan Berhasil Di Hapus!"]);

        }else{
            return redirect('/ruangan')->with(['error'=> "Gagal Di Hapus!"]);

        }
    }

    public function editr($id){
        $ruangan = Ruangan::find($id);

        return view('admin.ruangan.edit',compact('ruangan'));

    }

    public function editpros(Request $request, $id){
        $ruangan = Ruangan::find($id);
        $ruangan->update($request->all());

        return redirect('/ruangan')->with(['success'=> "Ruangan Berhasil Di Update!"]);


    }

    public function deletea($id){
        $delete = DB::table('akademik')->where('id',$id)->delete();

        if($delete){
            return redirect('/tahun-akademik')->with(['success'=>"Tahun Akademik Berhasil Dihapus"]);
        }else{
            return redirect('/tahun-akademik')->with(['error'=>"Tahun Akademik Gagal Dihapus"]);

        }
    }

    public function editg($id){
        $guru = Guru::find($id);
        return view('admin.guru.edit',compact('guru'));
    }

    public function editprosg(Request $request, $id){
        $guru = Guru::find($id);
        $guru->update($request->all());

        return redirect('/guru')->with(['success'=>"Data Guru Berhasil Di Update"]);
    }

    public function deleteg($id){
        $delete = DB::table('guru')->where('id', $id)->delete();

        if($delete){
            return redirect('/guru')->with(['success'=>"Data Guru Berhasil Di Hapus!"]);
        }else{
            return redirect('/guru')->with(['error'=>"Data Guru Gagal Di Hapus!"]);

        }
    }

    public function deletes($id){
        $delete = DB::table('siswa')->where('id',$id)->delete();

        if($delete){
            return redirect('/siswa')->with(['success'=>"Data Siwa Berhasil Di Hapus"]);
        }else{
            return redirect('/siswa')->with(['success'=>"Data Siwa Gagal Di Hapus"]);

        }
    }

    public function edits($id){
        $siswa = Siswa::find($id);

        return view('admin.siswa.edit',compact('siswa'));
    }

    public function editpross(Request $request,$id){
        $siswa = Siswa::find($id);
        $siswa->update($request->all());

        return redirect('/siswa')->with(['success'=>"Data Siswa Berhasil Di Update!"]);
    }

    public function deletep($id){
        $delete = DB::table('matapelajran')->where('id',$id)->delete();

        if($delete){
            return redirect('/mata-pelajaran')->with(['success'=>"Data Berhasil Di Hapus"]);
        }else{
            return redirect('/mata-pelajaran')->with(['error'=>"Data Gagal Di Hapus"]);

        }
    }

    public function editp($id){
        $akademik = DB::table('akademik')->get();
        $guru = DB::table('guru')->get();
        $pelajaran = Pelajaran::find($id);

        return view('admin.pelajaran.edit',compact('pelajaran','akademik','guru'));
    }

    public function editprosp(Request $request, $id){
        $pelajaran = Pelajaran::find($id);
        $pelajaran->update($request->all());

        return redirect('/mata-pelajaran')->with(['success'=>"Matapelajaran Berhasil Di Update"]);


    }
    public function deletej($id){
        $delete = DB::table('jadwal')->where('id',$id)->delete();

        if($delete){
            return Redirect::back()->with(['success' => 'Data berhasil dihapus']);

        }
    }

    public function indext(){
        $mapel = DB::table('matapelajran')->get();
        $tugas = DB::table('tugas')->get();
        return view('admin.tugas.index',compact('mapel','tugas'));
    }
    public function addtugas(Request $request){

        $mapel = $request->nama_pelajaran;
        $judul = $request->judul;
        $dedline = $request->dedline;
        $jurusan = $request->jurusan;
        $kelas = $request->kelas;
        $catatan = $request->catatan;

        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/tugas';
        $file->move($tujuanFile,$namafile);

        $data = [
            'nama_pelajaran'=>$mapel,
            'judul'=>$judul,
            'dedline'=>$dedline,
            'jurusan'=>$jurusan,
            'kelas'=>$kelas,
            'catatan'=>$catatan,
            'file'=>$namafile
        ];

        $simpan = DB::table('tugas')->insert($data);

        if($simpan){
            return Redirect::back()->with(['success' => 'Data berhasil Tambah']);

        }else{
            return Redirect::back()->with(['error' => 'Data gagal di proses']);

        }

    }
    public function deletet($id){
        $delete = DB::table('tugas')->where('id',$id)->delete();

        if($delete){
            return Redirect::back()->with(['success' => 'Data berhasil di hapus ']);

        }else{
            return Redirect::back()->with(['error' => 'Data gagal dihapus']);

        }


    }

    public function ahli(){
        $guru = DB::table('guru')->get();

        return view('admin.guru.keahlian',compact('guru'));
    }

    public function detailahli($id){
        $guru = Guru::find($id);

        $pj = DB::table('jadwal')
            ->select('nama_pelajaran', DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(jam_selesai, jam_masuk)) / 3600) AS jumlah_jam_masuk'))
            ->where('kode_guru', $id)
            ->groupBy('nama_pelajaran')
            ->get();
        return view ('admin.guru.detail',compact('guru','pj'));
    }



    public function pengumumanadd(Request $request){
        //dd($request->all());

        $judul = $request->judul;
        $info = $request->info;

        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/pengumuman';
        $file->move($tujuanFile,$namafile);

        $data = [
            'judul'=>$judul,
            'info'=>$info,
            'file'=>$namafile
        ];

        $simpan = DB::table('pengumuman')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success' => 'Pngumuman berhasil Tambah']);

        }else{
            return Redirect::back()->with(['error' => 'Data gagal di proses']);

        }
    }

    public function delete($id_pengumuman){
        $delete = DB::table('pengumuman')->where('id_pengumuman',$id_pengumuman)->delete();
        if($delete){
            return redirect('/dashboard')->with(['success'=> "Postingan Berhasil Di Hapus!"]);

        }else{
            return redirect('/dashboard')->with(['error'=> "Gagal Di Hapus!"]);

        }
    }

    //siswa
    public function pmb(){
        return view('admin.siswabaru.index');
    }

}
