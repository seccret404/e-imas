@extends('layout.guru.dash')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center text-white">
                <div class="col">
                    <div class="page-pretitle">
                        Hari ini
                    </div>
                    <h2 class="page-title">
                        {{ $hari }},{{ $tgl }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">

                    </div>
                    <h2 class="page-title text-white">
                        Data Jadwal Guru
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                @php
                    $colors = ['bg-primary', 'bg-danger', 'bg-success', 'bg-secondary', 'bg-warning', 'bg-info'];
                    $colorIndex = 0;
                @endphp

                @foreach ($jadwal as $item)
                    <div class="col-4">
                        <div class="card {{ $colors[$colorIndex] }}">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="h1 mb-2 text-white">{{ $item->kelas }} {{ $item->jurusan }}</div>
                                    <div class="ms-2 text-white">(RUANG {{ $item->nama_ruangan }})</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="text-white">{{ $item->hari }},
                                        {{ $item->jam_masuk }}-{{ $item->jam_selesai }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $colorIndex++;
                        if ($colorIndex >= count($colors)) {
                            $colorIndex = 0;
                        }
                    @endphp
                @endforeach

                <div class="col-12 mt-5">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row">
                                <h2 class="page-title text-black">
                                    Jadwal Keseluruhan
                                </h2>
                                <div class="row mt-4">
                                    <table class="table table-bordered">
                                        <div class="col-12">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Hari</th>
                                                    <th>Nama Pelajaran</th>
                                                    <th>Ruangan</th>
                                                    <th>Jam Masuk</th>
                                                    <th>Jam Selesai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allJadwal as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->hari }}</td>
                                                        <td>{{ $item->nama_pelajaran }}</td>
                                                        <td>
                                                            {{ $item->nama_ruangan }}</td>
                                                        </td>
                                                        <td>
                                                            {{ $item->jam_masuk }}</td>
                                                        </td>
                                                        <td>
                                                            {{ $item->jam_selesai }}</td>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
