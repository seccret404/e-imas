@extends('layout.siswa.dash')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                  Pengumuman
                </div>
                <h2 class="page-title">
                    Pengumuman

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
                        <h5 class="modal-title">Pengumuman</h5>
                        <p class="text-muted">{{$pengumuman->created_at}}</p>
                       <a href="/dashboard/siswa"> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                    </div>
                    <div class="modal-body">
                        <form id="form_departemen">
                            @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h3>{{$pengumuman->judul}}</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p class="text-muted">
                                            {{$pengumuman->info}}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{url('/asset/pengumuman/'.$pengumuman->file)}}">Lampiran File</a>
                                    </div>
                                </div>
                           <hr>
                           <p class="text-muted text-center">
                            &copy; Dinas Pendidikan
                           </p>
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
