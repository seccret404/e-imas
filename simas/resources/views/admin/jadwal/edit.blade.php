@extends('layout.admin.dash')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Siswa
                    </div>
                    <h2 class="page-title">
                        Data Siswa

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
                            <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="btn-close" onclick="window.history.go(-1);"
                                aria-label="Close"></button>

                        </div>
                        <div class="modal-body">
                            <form action="{{ url('jadwal/edit/' . $siswa->id) }}" method="POST" id="form_departemen">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-gorup">
                                            <div class="form-label">Hari</div>

                                            <select name="hari" id="kode_dept" class="form-select tomselected">
                                                <option value="Monday" {{ $siswa->hari == 'Monday' ? 'selected' : '' }}>
                                                    Senin</option>
                                                <option value="Tuesday" {{ $siswa->hari == 'Tuesday' ? 'selected' : '' }}>
                                                    Selasa</option>
                                                <option value="Wednesday"
                                                    {{ $siswa->hari == 'Wednesday' ? 'selected' : '' }}>Rabu</option>
                                                <option value="Thursday" {{ $siswa->hari == 'Thursday' ? 'selected' : '' }}>
                                                    Kamis</option>
                                                <option value="Friday" {{ $siswa->hari == 'Friday' ? 'selected' : '' }}>
                                                    Jumat</option>
                                                <option value="Saturday" {{ $siswa->hari == 'Saturday' ? 'selected' : '' }}>
                                                    Sabtu</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-label">Mata Pelajaran</div>
                                            <select name="nama_pelajaran" id="nama_pelajaran"
                                                class="form-select tomselected">
                                                <option value="">Masukkan matapelajaran</option>
                                                @foreach ($mapel as $item)
                                                    @if ($siswa->kelas == $item->kelas && $siswa->jurusan == $item->jurusan)
                                                        <option
                                                            {{ $siswa->nama_pelajaran == $item->nama_pelajaran ? 'selected' : '' }}
                                                            value="{{ $item->nama_pelajaran }}"
                                                            data-kode-guru="{{ $item->kode_guru }}">
                                                            {{ $item->nama_pelajaran }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            <input type="hidden" name="kode_guru" id="kode_guru">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-gorup">
                                    <div class="form-label">Ruangan</div>

                                    <select name="ruangan" id="kode_dept" class="form-select tomselected ">
                                        <option value="">--</option>
                                        @foreach ($room as $item)
                                            <option
                                                {{ $siswa->ruangan == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-label">Jam Masuk</div>
                                            <div class="input-icon mb-3">
                                                <span class="input-icon-addon">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-alarm" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M12 10l0 3l2 0"></path>
                                                        <path d="M7 4l-2.75 2"></path>
                                                        <path d="M17 4l2.75 2"></path>
                                                    </svg>
                                                </span>
                                                <input type="time" value="{{ $siswa->jam_masuk }}" id="nama_dept"
                                                    name="jam_masuk" class="form-control" placeholder="Nama Mata Pelajaran">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-label">Jam Selesai</div>
                                            <div class="input-icon mb-3">
                                                <span class="input-icon-addon">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-alarm" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M12 10l0 3l2 0"></path>
                                                        <path d="M7 4l-2.75 2"></path>
                                                        <path d="M17 4l2.75 2"></path>
                                                    </svg>
                                                </span>
                                                <input type="time" value="{{ $siswa->jam_selesai }}" id="selesai"
                                                    name="jam_selesai" class="form-control"
                                                    placeholder="Nama Mata Pelajaran">
                                            </div>
                                        </div>
                                    </div>
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
