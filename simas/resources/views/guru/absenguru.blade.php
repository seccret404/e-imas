@extends('layout.guru.dash')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">

                    </div>
                    <h2 class="page-title">
                        Data Absensi
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
                                    <a href="/absenguru" class="btn btn-primary" id="tambah_departemen"><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-clipboard-list" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                            </path>
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                            </path>
                                            <path d="M9 12l.01 0"></path>
                                            <path d="M13 12l2 0"></path>
                                            <path d="M9 16l.01 0"></path>
                                            <path d="M13 16l2 0"></path>
                                        </svg>Absens</a>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <table class="table table-bordered">
                                    <div class="col-12">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Dates in Month</th>
                                                <th>Absen Masuk</th>
                                                <th>Absensi Keluar</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($absenWithDates as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item['tgl_presensi'] }}</td>
                                                    <td>{{ $item['jam_masuk'] ?? 'Belum Absen Masuk' }}</td>
                                                    <td>
                                                        @if ($item['jam_masuk'])
                                                            @if (isset($item['jam_keluar']))
                                                                @if ($item['jam_keluar'] > '14:00:00')
                                                                    <button class="btn wbtn-danger"
                                                                        disabled>{{ $item['jam_keluar'] }}</button>
                                                                @else
                                                                    <button class="btn btn-success"
                                                                        disabled>{{ $item['jam_keluar'] }}</button>
                                                                @endif
                                                            @else
                                                                <button class="btn btn-warning">Belum Absen Pulang</button>
                                                                <form action="update-absen-guru/{{ $item['id'] }}" 
                                                                    method="post">
                                                                    @csrf
                                                                    <div class="row text-center">
                                                                        <div class="col">
                                                                            <button type="submit"
                                                                                class="btn btn-primary btn-block"
                                                                                style="width: 100%">
                                                                                <ion-icon name="camera-outline"></ion-icon>
                                                                                Absen Pulang
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                        @else
                                                        @endif
                                                    </td>

                                                    <td>{{ $item['status'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>


                                    </div>
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
    {{-- modal edit --}}

    {{-- modal add --}}
@endsection

@push('myscript')
    <script>
        $(function() {
            $("#tambah_departemen").click(function() {
                $("#modal_departemen").modal("show");


            });
            $(".deletecom").click(function(e) {
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
                        title: 'Nama Prestasi Harus Diisi',
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
