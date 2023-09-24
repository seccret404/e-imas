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
                        <a href="/mata-pelajaran"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>

                    </div>
                    <div class="modal-body">
                        <form action="{{url('pelajaran/edit/'.$pelajaran->id)}}"  method="POST" id="form_departemen">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user"
                                                with="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            </svg>
                                        </span>
                                        <input type="text" value="{{$pelajaran->nama_pelajaran}}" id="nama_dept" name="nama_pelajaran" class="form-control"
                                            placeholder="Nama Mata Pelajaran">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
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
@endpush
