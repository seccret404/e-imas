@extends('layout.siswa.dash')

@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                  
                </div>
                <h2 class="page-title">

                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">

        <div class="row">
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

        <div class="col-12">
            <form class="card">
              <div class="card-header">
                <h3 class="card-title">My Profile</h3>
              </div>
              @foreach ($siswa as $item)
        <div class="card-body">
                <div class="mb-3">
                  <div class="row">
                    <div class="col-auto">
                      <span class="avatar avatar-md" style="background-image: url({{url('asset/profil/'.$item->profil)}});width:3cm;height:4cm;"></span>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label">{{$item->nama}}</label>
                        <label class="form-label text-muted">NISN: {{$item->nisn}}</label>
                        <label class="form-label text-muted">Jurusan: {{$item->jurusan}}</label>
                        <label class="form-label text-muted">NISN: {{$item->nisn}}</label>
                        <label class="form-label text-muted">Status: {{$item->status}}</label>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Alamat</label>
                  <input type="text" class="form-control" disabled value="{{$item->alamat}}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input class="form-control" disabled placeholder="your-email@domain.com" value="{{$item->email}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP siswa</label>
                    <input class="form-control" disabled placeholder="your-email@domain.com" value="{{$item->no_hp_siswa}}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nama Ibu Kandung</label>
                    <input class="form-control" disabled placeholder="your-email@domain.com" value="{{$item->nama_ibu_kandung}}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">No HP Wali</label>
                    <input class="form-control" disabled placeholder="your-email@domain.com" value="{{$item->no_hp_wali}}">
                  </div>

              </div>
              @endforeach

              {{-- <div class="card-footer text-end">
                <a href="#" class="btn btn-primary">
                  Save
                </a>
              </div> --}}
            </form>
          </div>
    </div>
</div>



@endsection

@push('myscript')
<script>

</script>
@endpush
