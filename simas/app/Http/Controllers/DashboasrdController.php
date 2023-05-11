<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboasrdController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function guru(){
        return view('admin.guru.index');
    }
    public function siswa(){
        return view('admin.siswa.index');
    }
    public function akademik(){
        return view('admin.akademik.index');
    }
    public function mapel(){
        return view('admin.pelajaran.matapelajaran');
    }
}
