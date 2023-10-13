@extends('layout.admin.dash')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Siswa
                </div>
                <h2 class="page-title">
                    Data Siswa

                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="modal modal-blur fade show" id="modal-large" tabindex="-1" role="dialog" aria-modal="true"
            style="display: block;">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <a href="/siswa"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/siswa/edit/'.$siswa->id)}}" method="POST" id="form_departemen">
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
                                        <input type="text" value="{{$siswa->nama}}" id="nama_dept" name="nama" class="form-control"
                                            placeholder="Nama siswa">
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
                                        <input type="text" value="{{$siswa->nisn}}" id="nisn" name="nisn" class="form-control"
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
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary w-100" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>


                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>








@endsection

@push('myscript')
<script>
            $("#form_departemen").submit(function() {
                var nama_dept = $("#nama_dept").val();
                var nisn = $("#nisn").val();
                if (nama_dept == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Ada data yang kosong!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#nama_dept").focus()
                    });;
                    return false;
                } 
                else if (nisn == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Ada data yang kosong!',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#nisn").focus()
                    });;
                    return false;
                } 
            });

            var error = "{{ session('existingnisn') }}";
        if (error) {
            Swal.fire({
                icon: 'error',
                title: 'error',
                text: error
            });
}
</script>


@endpush
