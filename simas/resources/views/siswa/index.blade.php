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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-award-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M19.496 13.983l1.966 3.406a1.001 1.001 0 0 1 -.705 1.488l-.113 .011l-.112 -.001l-2.933 -.19l-1.303 2.636a1.001 1.001 0 0 1 -1.608 .26l-.082 -.094l-.072 -.11l-1.968 -3.407a8.994 8.994 0 0 0 6.93 -3.999z" stroke-width="0" fill="currentColor"></path>
                                        <path d="M11.43 17.982l-1.966 3.408a1.001 1.001 0 0 1 -1.622 .157l-.076 -.1l-.064 -.114l-1.304 -2.635l-2.931 .19a1.001 1.001 0 0 1 -1.022 -1.29l.04 -.107l.05 -.1l1.968 -3.409a8.994 8.994 0 0 0 6.927 4.001z" stroke-width="0" fill="currentColor"></path>
                                        <path d="M12 2l.24 .004a7 7 0 0 1 6.76 6.996l-.003 .193l-.007 .192l-.018 .245l-.026 .242l-.024 .178a6.985 6.985 0 0 1 -.317 1.268l-.116 .308l-.153 .348a7.001 7.001 0 0 1 -12.688 -.028l-.13 -.297l-.052 -.133l-.08 -.217l-.095 -.294a6.96 6.96 0 0 1 -.093 -.344l-.06 -.271l-.049 -.271l-.02 -.139l-.039 -.323l-.024 -.365l-.006 -.292a7 7 0 0 1 6.76 -6.996l.24 -.004z" stroke-width="0" fill="currentColor"></path>
                                     </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{$prestasi}} Prestasi
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notebook" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"></path>
                                        <path d="M13 8l2 0"></path>
                                        <path d="M13 12l2 0"></path>
                                     </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                       {{$mapel}} Mata Pelajaran
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
                <div class="col-8 ">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
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
                            <td>{{$item->jam_masuk}}</td>
                            <td>{{$item->jam_selesai}}</td>
                            <td>{{$status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
           <div class="col-4 border " style="border:45px;border-color:black" >
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

</script>
@endpush
