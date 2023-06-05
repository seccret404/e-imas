@extends('layout.siswa.dash')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                   Diskusi
                </div>
                <h2 class="page-title">
                    {{$hari}},{{$tgl}}
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
                            <div class="col">
                                {{-- <p>id="tambah_departemen"</p> --}}
                                <a href="#" class="btn "><svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-user" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>{{$forum->nama_penanya}}

                                </a>
                            </div>
                        </div>
                        <!--form-->

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card-body">
                                    <h3 id="tabler-free-license">{{$forum->judul}}</h3>
                                    <span class="text-muted small">{{$forum->nama_matapelajaran}}</span>
                                    <h3 id="tabler-free-license">{{$forum->pertanyaan}}
                                    </h3>
                                    <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                        style="background-image: url({{  url('asset/forum/'.$forum->gambar) }})">
                                    </div>
                                    <br>
                                    <h3 id="tabler-free-license ">Deskripsi</h3>
                                    <p>{{$forum->deskripsi}}</p>
                                    <div class="hr-text "><b>Jawaban</b></div>
                                    <div class="row">
                                        <div class="col">
                                            <a href="#" class="btn btn-primary" id="tambah_departemen">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-lamp-2" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 21h9"></path>
                                                    <path d="M10 21l-7 -8l8.5 -5.5"></path>
                                                    <path
                                                        d="M13 14c-2.148 -2.148 -2.148 -5.852 0 -8c2.088 -2.088 5.842 -1.972 8 0l-8 8z">
                                                    </path>
                                                    <path
                                                        d="M11.742 7.574l-1.156 -1.156a2 2 0 0 1 2.828 -2.829l1.144 1.144">
                                                    </path>
                                                    <path
                                                        d="M15.5 12l.208 .274a2.527 2.527 0 0 0 3.556 0c.939 -.933 .98 -2.42 .122 -3.4l-.366 -.369">
                                                    </path>
                                                </svg>Jawab </a>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="col">
                                        <div class="card-body ps-0">
                                            <div class="row">
                                                @foreach ($jawab as $item)


                                                <div class="col-6 mt-4">

                                                    <span><svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-user" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2">
                                                            </path>
                                                        </svg></span> <span class="text-muted ">{{$item->nama_penjawab}}</span>

                                                    <p class="mt-2">{{$item->jawaban}}</p>
                                                    @if ($item->gambar != null)
                                                        <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                                        style="background-image: url({{  url('asset/jawaban/'.$item->gambar) }})">
                                                    </div>

                                                    @else
                                                        <div class="img-responsive img-responsive-3x1 rounded-3 border">
                                                        <p>No image</p>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                    <div class="col-md">


                                                    </div>
                                                    <div class="col-md-auto">
                                                        <div class="mt-3 badges">

                                                            @auth
                                                            @if (Auth::user()->id == $item->id_user)
                                                            <form action="{{ route('jawaban.destroy', $item->id_j) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                            </form>
                                                             @else

                                                            @endif

                                                        @endauth
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>



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
                <h5 class="modal-title">Tambah Jawaban</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/jawaban-add" enctype="multipart/form-data" method="POST" id="form_departemen">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Jawaban <span
                                        class="form-label-description">1/100</span></label>
                                <textarea class="form-control" name="jawaban" rows="6" placeholder="Content.."
                                    style="height: 157px;">
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-label">Gambar</div>
                                <input type="text" name="id_q" hidden value="{{$forum->id_q}}">
                                <input type="file" class="form-control" name="gambar">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary w-100" type="submit">Kirim Jawaban</button>
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
