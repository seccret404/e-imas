@extends('layout.admin.dash')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                </div>
                <h2 class="page-title text-white">
                    Data Tahun Akademik
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">       <div class="row">
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
                  <!--form-->


                    <div class="row mt-4">
                        <table class="table table-bordered">
                            <div class="col-12">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tahun Akademik</th>
                                        <th>Nama Tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($akademik as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->tahun}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>

                                             <form method="POST" action="/akademik/{{$item->id}}/delete" class="mt-2">
                                                @csrf

                                                <a class="btn btn-danger deletecom" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 7l16 0"></path>
                                                        <path d="M10 11l0 6"></path>
                                                        <path d="M14 11l0 6"></path>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
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
{{--modal edit --}}
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
            <h5 class="modal-title">Tambah Data Akademik</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/akademik-add"  method="POST" id="form_departemen">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="form-label">Tahun Akademik</div></div>
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-stats" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4"></path>
                                    <path d="M18 14v4h4"></path>
                                    <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M15 3v4"></path>
                                    <path d="M7 3v4"></path>
                                    <path d="M3 11h16"></path>
                                 </svg>
                            </span>
                            <input type="text" value="" id="nama_dept" name="tahun" class="form-control"
                                placeholder="2023/2024">
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="form-label">Semester</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nama" value="Ganjil" checked="">
                                    <span class="form-check-label">Ganjil</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nama" value="Genap">
                                    <span class="form-check-label">Genap</span>
                                </label>

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
        </div>

    </div>
</div>
</div>
@endsection

@push('myscript')
<script>
$(function () {
    $("#tambah_departemen").click(function () {
        $("#modal_departemen").modal("show");


    });
    $(".deletecom").click(function(e){
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
            type:'POST'
            , url:'/departemen/edit'
            ,cache:false
            ,data:{
                _token: "{{ csrf_token() }}"
                ,kode_dept:kode_dept
            },
            success:function(respond){
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
                title: 'Tidak boleh data kosong!',
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
                title: 'Tidak boleh data kosong!',
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
