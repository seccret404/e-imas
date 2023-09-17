@extends('layout.admin.dash')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">

                    </div>
                    <h2 class="page-title text-white">
                        Data sekolah </h2>
                </div>
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title">Pengumuman</h3>
                                </div>
                                <div class="col-6">
                                    <span>
                                        <a href="#" class="btn btn-primary" id="tambah_departemen">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-plus" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 5l0 14"></path>
                                                <path d="M5 12l14 0"></path>
                                            </svg> Buat Pengumuman
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-header">
                            <h4 class="card-title">Kunjungan Website E-Simas</h4>
                        </div>
                        <table class="table card-table table-vcenter">
                            <tbody>
                                <tr>
                                    <td>E-SIMAS</td>
                                    <td>{{ session('visits', 0) }}</td>
                                    <td class="w-50">

                                    </td>
                                </tr>

                            </tbody>
                        </table> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"></path>
                                            <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $siswa }} Siswa
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-success text-white avatar">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
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
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">

                                        {{-- {{$rekappresensi->jmlhhadir}} Karyawan --}}
                                    </div>
                                    <div class="text-muted">
                                        {{ $guru }} Guru
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-user-check" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                            <path d="M15 19l2 2l4 -4"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $man }} Siswa Laki-laki
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-user-check" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                            <path d="M15 19l2 2l4 -4"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $woman }} Siswa Perempuan
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 mt-3">
                        {{-- bagian grafik --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Grafik Siswa</h3>
                                        <div id="chart-siswa" class="chart-lg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Grafik Guru</h3>
                                        <div id="chart-guru" class="chart-lg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title" style="display: inline-block; margin-right: 10px;">Grafik Absen Guru</h3>
                                        <a href="/rekap-absensi-guru">
                                            <button class="btn btn-primary" style="display: inline-block;">Lihat Detail</button>
                                        </a>
                                        <div id="chart-absenguru" class="chart-lg"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title" style="display: inline-block; margin-right: 10px;">Grafik Absen Siswa</h3>
                                        <a href="/rekap-absensi-siswa">
                                            <button class="btn btn-primary" style="display: inline-block;">Lihat Detail</button>
                                        </a>                                        <div id="chart-absensiswa" class="chart-lg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Grafik Surat Izin Guru</h3>
                                        <div id="chart-suratguru" class="chart-lg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Grafik Surat Izin Siswa</h3>
                                        <div id="chart-suratsiswa" class="chart-lg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 mt-3">
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
                        <div class="card">
                            <div class="card-header">

                                <h3>Pengumuman</h3>


                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter">
                                    @foreach ($pengumuman as $item)
                                        <thead>
                                            <tr>
                                                <th class="w-50">Judul</th>
                                                <th class="w-50">Catatan</th>
                                                <th>Lampiran File</th>
                                                <th>Aksi</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td class="w-50">
                                                    <p>{{ $item->judul }}</p>
                                                </td>
                                                <td class="w-50">
                                                    <p>{{ Str::words($item->info, 5, '....') }}</p>
                                                </td>
                                                <td class="text-nowrap">
                                                    @if($item->file != '-')
                                                        <p><a href="{{ url('asset/pengumuman/' . $item->file) }}">Lihat Lampiran File</a></p>
                                                    @else
                                                        <p>-</p>
                                                    @endif
                                                </td>
                                                

                                                <td>
                                                    <p>
                                                    <form method="POST"
                                                        action="/pengumuman/{{ $item->id_pengumuman }}/delete"
                                                        class="mt-2">
                                                        @csrf

                                                        <a class="btn btn-danger deletecom">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-trash" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path d="M4 7l16 0"></path>
                                                                <path d="M10 11l0 6"></path>
                                                                <path d="M14 11l0 6"></path>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                </path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg>
                                                        </a>
                                                    </form>
                                                    </p>
                                                </td>

                                            </tr>

                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>





            </div>

        </div>
    </div>
    </div>
    <div class="modal modal-blur fade" id="modal_departemen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/posting" method="POST" id="form_departemen" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">

                                    <label class="form-label">Judul</label>

                                    <input type="text" value="" id="nama_dept" name="judul"
                                        class="form-control" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Catatan</label>
                                    <textarea class="form-control" name="info" data-bs-toggle="autosize" placeholder=""
                                        style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start; height: 55.3333px;" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="form-label">Unggah File</div>
                                    <input type="file" class="form-control" name="file">
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
        });
    </script>

    <script>
        // @formatter:off
        var gender = <?php echo json_encode(array_values($gender)); ?>;
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-siswa'), {
                chart: {
                    type: "pie", // Ubah tipe grafik menjadi pie
                    fontFamily: 'inherit',
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false
                    }
                },
                labels: [
                    "Laki-laki", "Perempuan"
                ],
                series: gender,
                legend: {
                    show: true, // Ubah show menjadi true agar legend ditampilkan
                },
                colors: [tabler.getColor("blue", 0.8), tabler.getColor("red", 0.8), tabler.getColor(
                    "yellow", 0.8)],
                dataLabels: {
                    enabled: true, // Ubah enabled menjadi true agar data labels ditampilkan
                    formatter: function(val) {
                        return parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') +
                        " %"; // Ubah format data labels
                    }
                },
                tooltip: {
                    theme: 'dark'
                },
            })).render();
        });
        // @formatter:on
    </script>

    <script>
        // @formatter:off
        var genderguru = <?php echo json_encode(array_values($genderguru)); ?>;
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-guru'), {
                chart: {
                    type: "pie", // Ubah tipe grafik menjadi pie
                    fontFamily: 'inherit',
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false
                    }
                },
                labels: [
                    "Laki-laki", "Perempuan"
                ],
                series: genderguru,
                legend: {
                    show: true, // Ubah show menjadi true agar legend ditampilkan
                },
                colors: [tabler.getColor("blue", 0.8), tabler.getColor("red", 0.8), tabler.getColor(
                    "yellow", 0.8)],
                dataLabels: {
                    enabled: true, // Ubah enabled menjadi true agar data labels ditampilkan
                    formatter: function(val) {
                        return parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') +
                        " %"; // Ubah format data labels
                    }
                },
                tooltip: {
                    theme: 'dark'
                },
            })).render();
        });
        // @formatter:on
    </script>

    <script>
        // @formatter:off
        var suratizinguru = <?php echo json_encode(array_values($suratizinguru)); ?>;
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-suratguru'), {
                chart: {
                    type: "pie", // Ubah tipe grafik menjadi pie
                    fontFamily: 'inherit',
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false
                    }
                },
                labels: [
                    "Menunggu", "Disetujui", "Ditolak"
                ],
                series: suratizinguru,
                legend: {
                    show: true, // Ubah show menjadi true agar legend ditampilkan
                },
                colors: [tabler.getColor("blue", 0.8), tabler.getColor("red", 0.8), tabler.getColor(
                    "yellow", 0.8)],
                dataLabels: {
                    enabled: true, // Ubah enabled menjadi true agar data labels ditampilkan
                    formatter: function(val) {
                        return parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') +
                        " %"; // Ubah format data labels
                    }
                },
                tooltip: {
                    theme: 'dark'
                },
            })).render();
        });
        // @formatter:on
    </script>

    <script>
        // @formatter:off
        var suratizinsiswa = <?php echo json_encode(array_values($suratizinsiswa)); ?>;
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-suratsiswa'), {
                chart: {
                    type: "pie", // Ubah tipe grafik menjadi pie
                    fontFamily: 'inherit',
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false
                    }
                },
                labels: [
                    "Menunggu", "Disetujui", "Ditolak"
                ],
                series: suratizinsiswa,
                legend: {
                    show: true, // Ubah show menjadi true agar legend ditampilkan
                },
                colors: [tabler.getColor("blue", 0.8), tabler.getColor("red", 0.8), tabler.getColor(
                    "yellow", 0.8)],
                dataLabels: {
                    enabled: true, // Ubah enabled menjadi true agar data labels ditampilkan
                    formatter: function(val) {
                        return parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') +
                        " %"; // Ubah format data labels
                    }
                },
                tooltip: {
                    theme: 'dark'
                },
            })).render();
        });
        // @formatter:on
    </script>

    <script>
        // @formatter:off
        var absenguru = <?php echo json_encode(array_values($absenguru)); ?>;
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-absenguru'), {
                chart: {
                    type: "pie", // Ubah tipe grafik menjadi pie
                    fontFamily: 'inherit',
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false
                    }
                },
                labels: [
                    "Terlambat", "Sudah Absen", "Belum Absen"
                ],
                series: absenguru,
                legend: {
                    show: true, // Ubah show menjadi true agar legend ditampilkan
                },
                colors: [tabler.getColor("blue", 0.8), tabler.getColor("red", 0.8), tabler.getColor(
                    "yellow", 0.8)],
                dataLabels: {
                    enabled: true, // Ubah enabled menjadi true agar data labels ditampilkan
                    formatter: function(val) {
                        return parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') +
                        " %"; // Ubah format data labels
                    }
                },
                tooltip: {
                    theme: 'dark'
                },
            })).render();
        });
        // @formatter:on
    </script>

    <script>
        // @formatter:off
        var absensiswa = <?php echo json_encode(array_values($absensiswa)); ?>;
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-absensiswa'), {
                chart: {
                    type: "pie", // Ubah tipe grafik menjadi pie
                    fontFamily: 'inherit',
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false
                    }
                },
                labels: [
                    "Terlambat", "Sudah Absen", "Belum Absen"
                ],
                series: absensiswa,
                legend: {
                    show: true, // Ubah show menjadi true agar legend ditampilkan
                },
                colors: [tabler.getColor("blue", 0.8), tabler.getColor("red", 0.8), tabler.getColor(
                    "yellow", 0.8)],
                dataLabels: {
                    enabled: true, // Ubah enabled menjadi true agar data labels ditampilkan
                    formatter: function(val) {
                        return parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') +
                        " %"; // Ubah format data labels
                    }
                },
                tooltip: {
                    theme: 'dark'
                },
            })).render();
        });
        // @formatter:on
    </script>
@endpush
