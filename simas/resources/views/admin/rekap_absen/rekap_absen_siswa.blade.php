@extends('layout.admin.dash')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">

                    </div>
                    <h2 class="page-title text-white">
                        Rekap Absensi Siswa
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <!-- Filter Card -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @if (Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if (Session::get('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('rekapabsensiswa') }}" method="GET">
                                <div class="form-row align-items-center" style="display: flex;">
                                    <div class="col-auto">
                                        <p style="margin-right: 50px;">PERIODE</p>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" class="form-control mb-2" id="start_date" name="start_date"
                                            value="{{ $startDate }}">
                                    </div>
                                    <div class="col-auto">
                                        <p style="margin-right: 10px; margin-left: 10px;"> s/d </p>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" class="form-control mb-2" id="end_date" name="end_date"
                                            value="{{ $endDate }}">
                                    </div>
                                </div>
                                <div class="form-row align-items-center" style="display: flex;">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>




                            <hr>
                            <div style="display: flex; align-items: center;">
                                <div style="display: flex; align-items: center; margin-right: 20px;">
                                    <h4 style="margin: 0;"><strong>M</strong></h4>
                                    <p style="margin: 0; margin-left: 5px;"> = Absen Masuk</p>
                                </div>
                                <div style="display: flex; align-items: center; margin-right: 20px;">
                                    <h4 style="margin: 0;"><strong>MT</strong></h4>
                                    <p style="margin: 0; margin-left: 5px;"> = Absen Masuk Terlambat</p>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <h4 style="margin: 0;"><strong>K</strong></h4>
                                    <p style="margin: 0; margin-left: 5px;"> = Komplit (Absen Masuk, Keluar)</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row mt-4">
                        <div style="overflow-y: auto; max-height: 400px;">
                            <table class="table table-bordered">
                                <div class="col-12">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            @foreach ($datesInMonth as $date)
                                                <th>{{ date('d-m', strtotime($date)) }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                @foreach ($datesInMonth as $date)
                                                    @php
                                                        $attendance = $groupedAbsen[$user->id][$date] ?? null;
                                                    @endphp
                                                    <td>
                                                        @if ($attendance)
                                                            @if ($attendance->jam_masuk !== null && $attendance->jam_keluar !== null)
                                                                K
                                                            @elseif($attendance->jam_masuk !== null && $attendance->jam_masuk >= '08:00:00')
                                                                MT
                                                            @elseif ($attendance->jam_keluar == null)
                                                                M
                                                            @else
                                                                Belum Absen
                                                            @endif
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
