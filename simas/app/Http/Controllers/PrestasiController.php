<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestasiController extends Controller
{
    public function index(){
        $prestasi = DB::table('users')
                        ->join('prestasi', 'users.id', '=', 'prestasi.id_user')
                        ->select('users.name as nama_siswa','users.id as id', DB::raw('COUNT(prestasi.id) as jumlah_prestasi' ))
                        ->groupBy('users.id','users.name')
                        ->get();
        return view('admin.prestasi.index',compact('prestasi'));
    }


}
