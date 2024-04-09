@extends('layout.guru.dash')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Siswa
                    </div>
                    <h2 class="page-title">
                        Surat Izin

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
                            <h5 class="modal-title">Edit Surat Izin</h5>
                            <a href="/suratguru"><button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button></a>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/suratguru/edit/' . $surat->id) }}" method="POST" id="form_departemen"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-label">Nama Lengkap Siswa</div>

                                        <div class="input-icon mb-3">
                                            <span class="input-icon-addon">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-user" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                                </svg>
                                            </span>
                                            <input type="text" value="{{ $surat->nama_request }}" id="nama_dept"
                                                name="nama" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-label">Jenis Surat</div>
                                        <div class="input-icon mb-3">
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis"
                                                    value="Surat Sakit"
                                                    {{ $surat->jenis_surat == 'Surat Sakit' ? 'checked' : '' }}>
                                                <span class="form-check-label">Surat Sakit</span>
                                            </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis"
                                                    value="Surat Cuti"
                                                    {{ $surat->jenis_surat == 'Surat Cuti' ? 'checked' : '' }}>
                                                <span class="form-check-label">Surat Cuti</span>
                                            </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis"
                                                    value="Surat Cuti"
                                                    {{ $surat->jenis_surat == 'Surat Izin' ? 'checked' : '' }}>
                                                <span class="form-check-label">Surat Izin</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-label">Keterangan Surat</div>
                                            <div class="input-icon mb-3">
                                                <span class="input-icon-addon">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-file-description" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                        <path
                                                            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                        </path>
                                                        <path d="M9 17h6"></path>
                                                        <path d="M9 13h6"></path>
                                                    </svg>
                                                </span>
                                                <textarea id="nama_dept" name="keterangan" class="form-control" style="resize: vertical;" required>{{ $surat->keterangan_surat }}</textarea>
                                            </div>
                                        </div>
                                        @error('keterangan')
                                            <div class="alert alert-danger">Masukkan keterangan yang valid</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-label">Keterangan Tambahan</div>

                                        <div class="input-icon mb-3">
                                            <span class="input-icon-addon">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-file-description" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                    <path
                                                        d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                    </path>
                                                    <path d="M9 17h6"></path>
                                                    <path d="M9 13h6"></path>
                                                </svg>
                                            </span>
                                            <input type="file" id="nama_dept" name="tambahan" class="form-control"
                                                placeholder="Keterangan Tambahan"></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-label">Tanggal Mulai</div>
                                        <div class="input-icon mb-3">
                                            <span class="input-icon-addon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-calendar-due" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                                                    </path>
                                                    <path d="M16 3v4"></path>
                                                    <path d="M8 3v4"></path>
                                                    <path d="M4 11h16"></path>
                                                    <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                </svg>
                                            </span>
                                            <input type="date" value="{{ $surat->waktu_mulai }}" id="tanggal_mulai"
                                                name="mulai" class="form-control" placeholder=""
                                                min="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-label">Tanggal Selesai</div>
                                        <div class="input-icon mb-3">
                                            <span class="input-icon-addon">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-calendar-due" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                                                    </path>
                                                    <path d="M16 3v4"></path>
                                                    <path d="M8 3v4"></path>
                                                    <path d="M4 11h16"></path>
                                                    <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                </svg>
                                            </span>
                                            <input type="date" value="{{ $surat->waktu_berakhir }}"
                                                id="tanggal_selesai" name="selesai" class="form-control" placeholder=""
                                                min="{{ date('Y-m-d') }}">
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
    <script>
        // Mengambil elemen input tanggal
        var tanggalMulaiInput = document.getElementById('tanggal_mulai');
        var tanggalSelesaiInput = document.getElementById('tanggal_selesai');

        // Mendapatkan tanggal hari ini
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;

        // Set nilai minimum pada input tanggal mulai
        tanggalMulaiInput.setAttribute('min', today);

        // Menambahkan event listener untuk memperbarui nilai minimum pada input tanggal selesai jika tanggal mulai berubah
        tanggalMulaiInput.addEventListener('change', function() {
            tanggalSelesaiInput.setAttribute('min', this.value);
        });
    </script>
@endpush
