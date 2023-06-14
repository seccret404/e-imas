@extends('layout.admin.dash')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">

                </div>
                <h2 class="page-title">
                    Email ke Guru
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
                            <form class="card" action="/admin/kirim-guru" method="POST">
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
                                <label class="form-label">Judul</label>
                                <input class="form-control" type="text" name="judul">

                                <label class="form-label">Body</label>
                                <input class="form-control" type="text" name="body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="form-gorup">
                                                <div class="form-label">Nama Guru</div>

                                                 <select name="email" id="kode_dept" class="form-select tomselected ">
                                                    <option value="">Pilih Email</option>
                                                     @foreach ($guru as $item)
                                                    <option {{Request('nama')== $item->nama ? 'selected' : ''}}
                                                        value="{{$item->email}}">{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
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
