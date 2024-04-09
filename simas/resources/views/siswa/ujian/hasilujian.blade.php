@extends('layout.siswa.dash')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">

                    </div>
                    <h2 class="page-title">
                        {{ $hari }},{{ $tgl }}
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

                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::get('error'))
                    <div class="alert alert-danger">

                        {{ Session::get('error') }}

                    </div>
                @endif

            </div>
            <div class="row mt-2">
                <div class="col-3">
                    <div class="card" style="background-color: #1A5F7A">
                        <div class="card-body">
                            <p class="text-center text-white "><strong>Hasil Ujian</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="table-default" class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><button class="table-sort" data-sort="sort-name">Mata Pelajaran</button>
                                            </th>
                                            <th><button class="table-sort" data-sort="sort-city">Nilai Tugas</button></th>
                                            <th><button class="table-sort" data-sort="sort-city">Nilai Ulangan</button></th>
                                            <th><button class="table-sort" data-sort="sort-city">Nilai UTS</button></th>
                                            <th><button class="table-sort" data-sort="sort-city">Nilai UAS</button></th>
                                            <th><button class="table-sort" data-sort="sort-type">Hasil Akhir</button></th>
                                            <th><button class="table-sort" data-sort="sort-type">Grade</button></th>

                                        </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                        @foreach ($hasil as $item)
                                            <tr>
                                                <td class="sort-name">{{ $item->mata_pelajaran }}</td>
                                                <td class="sort-city">
                                                    {{ number_format(floatval($item->nilai_tugas ?? 0), 2) }}</td>
                                                <td class="sort-city">
                                                    {{ number_format(floatval($item->nilai_ulangan ?? 0), 2) }}</td>
                                                <td class="sort-city">
                                                    {{ number_format(floatval($item->nilai_uts ?? 0), 2) }}</td>
                                                <td class="sort-city">
                                                    {{ number_format(floatval($item->nilai_uas ?? 0), 2) }}</td>

                                                <td class="sort-type">
                                                    @php
                                                        // $nilai_ulangan = $item->nilai_ulangan
                                                        //     ? $item->nilai_ulangan
                                                        //     : 0;
                                                        $hasilAkhir =
                                                            (($item->nilai_tugas ?? 0) +
                                                                ($item->nilai_ulangan ?? 0) +
                                                                ($item->nilai_uts ?? 0) +
                                                                ($item->nilai_uas ?? 0)) /
                                                            4;
                                                        $hasilAkhirFormatted = number_format($hasilAkhir, 2);
                                                    @endphp
                                                    {{ $hasilAkhirFormatted }}
                                                </td>
                                                <td class="sort-city">
                                                    @if ($hasilAkhir >= 80)
                                                        A
                                                    @elseif ($hasilAkhir <= 79 && $hasilAkhir >= 70)
                                                        B
                                                    @elseif ($hasilAkhir <= 69 && $hasilAkhir >= 60)
                                                        C
                                                    @else
                                                        D
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('myscript')
    <script></script>
@endpush
