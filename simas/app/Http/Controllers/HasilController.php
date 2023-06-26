<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HasilController extends Controller
{


    public function index(){

        $hariIni = Carbon::now();
    $id_user = Auth::user()->id_user;
    $id = Auth::user()->id;
    $tgl = $hariIni->format('d-m-Y');
    $jurusan = Auth::user()->jurusan;
    $kelas = Auth::user()->kelas;
    $hari = $hariIni->formatLocalized('%A');

    $hasil = DB::table('hasilujian')
    ->join('ujian','hasilujian.id_ujian','=','ujian.id')
    ->selectRaw('ujian.mapel as mata_pelajaran, MAX(CASE WHEN hasilujian.jenis_ujian = "UAS" THEN hasilujian.nilai END) as nilai_uas, MAX(CASE WHEN hasilujian.jenis_ujian = "UTS" THEN hasilujian.nilai END) as nilai_uts')
    ->where('id_siswa', $id)
    ->groupBy('ujian.mapel')
    ->get();


    // $data = DB::table('hasil_ujian')
    // ->selectRaw('mata_pelajaran, MAX(CASE WHEN jenis_ujian = "UAS" THEN nilai END) as nilai_uas, MAX(CASE WHEN jenis_ujian = "UTS" THEN nilai END) as nilai_uts')
    // ->groupBy('mata_pelajaran')
    // ->get();


        return view('siswa.ujian.hasilujian',compact('hari','tgl','hasil'));
    }
}
