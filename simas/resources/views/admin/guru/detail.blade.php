@extends('layout.admin.dash')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Guru
                </div>
                <h2 class="page-title">
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
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="guru">NIPDN:</label>
                                    <input type="text" name="nama_departemen" class="form-control"
                                        placeholder="" value="{{$guru->npdn}}">
                                </div>
                            </div>
                            <div class="col-4"><div class="form-group">
                                <label for="guru">Nama Lengkap:</label>
                                <input type="text" name="nama_departemen" class="form-control"
                                    placeholder="" value="{{$guru->nama}}">
                            </div></div>
                            <div class="col-4"><div class="form-group">
                          <label for="guru">Jumlah Kehalian:</label>
                                <input type="text" name="nama_departemen" id="guru" class="form-control"
                                    placeholder="" value="oks">
                            </div></div>
                        </div>


                        <div class="row mt-4">
                            <table class="table table-bordered">
                                <div class="col-12">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Matapelajaran</th>
                                            <th>Jumlah Jam</th>
                                            <th>Jurusan</th>
                                            <th>Kelas</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                       @foreach ($pj as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->nama_pelajaran}}</td>
                                            <td>{{$item->jumlah_jam_masuk}}</td>

                                           {{-- <td>{{$item->jurusan}}</td>
                                            <td>{{$item->kelas}}</td> --}}

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
{{-- modal add --}}

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
