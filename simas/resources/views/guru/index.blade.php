@extends('layout.guru.dash')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
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

                {{-- <div class="col-12">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="r0w">
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
                                                @foreach ($jadwal as $item)
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
                            <div class="row mt-5">
                                <div class="col border " style="border:45px;border-color:black" >
                                    <div class="card-body">
                                        <h3 class="card-title">Pengumuman</h3>
                                        <hr>
                                        <ul class="steps steps-vertical" style="padding:5px">
                                            @foreach ($pengumuman as $item)
                                             <li class="step-item">
                                                <div class="h4 m-0">{{$item->judul}}</div>
                                                <div class="text-muted">{{Str::words($item->info,4,'....')}}</div>
                                                <div class="div"><a href="/pengumuman/{{$item->id_pengumuman}}">Lihat</a></div>
                                            </li>
                                            @endforeach


                                        </ul>
                                      </div>
                                   </div>
                            </div>
                        </div>


                        <div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection


