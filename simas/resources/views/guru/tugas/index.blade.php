@extends('layout.guru.dash')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">

                    </div>
                    <h2 class="page-title text-white">
                        Data Tugas
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
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn btn-primary" id="tambah_departemen"><svg
                                            xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 5l0 14"></path>
                                            <path d="M5 12l14 0"></path>
                                        </svg>Tambah Tugas </a>
                                </div>
                            </div>
                            {{-- <div class="row mt-2">
                            <div class="col-12">
                                <form action="/departemen" method="get">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <input type="text" name="nama_departemen" class="form-control"
                                                    placeholder="Mata Pelajaran" value="{{Request('nama_departemen')}}">
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-search" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M21 21l-6 -6"></path>
                                                    </svg> Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div> --}}


                            <div class="row mt-4">
                                <table class="table table-bordered">
                                    <div class="col-12">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Matapelajaran</th>
                                                <th>Judul</th>
                                                <th>Dedline</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                <th>Lampiran File</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tugas_baru as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_pelajaran }}</td>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ $item->dedline }}</td>
                                                    <td>{{ $item->jurusan }}</td>
                                                    <td>{{ $item->kelas }}</td>
                                                    <td><a href="{{ url('asset/tugas/' . $item->file) }}"
                                                            alt="{{ $item->file }}">Lihat File</a></td>
                                                    <td>
                                                        <a href="/tugasguru/edit/{{ $item->id_tugas }}"
                                                            class=" btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-pencil-plus"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path
                                                                    d="M8 20l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4h4z">
                                                                </path>
                                                                <path d="M13.5 6.5l4 4"></path>
                                                                <path d="M16 18h4m-2 -2v4"></path>
                                                            </svg>
                                                        </a>

                                                        <form method="POST"
                                                            action="/tugasguru/{{ $item->id_tugas }}/delete"
                                                            class="mt-2">
                                                            @csrf

                                                            <a class="btn btn-danger deletecom">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="icon icon-tabler icon-tabler-trash"
                                                                    width="24" height="24" viewBox="0 0 24 24"
                                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                    </path>
                                                                    <path d="M4 7l16 0"></path>
                                                                    <path d="M10 11l0 6"></path>
                                                                    <path d="M14 11l0 6"></path>
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                    </path>
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        </form>
                                                    </td>


                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>


                        <div>
                            {{-- {{$departemen->links('vendor\pagination\bootstrap-5')}}</div> --}}
                        </div>
                    </div>
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
                            {{-- <div class="row mt-2">
                            <div class="col-12">
                                <form action="/departemen" method="get">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <input type="text" name="nama_departemen" class="form-control"
                                                    placeholder="Mata Pelajaran" value="{{Request('nama_departemen')}}">
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-search" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M21 21l-6 -6"></path>
                                                    </svg> Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div> --}}


                        <h3>Expired Deadlines</h3>
                            <div class="row mt-4">
                                <table class="table table-bordered">
                                    <div class="col-12">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Matapelajaran</th>
                                                <th>Judul</th>
                                                <th>Dedline</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                <th>Lampiran File</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tugas_lama as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_pelajaran }}</td>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ $item->dedline }}</td>
                                                    <td>{{ $item->jurusan }}</td>
                                                    <td>{{ $item->kelas }}</td>
                                                    <td><a href="{{ url('asset/tugas/' . $item->file) }}"
                                                            alt="{{ $item->file }}">Lihat File</a></td>
                                                    <td>
                                                        <a href="/tugasguru/edit/{{ $item->id_tugas }}"
                                                            class=" btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-pencil-plus"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path
                                                                    d="M8 20l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4h4z">
                                                                </path>
                                                                <path d="M13.5 6.5l4 4"></path>
                                                                <path d="M16 18h4m-2 -2v4"></path>
                                                            </svg>
                                                        </a>

                                                        <form method="POST"
                                                            action="/tugasguru/{{ $item->id_tugas }}/delete"
                                                            class="mt-2">
                                                            @csrf

                                                            <a class="btn btn-danger deletecom">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="icon icon-tabler icon-tabler-trash"
                                                                    width="24" height="24" viewBox="0 0 24 24"
                                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                    </path>
                                                                    <path d="M4 7l16 0"></path>
                                                                    <path d="M10 11l0 6"></path>
                                                                    <path d="M14 11l0 6"></path>
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                    </path>
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        </form>
                                                    </td>


                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>


                        <div>
                            {{-- {{$departemen->links('vendor\pagination\bootstrap-5')}}</div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
    <div class="modal modal-blur fade" id="modaledit_departemen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">

                </div>

            </div>
        </div>
    </div>
    {{-- modal add --}}
    <div class="modal modal-blur fade" id="modal_departemen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tugas Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/tugasguru-add" enctype="multipart/form-data" method="POST" id="form_departemen">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-gorup">
                                    <div class="form-label">Mata Pelajaran</div>

                                    <select name="nama_pelajaran" id="mata_pelajaran" class="form-select tomselected ">
                                        <option class="text-muted" id="" value="">Matapelajaran</option>
                                        @foreach ($mapel as $item)
                                            <option
                                                {{ Request('nama_pelajaran') == $item->nama_pelajaran ? 'selected' : '' }}
                                                value="{{ $item->nama_pelajaran }}">{{ $item->nama_pelajaran }}</option>
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
                                        <input type="text" value="" id="judul_tugas" name="judul"
                                            class="form-control" placeholder="Judul Tugas">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">File Tugas</div>
                            <input type="file" id="file_tugas" name="file" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Dedline</div>
                                <div class="input-icon mb-2">
                                    <input type="date" id="dedline" name="dedline" class="form-control "
                                        placeholder="Select a date" id="datepicker-icon" min="{{ date('Y-m-d') }}">
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
                                            <input class="form-check-input" type="radio" name="jurusan" value="IPA"
                                                checked="">
                                            <span class="form-check-label">IPA</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jurusan"
                                                value="IPS">
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
                                            <input class="form-check-input" type="radio" name="kelas" value="10"
                                                checked="">
                                            <span class="form-check-label">10</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="kelas"
                                                value="11">
                                            <span class="form-check-label">11</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="kelas"
                                                value="12">
                                            <span class="form-check-label">12</span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" data-bs-toggle="autosize"
                                placeholder="Tinggalkan catatan..."
                                style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start; height: 55.3333px;"></textarea>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-primary w-100" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $("#tambah_departemen").click(function() {
                $("#modal_departemen").modal("show");


            });
            $(".deletecom").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Ingin menghapus tugas ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(

                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
            $(".edit").click(function() {
                var kode_dept = $(this).attr('kode_dept')
                $.ajax({
                    type: 'POST',
                    url: '/departemen/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_dept: kode_dept
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }

                })
                $("#modaledit_departemen").modal("show");


            });

            $("#form_departemen").submit(function() {
                var mata_pelajaran = $("#mata_pelajaran").val();
                var judul_tugas = $("#judul_tugas").val();
                var file_tugas = $("#file_tugas").val();
                var dedline = $("#dedline").val();
                var catatan = $("#catatan").val();
                if (mata_pelajaran == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Mata Pelajaran harus di pilih!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#mata_pelajaran").focus()
                    });;
                    return false;
                } else if (judul_tugas == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Judul Tugas harus di isi!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#judul_tugas").focus()
                    });;
                    return false;
                } else if (file_tugas == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'File Tugas tidak boleh kosong!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#file_tugas").focus()
                    });;
                    return false;
                } else if (dedline == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Dedline harus di isi!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#dedline").focus()
                    });;
                    return false;
                } else if (catatan == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Buat catatan untuk melanjutkan!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#catatan").focus()
                    });;
                    return false;
                }
            });
        })
    </script>
@endpush
