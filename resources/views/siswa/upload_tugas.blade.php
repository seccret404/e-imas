@extends('layout.siswa.dash')

@section('content')
<style>
    .drop-container {
  position: relative;
  display: flex;
  gap: 10px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 200px;
  padding: 20px;
  border-radius: 10px;
  border: 2px dashed #555;
  color: #444;
  cursor: pointer;
  transition: background .2s ease-in-out, border .2s ease-in-out;
}

.drop-container:hover {
  background: #eee;
  border-color: #111;
}

.drop-container:hover .drop-title {
  color: #222;
}

.drop-title {
  color: #444;
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  transition: color .2s ease-in-out;
}
</style>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Upload Tugas
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
            <form  action="/upload-tugas" method="POST" enctype="multipart/form-data" >
                @csrf
              <div class="card-header">
                <h1 class="card-title" style="font-size: 1cm">{{$tugas->nama_pelajaran}}</h1>
                <input type="text" value="{{$tugas->nama_pelajaran}}"  name="nama_pelajaran" hidden>
                <input type="text" hidden name="id_tugas" id="" value="{{$tugas->id_tugas}}">
                <input type="text" hidden name="dedline" value="{{$tugas->dedline}}">
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <div class="row mt-5">
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input class="form-control" readonly type="text" disabled value="{{$tugas->judul}}" style="border:none">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Catatan</label>
                  <textarea class="form-control"style="border:none"    disabled  readonly rows="5">{{$tugas->catatan}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="images" class="drop-container">
                        <span class="drop-title">Drop files here</span>
                        or
                        <input type="file" id="images" name="file" accept="image/*" required>
                      </label>
                </div>
              </div>
              <div class="card-footer text-center ">
               <button class="btn btn-primary" type="submit">Kirim Tugas</button>
                </a>
              </div>
            </form>
          </div>

    </div>
</div>


@endsection

@push('myscript')
<script>

</script>
@endpush
