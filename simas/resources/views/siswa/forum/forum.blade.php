@extends('layout.siswa.dash')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Forum Diskusi
                </div>
                <h2 class="page-title">
                    {{$hari}},{{$tgl}}
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
                                </svg>Buat Pertanyaan </a>
                        </div>
                    </div>
                  <!--form-->

                    <div class="row mt-5">
                        @foreach ($forum as $item)
                        <div class="col-md-4">
                            <div class="card-body shadow">
                                <h3 class="card-title">{{$item->judul}}</h3>
                                <span class="text-muted small">{{$item->nama_matapelajaran}}</span>
                                <div class="ratio ratio-16x9">
                                  <img src="{{  url('asset/forum/'.$item->gambar) }}" class="rounded object-cover" alt="Improve animation loader">
                                </div>
                                <div class="mt-4">
                                  <div class="row">
                                    <div class="col">
                                      <div class="avatar-list avatar-list-stacked">
                                        <span class="text-muted">{{$item->nama_penanya}}</span> <br>
                                        <span class="text-muted small">{{$item->created_at}}</span>
                                      </div>
                                    </div>
                                    <div class="col-auto text-muted">
                                    <a href="/jawaban-detail/{{$item->id_q}}">Lihat Pertanyaan</a><br>
                                    @auth
                                        @if (Auth::user()->id == $item->id_user)
                                        <form action="{{ route('posts.destroy', $item->id_q) }}" method="POST">
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
                        </div>
                        @endforeach
                        {{-- <div class="col-md-4">
                            <div class="card-body shadow">
                                <h3 class="card-title">Rumus Luas Segitiga</h3>
                                <span class="text-muted small">Matematika</span>
                                <div class="ratio ratio-16x9">
                                  <img src="tabler/static/projects/dashboard-2.png" class="rounded object-cover" alt="Improve animation loader">
                                </div>
                                <div class="mt-4">
                                  <div class="row">
                                    <div class="col">
                                      <div class="avatar-list avatar-list-stacked">
                                        <span class="text-muted">Edward Tua Panjaitan</span> <br>
                                        <span class="text-muted small">2023-05-24</span>
                                      </div>
                                    </div>
                                    <div class="col-auto text-muted">
                                    <a href="/jawaban-detail">Lihat Pertanyaan</a>
                                    </div>
                                    {{-- <div class="col-auto">
                                      <a href="#" class="link-muted"><!-- Download SVG icon from http://tabler-icons.io/i/message -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9h8"></path><path d="M8 13h6"></path><path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"></path></svg>
                                        6</a>
                                    </div>
                                    {{-- <div class="col-auto">
                                      <a href="#" class="link-muted"><!-- Download SVG icon from http://tabler-icons.io/i/share -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M8.7 10.7l6.6 -3.4"></path><path d="M8.7 13.3l6.6 3.4"></path></svg>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div> --}}

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
            <h5 class="modal-title">Tambah Pertanyaan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/pertanyaan-add" enctype="multipart/form-data"  method="POST" id="form_departemen">
                @csrf
                <div class="row">
                    <div class="col-12">

                        <div class="form-gorup">
                            <div class="form-label">Mata Pelajaran</div>

                             <select name="nama_pelajaran" id="mata_pelajaran" class="form-select tomselected ">
                                <option value="">masukkan pelajaran</option>
                                 @foreach ($pelajaran as $item)
                                <option {{Request('nama_pelajaran')== $item->nama_pelajaran ? 'selected' : ''}}
                                    value="{{$item->nama_pelajaran}}">{{$item->nama_pelajaran}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="form-label">Judul</div></div>
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-badge-cc" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                                    <path d="M10 10.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0"></path>
                                    <path d="M17 10.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0"></path>
                                 </svg>
                            </span>
                            <input type="text" value="" id="judul" name="judul" class="form-control"
                                placeholder="-----">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="form-label">Pertanyaan</div></div>
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-help-hexagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z"></path>
                                    <path d="M12 16v.01"></path>
                                    <path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483"></path>
                                 </svg>
                            </span>
                            <input type="text" value="" id="pertanyaan" name="pertanyaan" class="form-control"
                                placeholder="-----">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi <span class="form-label-description">56/100</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="6" placeholder="Content.." style="height: 157px;">
                                </textarea>
                          </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="form-label">Gambar</div>
                            <input type="file" class="form-control" id="gambar" name="gambar">
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
                 text: "Ingin menghapus pertanyaan ini!",
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
        var mata_pelajaran = $("#mata_pelajaran").val();
        var judul = $("judul").val();
        var pertanyaan = $("#pertanyaan").val();
        var deskripsi = $("#deskripsi").val();
        var gambar = $("#gambar").val();
        if (mata_pelajaran == "") {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Pilih Matapelajaran!',
                showConfirmButton: true,
                timer: 2000
            }).then((result) => {
                $("#mata_pelajaran").focus()
            });;
            return false;
        }else if (pertanyaan == "") {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Buat pertanyaan!',
                showConfirmButton: true,
                timer: 2000
            }).then((result) => {
                $("#pertanyaan").focus()
            });;
            return false;
        }else if (gambar == "") {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Pilih gambar!',
                showConfirmButton: true,
                timer: 2000
            }).then((result) => {
                $("#gambar").focus()
            });;
            return false;
        }
    });
})

</script>
@endpush
