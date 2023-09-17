@extends('layout.siswa.dash')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <a href="/ujian-siswa"><strong>Ujian</strong></a>/submision
                    </div>
                    <h2 class="page-title">

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
            </div>
            <div class="col-12">
                {{-- <form class="card" action="/upload-tugas" method="POST">
                    @csrf


 --}}

                <div class="card-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Judul</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <h3>Tanggal Terkirim</h3>
                                        </div>
                                        <div class="col-8">
                                            <h3>{{ $item->created_at ?? 'Ujian belum di submit' }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-4">
                                <h3>Dedline Ujian</h3>
                            </div>
                            <div class="col-8">
                                <h3>{{ $item->dedline }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-4">
                                <h3>File Ujian</h3>
                            </div>
                            <div class="col-8">
                                @if ($item->file_hasil_ujian)
                                    <img src="{{ url('asset/hasil/' . $item->file_hasil_ujian) }}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center ">
                    <button class="btn btn-primary" style="color: white;"><a href="{{ url('/ujian-siswa') }}" style="color: white; text-decoration: none;">Kembali</a></button>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('myscript')
    <script></script>
@endpush
