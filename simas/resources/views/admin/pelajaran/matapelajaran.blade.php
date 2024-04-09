@extends('layout.admin.dash')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">

                    </div>
                    <h2 class="page-title text-white">
                        Mata Pelajaran
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

                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    @if (Session::get('error'))
                                        <div class="alert alert-danger">

                                            {{ Session::get('error') }}

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
                                        </svg>Tambah Data </a>
                                </div>
                            </div>



                            <div class="row mt-4">
                                <table class="table table-bordered data-table display nowrap w-100" id="data">
                                    <div class="col-12">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                <th>Kode Guru</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mapel as $item)
                                                <tr class="text-center text-white" style="background-color: #001C30">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_pelajaran }}</td>
                                                    <td>{{ $item->jurusan }}</td>
                                                    <td>{{ $item->kelas }}</td>
                                                    <td>{{ $item->kode_guru }}</td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col">
                                                                <form method="POST"
                                                                    action="/pelajaran/{{ $item->id }}/delete"
                                                                    class="">
                                                                    @csrf

                                                                    <a class="btn btn-danger deletecom">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="icon icon-tabler icon-tabler-trash"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" stroke-width="2"
                                                                            stroke="currentColor" fill="none"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z"
                                                                                fill="none">
                                                                            </path>
                                                                            <path d="M4 7l16 0"></path>
                                                                            <path d="M10 11l0 6"></path>
                                                                            <path d="M14 11l0 6"></path>
                                                                            <path
                                                                                d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                            </path>
                                                                            <path
                                                                                d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                                                            </path>
                                                                        </svg>
                                                                    </a>
                                                                </form>
                                                            </div>
                                                            <div class="col">
                                                                <a href="/pelajaran/edit/{{ $item->id }}"
                                                                    class=" btn btn-primary">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-pencil-plus"
                                                                        width="24" height="24" viewBox="0 0 24 24"
                                                                        stroke-width="2" stroke="currentColor"
                                                                        fill="none" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none">
                                                                        </path>
                                                                        <path
                                                                            d="M8 20l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4h4z">
                                                                        </path>
                                                                        <path d="M13.5 6.5l4 4"></path>
                                                                        <path d="M16 18h4m-2 -2v4"></path>
                                                                    </svg>
                                                                </a>
                                                            </div>

                                                        </div>



                                                    </td>


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

    {{-- modal add --}}
    <div class="modal modal-blur fade" id="modal_departemen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/matapelajaran-add" method="POST" id="form_departemen">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user"
                                            with="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="mata_pelajaran" name="nama_pelajaran"
                                        class="form-control" placeholder="Nama Mata Pelajaran">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-gorup">
                                    <div class="form-label">Kode Guru</div>
                                    <select name="kode_guru" id="kode_guru" class="form-select tomselected ">
                                        <option value="">masukkan kode</option>
                                        @foreach ($guru as $item)
                                            <option {{ Request('kode_guru') == $item->kode_guru ? 'selected' : '' }}
                                                value="{{ $item->kode_guru }}">{{ $item->kode_guru }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="form-label">Jurusan</div>
                                    <div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jurusan" value="IPA"
                                                checked="">
                                            <span class="form-check-label">IPA</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jurusan"
                                                value="IPS">
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
                                            <input class="form-check-input" type="radio" name="kelas" value="10"
                                                checked="">
                                            <span class="form-check-label">10</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="kelas"
                                                value="11">
                                            <span class="form-check-label">11</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="kelas"
                                                value="12">
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
                </div>

            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(document).ready(function() {
            $('#data').DataTable({
                scrollX: true,
            });
        });

        $(function() {
            $("#tambah_departemen").click(function() {
                $("#modal_departemen").modal("show");


            });
            $(document).ready(function() {
                $(document).on('click', '.deletecom', function(e) {
                    var form = $(this).closest('form');
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Ingin menghapus Mata Pelajaran ini!",
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
            });

            $(".edit").click(function() {
                var kode_dept = $(this).attr('kode_dept')
                $.ajax({
                    type: 'POST',
                    url: '/departemen/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_dept: kode_dept
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }

                })
                $("#modaledit_departemen").modal("show");


            });

            $("#form_departemen").submit(function() {
                var mata_pelajaran = $("#mata_pelajaran").val();
                var kode_guru = $("#kode_guru").val();
                if (mata_pelajaran == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Mata Pelajaran tidak boleh kosong !',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#mata_pelajaran").focus()
                    });;
                    return false;
                } else if (kode_guru == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Kode Guru harus di isi !',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#kode_guru").focus()
                    });;
                    return false;
                }
            });
        })
    </script>
@endpush
