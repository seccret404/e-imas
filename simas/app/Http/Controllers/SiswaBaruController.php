<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaBaruController extends Controller
{
    public function index(){
        return view('pendaftaran.form_pendaftaran');
    }
}
