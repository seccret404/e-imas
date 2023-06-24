<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{
    public function guru(){
        $sguru = DB::table('surat_izins')->where('role',"guru")->get();

        return view('admin.surat.guru',compact('sguru'));
    }
    public function siswa(){
        $ssiswa = DB::table('surat_izins')->where('role',"siswa")->get();
        return view('admin.surat.siswa',compact('ssiswa'));
    }


    public function konfirmasi($id){
        Surat::where('id', $id)
        ->update(['status' => 1]);
        return redirect()->back()->with('success', 'Status berhasil diupdate.');


    }

    public function tolak($id){
        Surat::where('id',$id)->update(['status'=>2]);
        return redirect()->back()->with('success', 'Status berhasil diupdate.');

    }
}
