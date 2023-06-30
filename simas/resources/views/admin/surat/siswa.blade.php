@extends('layout.admin.dash')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">

                </div>
                <h2 class="page-title text-white">
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


                        <div class="row mt-4 w-100">
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
