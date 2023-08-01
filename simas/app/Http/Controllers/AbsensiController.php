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

    public function rekapabsenguru(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Set the default filter to the current month if no dates are provided
        if (empty($startDate) || empty($endDate)) {
            $currentMonth = date('n'); // Current month (1 to 12)
            $currentYear = date('Y');  // Current year

            $startDate = "$currentYear-$currentMonth-01";
            $endDate = date('Y-m-t', strtotime($startDate));
        }

        $users = DB::table('users')
            ->select('id', 'name')
            ->where('role', 'guru')
            ->get();

        // Generate the calendar for the selected date range
        $firstDayOfMonth = new DateTime($startDate);
        $lastDayOfMonth = new DateTime($endDate);

        $datesInMonth = [];
        $currentDate = clone $firstDayOfMonth;
        while ($currentDate <= $lastDayOfMonth) {
            $datesInMonth[] = $currentDate->format('Y-m-d');
            $currentDate->modify('+1 day');
        }

        // Fetch attendance data for the selected date range and group it by user ID and date
        $absen = DB::table('presensiguru')
            ->select('id_guru', 'tgl_presensi', 'jam_masuk', 'jam_keluar')
            ->whereIn('tgl_presensi', $datesInMonth)
            ->get();

        $groupedAbsen = [];
        foreach ($absen as $attendance) {
            $userId = $attendance->id_guru;
            $date = $attendance->tgl_presensi;

            if (!isset($groupedAbsen[$userId])) {
                $groupedAbsen[$userId] = [];
            }

            $groupedAbsen[$userId][$date] = $attendance;
        }

        return view('admin.rekap_absen.rekap_absen_guru', compact('users', 'groupedAbsen', 'datesInMonth', 'startDate', 'endDate'));
    }

    public function rekapabsensiswa(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Set the default filter to the current month if no dates are provided
        if (empty($startDate) || empty($endDate)) {
            $currentMonth = date('n'); // Current month (1 to 12)
            $currentYear = date('Y');  // Current year

            $startDate = "$currentYear-$currentMonth-01";
            $endDate = date('Y-m-t', strtotime($startDate));
        }

        $users = DB::table('users')
            ->select('id', 'name')
            ->where('role', 'siswa')
            ->get();

        // Generate the calendar for the selected date range
        $firstDayOfMonth = new DateTime($startDate);
        $lastDayOfMonth = new DateTime($endDate);

        $datesInMonth = [];
        $currentDate = clone $firstDayOfMonth;
        while ($currentDate <= $lastDayOfMonth) {
            $datesInMonth[] = $currentDate->format('Y-m-d');
            $currentDate->modify('+1 day');
        }

        // Fetch attendance data for the selected date range and group it by user ID and date
        $absen = DB::table('presensisiswa')
            ->select('id_siswa', 'tgl_presensi', 'jam_masuk', 'jam_keluar')
            ->whereIn('tgl_presensi', $datesInMonth)
            ->get();

        $groupedAbsen = [];
        foreach ($absen as $attendance) {
            $userId = $attendance->id_siswa;
            $date = $attendance->tgl_presensi;

            if (!isset($groupedAbsen[$userId])) {
                $groupedAbsen[$userId] = [];
            }

            $groupedAbsen[$userId][$date] = $attendance;
        }
        return view('admin.rekap_absen.rekap_absen_siswa', compact('users', 'groupedAbsen', 'datesInMonth', 'startDate', 'endDate'));
    }
}
