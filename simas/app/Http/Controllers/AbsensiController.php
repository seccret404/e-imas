<?php

namespace App\Http\Controllers;

use App\Models\AbsenSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function absens_siswa(){
        $nisn = Auth::user()->id_user;
        $absen = DB::table('presensisiswa')
        ->join('users','presensisiswa.id_siswa','=','users.id')
        ->select('presensisiswa.*','users.name')
        ->where('nisn',$nisn)
        ->get();

        return view('siswa.absensiswa',compact('absen'));
    }


    public function update($id){
        
        $jam = date("H:i:s");
        AbsenSiswa::where('id', $id)
        ->update([
            'jam_keluar' => $jam,

        ]);

        return redirect('/detail-absen')->with(['success' => "Telah Melakukan Absen"]);
    }
}
