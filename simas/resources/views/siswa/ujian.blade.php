@extends('layout.siswa.dash')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">

                    </div>
                    <h2 class="page-title">
                        {{ $hari }},{{ $tgl }}
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

                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::get('error'))
                    <div class="alert alert-danger">

                        {{ Session::get('error') }}

                    </div>
                @endif
                <div class="col">
                    <a href="/absen" class="btn btn-primary" id="tambah_departemen"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
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
            </div>
            <div class="row mt-2">
                <div class="col-3">
                    <div class="card" style="background-color: #1A5F7A">
                        <div class="card-body">
                            <p class="text-center text-white "><strong>Daftar Ujian</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card " style="height: 28rem;background-color:#57C5B6">
                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                            <div class="divide-y">
                                <div>
                                    @foreach ($ujian as $item)
                                        <div class="row mt-1">
                                            <div class="col-auto">
                                                <span class="avatar">JL</span>
                                            </div>
                                            <div class="col">
                                                <div class="">
                                                    <strong>{{ $item->jenis_ujian }}</strong> <i>info</i> <strong
                                                        class="text-primary"> {{ $item->judul }} </strong> Catatan :
                                                    {{ $item->catatan }}
                                                    <a href="{{ url('asset/ujian/' . $item->file) }}"
                                                        alt="{{ $item->file }}"><svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-eye" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                            <path
                                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                                            </path>
                                                        </svg>Lihat</a>
                                                </div>
                                                @php
                                                    $tanggalHariIni = now()->toDateString();
                                                    $deadline = $item->dedline;
                                                    $class =
                                                        $deadline > $tanggalHariIni ? 'text-primary' : 'text-danger';
                                                @endphp
                                                <div class="text-muted ">
                                                    <p class="{{ $class }}">Dedline : {{ $item->dedline }}</p>
                                                </div>
                                                <div class="text-muted ">
                                                    <p style="color: black">Tahun Akademik : {{ $item->tahun_akademik }}
                                                    </p>
                                                </div>
                                                @if ($item->nilai > 0)
                                                    <p><strong>Nilai : {{ $item->nilai }}</strong></p>
                                                @else
                                                    @if ($item->uploaded == 1)
                                                        <p><strong><span class="btn btn-success readonly"
                                                                    style="cursor: default;">Submitted for
                                                                    grading</span></strong></p>
                                                    @else
                                                        <a href="/uploadujian/{{ $item->id }}" class="btn btn-primary"
                                                            id="tambah_departemen"><svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-plus" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path d="M12 5l0 14"></path>
                                                                <path d="M5 12l14 0"></path>
                                                            </svg>Kirim Ujian</a>
                                                    @endif
                                                @endif
                                                {{-- <a href="{{ route('hasil-ujian.view', ['id' => $item->id]) }}"
                                                    class="btn btn-primary">View</a> --}}
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="badge bg-primary"></div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('myscript')
    <script></script>
@endpush
