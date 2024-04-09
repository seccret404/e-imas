<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Mail\Siswa as Emails;
use Illuminate\Support\Facades\DB;


class PesanController extends Controller
{
    public function pesan()
    {
        return view('admin.layanan.email_all');
    }


    public function sendMessage(Request $request)
    {
        $pesan = $request->pesan;
        $tujuan = $request->tujuan;
        $judul = $request->judul;
        $body = $request->body;

        if ($tujuan = $request->tujuan == "siswa") {
            $siswaEmails = Siswa::pluck('email')->toArray();
        } elseif ($tujuan = $request->tujuan == "guru") {
            $siswaEmails = Guru::pluck('email')->toArray();
        } elseif ($tujuan = $request->tujuan == "wali") {
            $siswaEmails = DB::table('siswa')->join('guru', 'siswa.id_guru', '=', 'guru.id')->select('guru.email')->pluck('email')->toArray();
        }

        $mailData = [
            'title' => $judul,
            'body' => $body,
            'pesan' => $pesan

        ];

        Mail::to($siswaEmails)->send(new Emails($mailData));

        return redirect('/email-all')->with(['success' => "Email Berhasil Dikirim!"]);
    }

    public function siswa()
    {
        $siswa = DB::table('siswa')->orderBy('nama', 'asc')->get();
        return view('admin.layanan.siswa', compact('siswa'));
    }

    public function sendsiswa(Request $request)
    {
        $judul = $request->judul;
        $body = $request->body;
        $email = $request->email;
        $pesan = $request->pesan;

        $mailData = [
            'title' => $judul,
            'body' => $body,
            'pesan' => $pesan
        ];
        Mail::to($email)->send(new Emails($mailData));
        return redirect('/siswa-email')->with(['success' => "Email Berhasil Dikirim!"]);
    }

    public function guru()
    {
        $guru = DB::table('guru')->orderBy('nama', 'asc')->get();
        return view('admin.layanan.guru', compact('guru'));
    }
    public function sendguru(Request $request)
    {
        $judul = $request->judul;
        $body = $request->body;
        $email = $request->email;
        $pesan = $request->pesan;
        // dd($email);

        // Periksa validitas alamat email sebelum mengirim email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect('/guru-email')->with(['error' => 'Alamat email tidak valid atau kosong']);
        }

        $mailData = [
            'title' => $judul,
            'body' => $body,
            'pesan' => $pesan
        ];

        Mail::to($email)->send(new Emails($mailData));
        return redirect('/guru-email')->with(['success' => 'Email Berhasil Dikirim!']);
    }


    public function wali()
    {
        $guru  = DB::table('guru')
            ->join('siswa', 'guru.id', '=', 'siswa.id_guru')
            ->select('siswa.jurusan', 'siswa.kelas', 'guru.email', 'guru.nama')
            ->orderBy('nama', 'asc')
            ->distinct()
            ->get();
        return view('admin.layanan.wali', compact('guru'));
    }
}
