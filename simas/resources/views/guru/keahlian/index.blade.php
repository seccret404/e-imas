@extends('layout.guru.dash')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">

                    </div>
                    <h2 class="page-title text-white">
                        Data Kehlian
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
                                        </svg>Tambah Data </a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">

                                </div>
                            </div>


                            <div class="row mt-4">
                                <table class="table table-bordered">
                                    <div class="col-12">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Keahlian</th>
                                                <th>Lampiran File</th>
                                                <th>Catatan</th>
                                                <th>Tanggal Upload</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($keahlian as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_keahlian }}</td>
                                                    <td><a href="{{ url('asset/keahlian/' . $item->file) }}"
                                                            alt="{{ $item->file }}">Lihat File</a></td>
                                                    <td>{{ $item->catatan }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>
                                                        <a href="/keahlian/edit/{{ $item->id }}"
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
                                                            </svg> </a>

                                                        <form method="POST" action="/keahlian/{{ $item->id }}/delete"
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

    {{-- modal add --}}
    <div class="modal modal-blur fade" id="modal_departemen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Keahlian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/keahlian-add" enctype="multipart/form-data" method="POST" id="form_departemen">
                        @csrf
                        <div class="row">
                            <div class="col-12"> <label class="form-label required">Nama Keahlian</label>
                                <div class="input-icon mb-3">


                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-award-filled" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M19.496 13.983l1.966 3.406a1.001 1.001 0 0 1 -.705 1.488l-.113 .011l-.112 -.001l-2.933 -.19l-1.303 2.636a1.001 1.001 0 0 1 -1.608 .26l-.082 -.094l-.072 -.11l-1.968 -3.407a8.994 8.994 0 0 0 6.93 -3.999z"
                                                stroke-width="0" fill="currentColor"></path>
                                            <path
                                                d="M11.43 17.982l-1.966 3.408a1.001 1.001 0 0 1 -1.622 .157l-.076 -.1l-.064 -.114l-1.304 -2.635l-2.931 .19a1.001 1.001 0 0 1 -1.022 -1.29l.04 -.107l.05 -.1l1.968 -3.409a8.994 8.994 0 0 0 6.927 4.001z"
                                                stroke-width="0" fill="currentColor"></path>
                                            <path
                                                d="M12 2l.24 .004a7 7 0 0 1 6.76 6.996l-.003 .193l-.007 .192l-.018 .245l-.026 .242l-.024 .178a6.985 6.985 0 0 1 -.317 1.268l-.116 .308l-.153 .348a7.001 7.001 0 0 1 -12.688 -.028l-.13 -.297l-.052 -.133l-.08 -.217l-.095 -.294a6.96 6.96 0 0 1 -.093 -.344l-.06 -.271l-.049 -.271l-.02 -.139l-.039 -.323l-.024 -.365l-.006 -.292a7 7 0 0 1 6.76 -6.996l.24 -.004z"
                                                stroke-width="0" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="nama_keahlian" name="nama_keahlian"
                                        class="form-control" placeholder="Nama Keahlian">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <label class="form-label required">File Keahlian</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-cloud-upload" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1">
                                            </path>
                                            <path d="M9 15l3 -3l3 3"></path>
                                            <path d="M12 12l0 9"></path>
                                        </svg>
                                    </span>
                                    <input type="file" value="" id="nama_dept" name="file" required
                                        class="form-control" placeholder="Nama Keahlian">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required">Catatan Keahlian</label>
                                    <textarea class="form-control" id="catatan_keahlian" data-bs-toggle="autosize" name="catatan" placeholder="Buat Catatan…"
                                        style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start; height: 55.3333px;"></textarea>
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
                    text: "Ingin menghapus data keahlian ini!",
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
                            'Your data has been deleted.',
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
                var nama_keahlian = $("#nama_keahlian").val();
                var catatan_keahlian = $("#catatan_keahlian").val();
                if (nama_keahlian == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Isi Nama Keahlian!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#nik").focus()
                    });;
                    return false;
                } else if (catatan_keahlian == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Isi Catatan Keahlian!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#kode_dept").focus()
                    });;
                    return false;
                }
            });
        })
    </script>
@endpush
