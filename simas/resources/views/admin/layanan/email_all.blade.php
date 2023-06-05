@extends('layout.admin.dash')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Email
                </div>
                <h2 class="page-title">
                    Email Kesemua siswa
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


                        <div class="col-12">
                            <form class="card" action="/admin/kirim-pesan" method="POST">
                                @csrf 
                              <div class="card-header">
                                <h3 class="card-title">Layanan Pesan</h3>
                              </div>
                              <div class="card-body">
                                <div class="mb-3">
                                  <div class="row">
                                    <div class="col">
                                      <div class="mb-3">
                                        <label class="form-label">Dari:</label>
                                        <input class="form-control" value="{{Auth::user()->email}}" disabled>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kirim Pesan Untuk:</label>
                                    <div class="btn-group w-50" role="group">
                                      <input type="radio" class="btn-check" name="tujuan" value="guru" id="btn-radio-dropdown-1" autocomplete="off" checked="">
                                      <label for="btn-radio-dropdown-1" type="button" class="btn">Guru</label>
                                      <input type="radio" class="btn-check" name="tujuan" value="siswa" id="btn-radio-dropdown-2" autocomplete="off">
                                      <label for="btn-radio-dropdown-2" type="button" class="btn">Siswa</label>

                                    </div>
                                  </div>
                                <div class="mb-3">
                                  <label class="form-label">Pesan</label>
                                  <textarea class="form-control text-muted" name="pesan" rows="5" placeholder="Ketikkan pesan..."></textarea>
                                </div>

                              <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Kirim Pesan</button>
                              </div>
                            </form>
                          </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('myscript')

@endpush
