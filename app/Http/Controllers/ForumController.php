<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Forum;
use App\Models\Jawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class ForumController extends Controller
{
    public function forum(){

        $forum = DB::table('forum')->get();
        $hariIni = Carbon::now();
        // $id_user = Auth::user()->id_user;
        $tgl = $hariIni->format('d-m-Y');
        $hari = $hariIni->formatLocalized('%A');
        $pelajaran = DB::table('matapelajran')->get();

        return view('siswa.forum.forum',compact('hari','tgl','pelajaran','forum'));
    }

    public function detail($id_q){

        $forum = Forum::find($id_q);
        $hariIni = Carbon::now();
        // $id_user = Auth::user()->id_user;
        $tgl = $hariIni->format('d-m-Y');
        $hari = $hariIni->formatLocalized('%A');

        $question = Forum::findOrFail($id_q);
        $jawab = $question->answers;
        return view('siswa.forum.jawaban',compact('hari','tgl','forum','jawab'));
    }

    public function addforum(Request $request){
        $request->validate([
            'judul'=>['required'],
            'pertanyaan'=>['required'],
            'deskripsi'=>['required']
        ]);

        $id_user = Auth::user()->id;
        $nama = Auth::user()->name;

        if($file = $request->file('gambar')){
        $file = $request->file('gambar');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/forum';
        $file->move($tujuanFile,$namafile);
        }else{
            $file = "Null";
        }


        $forum = new Forum;
        $forum->judul = $request->judul;
        $forum->id_q = $request->id_q;
        $forum->judul = $request->judul;
        $forum->nama_matapelajaran = $request->nama_pelajaran;
        $forum->pertanyaan = $request->pertanyaan;
        $forum->deskripsi = $request->deskripsi;
        $forum->gambar = $namafile;
        $forum->id_user = $id_user;
        $forum->nama_penanya = $nama;
        $forum->save();


        return Redirect::back()->with(['success' => 'Pertanyaan berhasil tambah']);



    }

    public function jawban(Request $request){
      //  dd($request->all());
        $request->validate([
            'jawaban'=>['required'],
            'id_q'=>['required']
        ]);
        $file = $request->file('gambar');
        $namafile = $file->getClientOriginalName();
        $tujuanFile = 'asset/jawaban';
        $file->move($tujuanFile,$namafile);

        $id_user = Auth::user()->id;
        $nama = Auth::user()->name;

        $jawab = new Jawab;
        $jawab->jawaban = $request->jawaban;
        $jawab->id_q = $request->id_q;
        $jawab->nama_penjawab = $nama;
        $jawab->id_user = $id_user;
        $jawab->gambar = $namafile;
        $jawab->save();

        return Redirect::back()->with(['success' => 'Jawaban Terkirim!!']);
    }

    public function show(){


        return view('siswa.forum.jawaban',compact('jawab'));

    }

    public function destroy($id_q)
    {
        $post = Forum::find($id_q);

        // Memeriksa apakah pengguna saat ini adalah pemilik postingan
        if (!$post) {


            return redirect()->back()->with('error', 'Postingan tidak ditemukan.');
                }

            if (Auth::user()->id === $post->id_user) {


            $post->delete();


            return redirect()->back()->with('success', 'Postingan berhasil dihapus.');
                }
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus postingan ini.');



}
public function destroyj($id_j)
{
    $post = Jawab::find($id_j);

    // Memeriksa apakah pengguna saat ini adalah pemilik postingan
    if (!$post) {
        return redirect()->back()->with('error', 'Postingan tidak ditemukan.');
            }
        if (Auth::user()->id === $post->id_user) {
        $post->delete();
        return redirect()->back()->with('success', 'Jawaban berhasil dihapus.');
            }
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus postingan ini.');



}
}
