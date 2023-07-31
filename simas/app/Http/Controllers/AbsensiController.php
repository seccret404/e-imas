<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\AbsenGuru;
use App\Models\AbsenSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    // public function absens_siswa(){
    //     $nisn = Auth::user()->id_user;
    //     $absen = DB::table('presensisiswa')
    //     ->join('users','presensisiswa.id_siswa','=','users.id')
    //     ->select('presensisiswa.*','users.name')
    //     ->where('nisn',$nisn)
    //     ->get();

    //     return view('siswa.absensiswa',compact('absen'));
    // }

    public function absens_siswa()
    {
        $nisn = Auth::user()->id_user;
        $id = Auth::user()->id;
        $absen = DB::table('presensisiswa')
            ->join('users', 'presensisiswa.id_siswa', '=', 'users.id')
            ->select('presensisiswa.*', 'users.name')
            ->where('nisn', $nisn)
            ->get();

        // Generate the calendar for the current month and year
        $currentMonth = date('n'); // Current month (1 to 12)
        $currentYear = date('Y');  // Current year

        $firstDayOfMonth = new DateTime("$currentYear-$currentMonth-01");
        $lastDayOfMonth = new DateTime("$currentYear-$currentMonth-" . $firstDayOfMonth->format('t'));

        // Create an array of dates for the current month
        $datesInMonth = [];
        $currentDate = clone $firstDayOfMonth;
        while ($currentDate <= $lastDayOfMonth) {
            $datesInMonth[] = $currentDate->format('Y-m-d');
            $currentDate->modify('+1 day');
        }

        // Create a new array to store attendance data for each date in the month
        $absenWithDates = [];
        foreach ($datesInMonth as $date) {
            $absensiData = [
                'id' => $id,
                'tgl_presensi' => $date,
                'name' => null,
                'jam_masuk' => null,
                'jam_keluar' => null,
                'status' => 'Belum Absen'
            ];

            foreach ($absen as $item) {
                if ($item->tgl_presensi === $date) {
                    $absensiData['id'] = $item->id;
                    $absensiData['name'] = $item->name;
                    $absensiData['jam_masuk'] = $item->jam_masuk;
                    $absensiData['jam_keluar'] = $item->jam_keluar;
                    if ($item->jam_masuk && !$item->jam_keluar) {
                        $absensiData['status'] = 'Absensi Pulang Belum Dilakukan';
                    } else {
                        $absensiData['status'] = 'Absen Komplit';
                    }
                    break;
                }
            }

            $absenWithDates[] = $absensiData;
        }
        // dd($absenWithDates);
        return view('siswa.absensiswa', compact('absenWithDates'));
    }

    public function update($id)
    {

        $jam = date("H:i:s");
        AbsenSiswa::where('id', $id)
            ->update([
                'jam_keluar' => $jam,

            ]);

        return redirect('/detail-absen')->with(['success' => "Telah Melakukan Absen"]);
    }

    // public function absens_guru()
    // {
    //     $npdn = Auth::user()->id_user;
    //     $absen = DB::table('presensiguru')
    //         ->join('users', 'presensiguru.id_guru', '=', 'users.id')
    //         ->select('presensiguru.*', 'users.name')
    //         ->where('npdn', $npdn)
    //         ->get();

    //     return view('guru.absenguru', compact('absen'));
    // }

    public function absens_guru()
    {
        $npdn = Auth::user()->id_user;
        $id = Auth::user()->id;
        $absen = DB::table('presensiguru')
            ->join('users', 'presensiguru.id_guru', '=', 'users.id')
            ->select('presensiguru.*', 'users.name')
            ->where('npdn', $npdn)
            ->get();

        // Generate the calendar for the current month and year
        $currentMonth = date('n'); // Current month (1 to 12)
        $currentYear = date('Y');  // Current year

        $firstDayOfMonth = new DateTime("$currentYear-$currentMonth-01");
        $lastDayOfMonth = new DateTime("$currentYear-$currentMonth-" . $firstDayOfMonth->format('t'));

        // Create an array of dates for the current month
        $datesInMonth = [];
        $currentDate = clone $firstDayOfMonth;
        while ($currentDate <= $lastDayOfMonth) {
            $datesInMonth[] = $currentDate->format('Y-m-d');
            $currentDate->modify('+1 day');
        }

        // Create a new array to store attendance data for each date in the month
        $absenWithDates = [];
        foreach ($datesInMonth as $date) {
            $absensiData = [
                'id' => $id,
                'tgl_presensi' => $date,
                'name' => null,
                'jam_masuk' => null,
                'jam_keluar' => null,
                'status' => 'Belum Absen'
            ];

            foreach ($absen as $item) {
                if ($item->tgl_presensi === $date) {
                    $absensiData['id'] = $item->id;
                    $absensiData['name'] = $item->name;
                    $absensiData['jam_masuk'] = $item->jam_masuk;
                    $absensiData['jam_keluar'] = $item->jam_keluar;
                    if ($item->jam_masuk && !$item->jam_keluar) {
                        $absensiData['status'] = 'Absensi Pulang Belum Dilakukan';
                    } else {
                        $absensiData['status'] = 'Absen Komplit';
                    }
                    break;
                }
            }

            $absenWithDates[] = $absensiData;
        }
        // dd($absenWithDates);
        return view('guru.absenguru', compact('absenWithDates'));
    }


    public function update_absensi_guru($id)
    {

        $jam = date("H:i:s");
        AbsenGuru::where('id', $id)
            ->update([
                'jam_keluar' => $jam,

            ]);

        return redirect('/detail-absen-guru')->with(['success' => "Telah Melakukan Absen"]);
    }
}
