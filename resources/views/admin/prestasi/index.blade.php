@extends('layout.admin.dash')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">

                </div>
                <h2 class="page-title text-white">
                    Data Prestasi Siswa
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
                            <table class="table table-bordered data-table display nowrap w-100" id="data">
                                <div class="col-12">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Jumlah Prestasi</th>
                                            <th>Lihat</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                        @foreach ($prestasi as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{($item->nama_siswa)}}</td>
                                            <td>{{$item->jumlah_prestasi}}</td>
                                            <td>
                                                @php
                                                    $listPrestasi = DB::table('prestasi')
                                                    ->where('id_user', $item->id)
                                                    ->get();
                                                @endphp
                                                <ul>
                                                    @foreach ($listPrestasi as $prestasi)
                                                    <li> <a href="{{  url('asset/prestasi/'.$prestasi->file) }}">{{$prestasi->nama_prestasi}}</a>  </li>
                                                    @endforeach

                                                </ul>
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
<div class="modal modal-blur fade" id="modal_departemen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/ruangan-add" method="POST" id="form_departemen">
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
                                <input type="text" value="" id="nama_dept" name="nama_ruangan" class="form-control" placeholder="Nama Ruangan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
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
                                <input type="text" value="" id="nama_dept" name="kode_ruangan" class="form-control"
                                    placeholder="Kode Ruangan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-label">Status</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="1" checked="">
                                        <span class="form-check-label">Terpakai</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="0">
                                        <span class="form-check-label">Kosong</span>
                                    </label>

                                </div>
                            </div>
                        </div>
                    </div>

                  <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" data-bs-toggle="autosize" placeholder="Tambah keterangan" style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start; height: 55.3333px;"></textarea>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
