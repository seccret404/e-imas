<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestasiController extends Controller
{
    public function index(){
        $prestasi = DB::table('prestasi')
                    ->join('users','prestasi.id_user','=','users.id')
                    ->select('users.name',)
                    ->orderBy('name','asc')
                    ->distinct()
                    ->get();
                    $jmlh = DB::table('prestasi')
                    ->select('id_user', DB::raw('count(*) as count'))
                    ->groupBy('id_user')
                    ->get();

        return view('admin.prestasi.index',compact('prestasi','jmlh'));
    }
}
