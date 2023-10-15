@extends('layout.guru.dash')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Guru
                    </div>
                    <h2 class="page-title">
                        Tugas

                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="modal modal-blur fade show" id="modal-large" tabindex="-1" role="dialog" aria-modal="true"
                style="display: block;">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Tugas</h5>
                            <a href="/tugasguru"><button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button></a>

                        </div>
                        <div class="modal-body">
                            <form action="{{ '/tugasguru/edit/' . $tugas->id_tugas }}" method="POST" id="form_departemen" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-label">Mata Pelajaran</div>

                                            <select name="nama_pelajaran" id="nama_pelajaran"
                                                class="form-select tomselected">
                                                <option class="text-muted" value="">Pilih Matapelajaran</option>
                                                @foreach ($mapel as $item)
                                                    <option
                                                        {{ $tugas->nama_pelajaran == $item->nama_pelajaran ? 'selected' : '' }}
                                                        value="{{ $item->nama_pelajaran }}">
                                                        {{ $item->nama_pelajaran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-label">Judul Tugas</div>
                                            <div class="input-icon mb-3">
                                                <span class="input-icon-addon">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-id-badge-2" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 12h3v4h-3z"></path>
                                                        <path
                                                            d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6">
                                                        </path>
                                                        <path
                                                            d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z">
                                                        </path>
                                                        <path d="M14 16h2"></path>
                                                        <path d="M14 12h4"></path>
                                                    </svg>
                                                </span>
                                                <input type="text" value="{{ $tugas->judul }}" id="nama_dept"
                                                    name="judul" class="form-control" placeholder="Judul Tugas">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">File Tugas</div>
                                    <p>File Before : <a href="{{ url('asset/tugas/' . $tugas->file) }}"
                                            alt="{{ $tugas->file }}">{{ $tugas->file }}</a></p>
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-label">Dedline</div>
                                        <div class="input-icon mb-2">
                                            <input type="date" name="dedline" class="form-control "
                                                placeholder="Select a date" id="datepicker-icon"
                                                value="{{ $tugas->dedline }}" min="{{ date('Y-m-d') }}">
                                            <span class="input-icon-addon">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-label">Jurusan</div>
                                            <div>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jurusan"
                                                        value="IPA" {{ $tugas->jurusan == 'IPA' ? 'checked' : '' }}>
                                                    <span class="form-check-label">IPA</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jurusan"
                                                        value="IPS" {{ $tugas->jurusan == 'IPS' ? 'checked' : '' }}>
                                                    <span class="form-check-label">IPS</span>
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-label">Kelas</div>
                                            <div>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="kelas"
                                                        value="10" {{ $tugas->kelas == '10' ? 'checked' : '' }}>
                                                    <span class="form-check-label">10</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="kelas"
                                                        value="11" {{ $tugas->kelas == '11' ? 'checked' : '' }}>
                                                    <span class="form-check-label">11</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="kelas"
                                                        value="12" {{ $tugas->kelas == '12' ? 'checked' : '' }}>
                                                    <span class="form-check-label">12</span>
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Catatan</label>
                                    <textarea class="form-control" name="catatan" data-bs-toggle="autosize" placeholder="Tinggalkan catatan..."
                                        style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start; height: 55.3333px;">{{ $tugas->catatan }}</textarea>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary w-100" type="submit">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
@endpush
