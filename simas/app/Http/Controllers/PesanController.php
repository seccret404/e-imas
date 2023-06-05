<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Mail\PesanSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PesanController extends Controller
{
    public function pesan(){
        return view('admin.layanan.email_all');
    }


    public function sendMessage(Request $request){

        $emailList = Siswa::getEmailList();
        $pesan = "Pesan dari admin";

        Mail::bcc($emailList)->send(new PesanSiswa($pesan));

    return redirect()->back()->with('success', 'Pesan berhasil dikirim ke semua siswa.');
}
}
