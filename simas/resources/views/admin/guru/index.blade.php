@extends('layout.admin.dash')

@section('content')
    <style>
        input[type="search"] {
            width: 200px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                    </div>
                    <h2 class="page-title text-white">
                        Data Guru
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



                            <div class="row mt-4">
                                <table class="table table-bordered data-table display nowrap w-100" id="data">
                                    <div class="col-12">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Guru</th>
                                                <th>Gambar</th>
                                                <th>NIPDN</th>
                                                <th>alamat</th>
                                                <th>No Telepon</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($guru as $item)
                                                <tr class="text-center text-black">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td class="text-center"><a
                                                            href="{{ url('/asset/guru/' . $item->profil) }}"><img
                                                                src="{{ url('/asset/guru/' . $item->profil) }}"
                                                                width="100px" alt=""></a></td>
                                                    <td>{{ $item->npdn }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ $item->no_hp }}</td>
                                                    <td>
                                                        @if ($item->status == 'aktif')
                                                            <div class="btn btn-success" disable>
                                                                {{ $item->status }}
                                                            </div>
                                                        @else
                                                            <div class="btn btn-danger" disable>
                                                                {{ $item->status }}
                                                            </div>
                                                        @endif
                                                    </td>

                                                    <td class="text-center">
                                                        <div class="row text-center">
                                                            <div class="col text-center">
                                                                <a href="/guru/edit/{{ $item->id }}"
                                                                    class=" btn btn-primary">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-pencil-plus"
                                                                        width="24" height="24" viewBox="0 0 24 24"
                                                                        stroke-width="2" stroke="currentColor"
                                                                        fill="none" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none">
                                                                        </path>
                                                                        <path
                                                                            d="M8 20l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4h4z">
                                                                        </path>
                                                                        <path d="M13.5 6.5l4 4"></path>
                                                                        <path d="M16 18h4m-2 -2v4"></path>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                                @if ($item->status == 'aktif')
                                                                    <form action="/update-guru/{{ $item->id }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button class="btn btn-warning"
                                                                            type="submit">Nonaktifkan</button>
                                                                    </form>
                                                                @else
                                                                    <form action="/update-aktif-guru/{{ $item->id }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button class="btn btn-warning"
                                                                            type="submit">Aktifkan Kembali</button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <form method="POST"
                                                                    action="/guru/{{ $item->id }}/delete"
                                                                    class="">
                                                                    @csrf

                                                                    <a class="btn btn-danger deletecom">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="icon icon-tabler icon-tabler-trash"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" stroke-width="2"
                                                                            stroke="currentColor" fill="none"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z"
                                                                                fill="none">
                                                                            </path>
                                                                            <path d="M4 7l16 0"></path>
                                                                            <path d="M10 11l0 6"></path>
                                                                            <path d="M14 11l0 6"></path>
                                                                            <path
                                                                                d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                            </path>
                                                                            <path
                                                                                d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                                                            </path>
                                                                        </svg>
                                                                    </a>
                                                                </form>
                                                            </div>
                                                        </div>


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
                    <h5 class="modal-title">Tambah Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/guru-add" method="POST" id="form_departemen" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Nama Lengkap Guru</div>

                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="nama_guru" name="nama"
                                        class="form-control" placeholder="Nama Guru">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Tempat Lahir</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-map-pin-filled" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z"
                                                stroke-width="0" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="tempat_lahir" name="tempat_lahir"
                                        class="form-control" placeholder="Tempat Lahir">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Tanggal Lahir</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-calendar-due" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                    <input type="date" value="" id="nama_dept" name="tanggal_lahir"
                                        class="form-control" placeholder="BATAM....">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">NIPDN</div>

                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-lock-access" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>
                                            <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                                            <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-2"></path>
                                            <path
                                                d="M8 11m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z">
                                            </path>
                                            <path d="M10 11v-2a2 2 0 1 1 4 0v2"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="nama_dept" name="npdn"
                                        class="form-control" placeholder="NPDN">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Kode Guru</div>

                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-masks-theater" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M13.192 9h6.616a2 2 0 0 1 1.992 2.183l-.567 6.182a4 4 0 0 1 -3.983 3.635h-1.5a4 4 0 0 1 -3.983 -3.635l-.567 -6.182a2 2 0 0 1 1.992 -2.183z">
                                            </path>
                                            <path d="M15 13h.01"></path>
                                            <path d="M18 13h.01"></path>
                                            <path d="M15 16.5c1 .667 2 .667 3 0"></path>
                                            <path
                                                d="M8.632 15.982a4.037 4.037 0 0 1 -.382 .018h-1.5a4 4 0 0 1 -3.983 -3.635l-.567 -6.182a2 2 0 0 1 1.992 -2.183h6.616a2 2 0 0 1 2 2">
                                            </path>
                                            <path d="M6 8h.01"></path>
                                            <path d="M9 8h.01"></path>
                                            <path d="M6 12c.764 -.51 1.528 -.63 2.291 -.36"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="nama_dept" name="kode_guru"
                                        class="form-control" placeholder="inisial">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Alamat</div>

                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-home-search" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M21 12l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h4.7"></path>
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2"></path>
                                            <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                            <path d="M20.2 20.2l1.8 1.8"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="nama_dept" name="alamat"
                                        class="form-control" placeholder="Alamat">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">No Telepon</div>

                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-address-book" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z">
                                            </path>
                                            <path d="M10 16h6"></path>
                                            <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M4 8h3"></path>
                                            <path d="M4 12h3"></path>
                                            <path d="M4 16h3"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="nama_dept" name="no_hp"
                                        class="form-control" placeholder="no telepon">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Email</div>

                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-address-book" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-mail-plus" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5">
                                                </path>
                                                <path d="M16 19h6"></path>
                                                <path d="M19 16v6"></path>
                                                <path d="M3 7l9 6l9 -6"></path>
                                            </svg>
                                        </svg>
                                    </span>
                                    <input type="email" value="" id="nama_dept" name="email"
                                        class="form-control" placeholder="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="form-label">Jenis Kelamin</div>
                                    <div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                value="Laki-laki" checked="">
                                            <span class="form-check-label">Laki-laki</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                value="Perempuan">
                                            <span class="form-check-label">Perempuan</span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="form-label">Unggah Foto</div>
                                    <input type="file" id="unggah" class="form-control" name="profil">
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
        $(document).ready(function() {
            $('#data').DataTable({
                scrollX: true,
            });
        });

        $(function() {
            $("#tambah_departemen").click(function() {
                $("#modal_departemen").modal("show");


            });
            $(".deletecom").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Ingin menghapus data Guru ini!",
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
                            'Data Guru berhasil di hapus.',
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
                var nama_guru = $("#nama_guru").val();
                var tempat_lahir = $("#tempat_lahir").val();
                var nama_dept = $("#nama_dept").val();
                var unggah = $("#unggah").val();
                if (nama_guru == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Mohon isi Nama Guru',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#nama_guru").focus()
                    });;
                    return false;
                } else if (tempat_lahir == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Tempat lahir tidak boleh kosong',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#tempat_").focus()
                    });;
                    return false;
                } else if (nama_dept == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Ada kolom yang kosong!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#nama_dept").focus()
                    });;
                    return false;
                } 
                else if (unggah == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Ada kolom yang kosong!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#unggah").focus()
                    });;
                    return false;
                } 
            });

            var error = "{{ session('gagal') }}";
        if (error) {
            Swal.fire({
                icon: 'error',
                title: error,
                text: 'ganti dengan email lain'
            });
}
        })
    </script>
@endpush
