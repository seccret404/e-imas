@extends('layout.siswa.dash')

@section('content')


<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Jadwal Hari ini
                </div>
                <h2 class="page-title">
                    {{$hari}},{{$tgl}}
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">

        <div class="row">
            @if (Session::get('success'))

        <div class="alert alert-success">

            {{Session::get('success')}}
        </div>
        @endif
        @if (Session::get('error'))
        <div class="alert alert-danger">

            {{ Session::get('error')}}

        </div>
        @endif
            <div class="col-2">
                <a href="/absen" class="btn btn-primary" id="tambah_departemen"><svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                        </path>
                        <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                        <path d="M9 12l.01 0"></path>
                        <path d="M13 12l2 0"></path>
                        <path d="M9 16l.01 0"></path>
                        <path d="M13 16l2 0"></path>
                    </svg>Absens</a>
            </div>
            <div class="col-md-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-warning text-white avatar">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                        <path d="M10 12h4v4h-4z"></path>
                                     </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">

                                    Kelas
                                    <h2>{{Auth::user()->jurusan}}-{{Auth::user()->kelas}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                     </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                      Jumlah siswa
                                      <h2>{{$jmlhsiswa}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5"></path>
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                        <path d="M20.2 20.2l1.8 1.8"></path>
                                     </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                      Wali kelas
                                      @foreach ($namaWali as $item)
                                        <h3>{{$item->nama_guru}}</h3>
                                      @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
                <div class="col-9 ">
                    <table class="table table-bordered data-table display nowrap" id="data" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru Pengajar</th>
                            <th>Ruangan</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Status Absen</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama_pelajaran}}</td>
                            <td>{{$item->nama_guru}}</td>
                            <td>{{$item->nama_ruangan}}</td>
                            <td>{{$item->jam_masuk}}</td>
                            <td>{{$item->jam_selesai}}</td>
                            <td>{{$status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
           <div class="col-3 border " style="border:45px;border-color:black" >
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
</div>
</div>


@endsection

@push('myscript')
<script>
$(document).ready(function () {
        $('#data').DataTable({
            scrollX: true,
        });
    });
</script>
@endpush
