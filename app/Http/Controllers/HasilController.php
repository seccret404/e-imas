<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HasilController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::now();
        $id_user = Auth::user()->id_user;
        $id = Auth::user()->id;
        $tgl = $hariIni->format('d-m-Y');
        $jurusan = Auth::user()->jurusan;
        $kelas = Auth::user()->kelas;
        $hari = $hariIni->formatLocalized('%A');

        $hasitugas = DB::table('hasiltugas')
            ->join('tugas', 'hasiltugas.id_tugas', '=', 'tugas.id_tugas')
            ->selectRaw('tugas.nama_pelajaran as mata_pelajaran, SUM(hasiltugas.nilai) as total_nilai_tugas, COUNT(tugas.id_tugas) as jumlah_tugas')
            ->where('id_user', $id)
            ->groupBy('tugas.nama_pelajaran')
            ->get();

        $hasilujian = DB::table('hasilujian')
            ->join('ujian', 'hasilujian.id_ujian', '=', 'ujian.id')
            ->selectRaw('ujian.mapel as mata_pelajaran, 
            MAX(CASE WHEN hasilujian.jenis_ujian = "UAS" THEN hasilujian.nilai END) as nilai_uas, 
            MAX(CASE WHEN hasilujian.jenis_ujian = "UTS" THEN hasilujian.nilai END) as nilai_uts,
            NULL as nilai_tugas')
            ->where('id_siswa', $id)
            ->groupBy('ujian.mapel')
            ->get();

        $hasil = [];

        foreach ($hasilujian as $item) {
            $hasil[] = (object) [
                'mata_pelajaran' => $item->mata_pelajaran,
                'nilai_tugas' => null,
                'nilai_uts' => $item->nilai_uts,
                'nilai_uas' => $item->nilai_uas
            ];
        }

        foreach ($hasitugas as $item) {
            $existingItem = collect($hasil)->firstWhere('mata_pelajaran', $item->mata_pelajaran);

            if ($existingItem) {
                $existingItem->nilai_tugas = $item->total_nilai_tugas / $item->jumlah_tugas;
            } else {
                $hasil[] = (object) [
                    'mata_pelajaran' => $item->mata_pelajaran,
                    'nilai_tugas' => $item->total_nilai_tugas / $item->jumlah_tugas,
                    'nilai_uts' => null,
                    'nilai_uas' => null
                ];
            }
        }

        return view('siswa.ujian.hasilujian', compact('hari', 'tgl', 'hasil'));
    }
}
