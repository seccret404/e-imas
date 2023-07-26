@extends('layout.guru.dash')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Tugas
                    </div>
                    <h2 class="page-title">
                        Data Jawaban Tugas
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

                            <div class="row mt-4">
                                <table class="table table-bordered">
                                    <div class="col-12">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pelajaran</th>
                                                <th>Judul</th>
                                                <th>Deadline</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                {{-- <th>Jumlah Siswa Mengumpulkan</th> --}}
                                                <th>Siswa Mengumpulkan</th>
                                                <th>Siswa Belum Mengumpulkan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tugas as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_pelajaran }}</td>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ $item->dedline }}</td>
                                                    <td>{{ $item->jurusan }}</td>
                                                    <td>{{ $item->kelas }}</td>
                                                    <td>
                                                        @foreach ($jlhSudahMengumpul as $mengumpulkan)
                                                            @if ($mengumpulkan->id_tugas == $item->id_tugas)
                                                                {{ $mengumpulkan->jumlah_sudah_mengumpulkan }} orang
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if (isset($jlhBelumMengumpul[$item->id_tugas]))
                                                            {{ $jlhBelumMengumpul[$item->id_tugas] }} orang
                                                        @else
                                                            {{ $pengumpul->jumlah_pengumpul }} orang
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (isset($jlhSudahMengumpul[$item->id_tugas]) && $jlhSudahMengumpul[$item->id_tugas]->jumlah_sudah_mengumpulkan > 0)
                                                            <a href="#" class="btn btn-primary" readonly>
                                                                <p>Belum ada jawaban yang terkirim</p>
                                                            </a>
                                                        @else
                                                            <a href="{{ url('tugasguruall/' . $item->id_tugas) }}"
                                                                class="btn btn-primary">
                                                                <p>Detail Jawaban</p>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    {{-- <td>
                                                            <a href="{{ url('tugasguruall/' . $item->id_tugas) }}"
                                                                class="btn btn-primary">
                                                                <p>Detail Jawaban</p>
                                                            </a>
                                                    </td> --}}
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
    </div>
@endsection
