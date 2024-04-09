@extends('layout.siswa.dash')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <a href="/tugas-siswa"><strong>Tugas</strong></a>/submision
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
            <div class="col-12 card">
                <div class="card-body">
                    @if ($item && $item->file_hasil_tugas)
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
                                                <h3>{{ $item->created_at ?? 'Tugas belum di submit' }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h3>Dedline Tugas</h3>
                                </div>
                                <div class="col-8">
                                    <h3>{{ $item->dedline }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h3>File Tugas</h3>
                                </div>
                                <div class="col-8">
                                    @if ($item && $item->file_hasil_tugas)
                                        <img src="{{ url('asset/hasil/' . $item->file_hasil_tugas) }}">
                                    @else
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <h3>Tugas Belum di Submit</h3>
                    @endif
                </div>

                <div class="card-footer text-center ">
                    @if (!$item->dedline || !$item->nilai)
                        <a href="{{ url('upload/' . $item->id_tugas) }}" class="btn btn-primary">Ubah Jawaban</a>
                    @endif
                    <a href="{{ url('tugas-siswa') }}">
                        <button class="btn btn-primary">Kembali</button></a>
                    </a>
                </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@push('myscript')
    <script></script>
@endpush
