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

    $hasil = DB::table('hasilujian')->where('id_siswa',$id_user)->get();
        return view('siswa.ujian.hasilujian',compact('hari','tgl','hasil'));
    }
}
