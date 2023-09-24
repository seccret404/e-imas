@extends('layout.guru.dash')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">

                    </div>
                    <h2 class="page-title text-white">
                        Data Jawaban Ujian
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
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

                            <div class="row mt-4  p-1">
                                <table class="table table-bordered">
                                    <div class="col-12">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori Ujian</th>
                                                <th>Judul</th>
                                                <th>Dedline</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                <th>Siswa Mengumpulkan</th>
                                                <th>Siswa Belum Mengumpulkan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ujian as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->jenis_ujian }}</td>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ $item->dedline }}</td>
                                                    <td>{{ $item->jurusan }}</td>
                                                    <td>{{ $item->kelas }}</td>
                                                    <td>
                                                        @php
                                                            $jumlahSudahMengumpulkan = 0;
                                                        @endphp
                                                        @foreach ($jlhSudahMengumpul as $mengumpulkan)
                                                            @if ($mengumpulkan->id == $item->id)
                                                                {{ $mengumpulkan->jumlah_sudah_mengumpulkan }} orang
                                                                @php
                                                                    $jumlahSudahMengumpulkan = $mengumpulkan->jumlah_sudah_mengumpulkan;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if (isset($jlhBelumMengumpul[$item->id]))
                                                            {{ $jlhBelumMengumpul[$item->id] }} orang
                                                        @else
                                                            {{ $pengumpul->jumlah_pengumpul }} orang
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($jumlahSudahMengumpulkan > 0)
                                                            <a href="{{ url('ujianguruall/' . $item->id) }}"
                                                                class="btn btn-primary">
                                                                <p>Detail Jawaban</p>
                                                            </a>
                                                        @else
                                                            <a href="#" class="btn btn-primary" readonly>
                                                                <p>0 orang pengumpul</p>
                                                            </a>
                                                        @endif

                                                    </td>


                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection