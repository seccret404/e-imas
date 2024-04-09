@extends('layout.guru.dash')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">

                    </div>
                    <h2 class="page-title text-white">
                        Surat Izin
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
                                        </svg>Tambah Surat Izin </a>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <table class="table table-bordered data-table display nowrap" id="data">
                                    <div class="col-12">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Guru</th>
                                                <th>Jenis Surat</th>
                                                <th>Keterangan Surat</th>
                                                <th>Keterangan Tambahan</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Berakhir</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($surat as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_request }}</td>
                                                    <td>{{ $item->jenis_surat }}</td>
                                                    <td>{{ $item->keterangan_surat }}</td>
                                                    <td><a href="{{ url('asset/surat/' . $item->keterangan_tambahan) }}"
                                                            target="_blank">
                                                            <img
                                                                src="{{ url('asset/surat/' . $item->keterangan_tambahan) }}"alt="{{ $item->keterangan_tambahan }}">
                                                        </a></td>
                                                    <td>{{ $item->waktu_mulai }}</td>
                                                    <td>{{ $item->waktu_berakhir }}</td>
                                                    <td>
                                                        @if ($item->status == '0')
                                                            <button class="btn btn-primary">Belum Dikonfirmasi</button>
                                                        @elseif($item->status == '1')
                                                            <button class="btn btn-success">Terkonfirmasi</button>
                                                        @else
                                                            <button class="btn btn-danger">Ditolak</button>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($item->status >= '1')
                                                        @else
                                                            <a href="/suratguru/edit/{{ $item->id }}"
                                                                class=" btn btn-primary"><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
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
                                                        @endif
                                                        <form method="POST" action="/suratguru/{{ $item->id }}/delete"
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
                    <h5 class="modal-title">Tambah Surat Izin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/suratguru-add" method="POST" id="form_departemen" enctype="multipart/form-data">
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
                                    <input type="text" value="{{ $nama }}" id="nama_guru" name="nama"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Jenis Surat</div>
                                <div class="input-icon mb-3">
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis"
                                            value="Surat Sakit" checked>
                                        <span class="form-check-label">Surat Sakit</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis"
                                            value="Surat Cuti">
                                        <span class="form-check-label">Surat Cuti</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis"
                                            value="Surat Izin">
                                        <span class="form-check-label">Surat Izin</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Keterangan Surat</div>

                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-file-description" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <path d="M9 17h6"></path>
                                            <path d="M9 13h6"></path>
                                        </svg>
                                    </span>
                                    <textarea id="kode_dept" name="keterangan" class="form-control" placeholder="Keterangan Surat"
                                        style="resize: vertical;"></textarea>
                                </div>
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
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <path d="M9 17h6"></path>
                                            <path d="M9 13h6"></path>
                                        </svg>
                                    </span>
                                    <input type="file" id="kode_dept" name="tambahan" class="form-control"
                                        placeholder="Keterangan Tambahan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Tanggal Mulai</div>
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
                                    <input type="date" value="" id="tanggal_mulai" name="mulai"
                                        class="form-control" placeholder="BATAM....">
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
                                    <input type="date" value="" id="tanggal_selesai" name="selesai"
                                        class="form-control" placeholder="BATAM....">
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
                    text: "Ingin menghapus surat izin ini!",
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
                            'success',
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
                var kode_dept = $("#kode_dept").val();
                var nama_dept = $("#nama_dept").val();
                var tanggal_mulai = $("#tanggal_mulai").val();
                var tanggal_selesai = $("#tanggal_selesai").val();

                if (nama_guru == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'harus di isi',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#nama_guru").focus()
                    });;
                    return false;
                } else if (kode_dept == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Keterangan surat harus di isi!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#kode_dept").focus()
                    });;
                    return false;
                } else if (tanggal_mulai == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Tanggal mulai harus di isi!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#tanggal_mulai").focus()
                    });;
                    return false;
                } else if (tanggal_selesai == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Tanggal selesai harus di isi!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#tanggal_selesai").focus()
                    });;
                    return false;
                }

            });
        })
    </script>
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
