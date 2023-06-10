@extends('layout.admin.dash')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">

                </div>
                <h2 class="page-title">
                   Surat Masuk Siswa
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

                                    {{Session::get('success')}}
                                </div>
                                @endif
                                @if (Session::get('error'))
                                <div class="alert alert-danger">

                                    {{ Session::get('error')}}

                                </div>
                                @endif
                            </div>
                        </div>


                        <div class="row mt-4">
                            <table class="table table-bordered data-table display nowrap" id="data" height="100%">
                                <div class="col-12">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Jenis Surat</th>
                                            <th>Keterangan Surat</th>
                                            <th>Keterangan Tambahan</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal berakhir</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ssiswa as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->nama_request}}</td>
                                            <td>{{$item->jenis_surat}}</td>
                                            <td>{{$item->keterangan_surat}}</td>
                                            <td>{{$item->keterangan_tambahan}}</td>
                                            <td>{{$item->waktu_mulai}}</td>
                                            <td>{{$item->waktu_berakhir}}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                <form action="/konfirmasi-izin/{{$item->id}}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-primary w-80">Konfirmasi</button>
                                                </form>
                                                <form action="/konfirmasi-tolak/{{$item->id}}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger w-90">Tolak</button>
                                                </form>
                                                    @elseif($item->status == 2)
                                                    <button class="btn btn-danger" disabled>Ditolak</button>
                                                 @else
                                                    <button disabled class="btn btn-success">Terkonfirmasi</button>
                                                @endif
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

{{-- modal add --}}
{{-- <div class="modal modal-blur fade" id="modal_departemen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/siswa-add" method="POST" id="form_departemen" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
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
                                <input type="text" value="" id="nama_dept" name="nama" class="form-control"
                                    placeholder="Nama siswa">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-label">Tempat Lahir</div>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z" stroke-width="0" fill="currentColor"></path>
                                     </svg>
                                </span>
                                <input type="text" value="" id="nama_dept" name="tempat_lahir" class="form-control"
                                    placeholder="Tempat Lahir">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-label">Tanggal Lahir</div>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-due" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                     </svg>
                                </span>
                                <input type="date" value="" id="nama_dept" name="tanggal_lahir" class="form-control"
                                    placeholder="BATAM....">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-label">No HP Siswa</div>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                        <path d="M15 6h6m-3 -3v6"></path>
                                     </svg>
                                </span>
                                <input type="text" value="" id="nama_dept" name="no_hp_siswa" class="form-control"
                                    placeholder="No HP Siswa">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-label">Email</div>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"></path>
                                        <path d="M3 7l9 6l9 -6"></path>
                                        <path d="M15 19l2 2l4 -4"></path>
                                     </svg>
                                </span>
                                <input type="email" value="" id="nama_dept" name="email" class="form-control"
                                    placeholder="Email siswa">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-label">Alamat</div>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z" stroke-width="0" fill="currentColor"></path>
                                     </svg>
                                </span>
                                <input type="text" value="" id="nama_dept" name="alamat" class="form-control"
                                    placeholder="Alamat....">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-label">Ibu Kandung</div>
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
                                <input type="text" value="" id="nama_dept" name="nama_ibu_kandung" class="form-control"
                                    placeholder="Nama ibu kandung">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-label">No HP Ibu Kandung</div>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                        <path d="M15 6h6m-3 -3v6"></path>
                                     </svg>
                                </span>
                                <input type="text" value="" id="nama_dept" name="no_hp_wali" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-label">NISN</div>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-aspect-ratio-filled" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M19 4h-14a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3h14a3 3 0 0 0 3 -3v-10a3 3 0 0 0 -3 -3zm-10 3a1 1 0 0 1 .117 1.993l-.117 .007h-2v2a1 1 0 0 1 -.883 .993l-.117 .007a1 1 0 0 1 -.993 -.883l-.007 -.117v-3a1 1 0 0 1 .883 -.993l.117 -.007h3zm9 5a1 1 0 0 1 .993 .883l.007 .117v3a1 1 0 0 1 -.883 .993l-.117 .007h-3a1 1 0 0 1 -.117 -1.993l.117 -.007h2v-2a1 1 0 0 1 .883 -.993l.117 -.007z"
                                            stroke-width="0" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <input type="text" value="" id="nama_dept" name="nisn" class="form-control"
                                    placeholder="NISN">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-label">Jenis Kelamin</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki" checked="">
                                        <span class="form-check-label">Laki-laki</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan">
                                        <span class="form-check-label">Perempuan</span>
                                    </label>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-label">Jurusan</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jurusan" value="IPA" checked="">
                                        <span class="form-check-label">IPA</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jurusan" value="IPS">
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
                                        <input class="form-check-input" type="radio" name="kelas" value="10" checked="">
                                        <span class="form-check-label">10</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kelas" value="11">
                                        <span class="form-check-label">11</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kelas" value="12">
                                        <span class="form-check-label">12</span>
                                    </label>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-label">Unggah Foto</div>
                                <input type="file" class="form-control" name="profil">
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
</div> --}}
@endsection

@push('myscript')
<script>
    $(document).ready(function () {
        $('#data').DataTable({
            scrollX: true,
        });
    });
    $(function () {
        $("#tambah_departemen").click(function () {
            $("#modal_departemen").modal("show");


        });
        $(".deletecom").click(function (e) {
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Ingin menghapus data ini!",
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
        $(".edit").click(function () {
            var kode_dept = $(this).attr('kode_dept')
            $.ajax({
                type: 'POST',
                url: '/departemen/edit',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    kode_dept: kode_dept
                },
                success: function (respond) {
                    $("#loadeditform").html(respond);
                }

            })
            $("#modaledit_departemen").modal("show");


        });

        $("#form_departemen").submit(function () {
            var kode_dept = $("#kode_dept").val();
            var nama_dept = $("#nama_dept").val();
            if (kode_dept == "") {
                Swal.fire({
                    position: 'top-center',
                    icon: 'warning',
                    title: 'Kode Departemen Harus Diisi',
                    showConfirmButton: true,
                    timer: 2000
                }).then((result) => {
                    $("#nik").focus()
                });;
                return false;
            } else if (nama_dept == "") {
                Swal.fire({
                    position: 'top-center',
                    icon: 'warning',
                    title: 'Nama Departemen Harus Diisi',
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
