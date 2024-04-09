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
            ->selectRaw('tugas.nama_pelajaran as mata_pelajaran, AVG(hasiltugas.nilai) as nilai_tugas')
            ->where('id_user', $id)
            ->groupBy('tugas.nama_pelajaran')
            ->get();

        $hasilulangan = DB::table('hasilujian')
            ->join('ujian', 'hasilujian.id_ujian', '=', 'ujian.id')
            ->selectRaw('ujian.mapel as mata_pelajaran, AVG(hasilujian.nilai) as nilai_ulangan')
            ->where('id_siswa', $id)
            ->where('hasilujian.jenis_ujian', 'ulangan')
            ->groupBy('ujian.mapel')
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
                'nilai_uas' => $item->nilai_uas,
                'nilai_ulangan' => null
            ];
        }

        foreach ($hasitugas as $item) {
            $existingItem = collect($hasil)->firstWhere('mata_pelajaran', $item->mata_pelajaran);

            if ($existingItem) {
                $existingItem->nilai_tugas = $item->nilai_tugas;
            } else {
                $hasil[] = (object) [
                    'mata_pelajaran' => $item->mata_pelajaran,
                    'nilai_tugas' => $item->nilai_tugas,
                    'nilai_uts' => null,
                    'nilai_uas' => null,
                    'nilai_ulangan' => null
                ];
            }
        }

        foreach ($hasilulangan as $item) {
            $existingItem = collect($hasil)->firstWhere('mata_pelajaran', $item->mata_pelajaran);

            if ($existingItem) {
                $existingItem->nilai_ulangan = $item->nilai_ulangan;
            } else {
                $hasil[] = (object) [
                    'mata_pelajaran' => $item->mata_pelajaran,
                    'nilai_tugas' => null,
                    'nilai_uts' => null,
                    'nilai_uas' => null,
                    'nilai_ulangan' => $item->nilai_ulangan
                ];
            }
        }

        return view('siswa.ujian.hasilujian', compact('hari', 'tgl', 'hasil'));
    }
}
