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
                                  <th><button class="table-sort" data-sort="sort-name">Mata Pelajaran</button></th>
                                  <th><button class="table-sort" data-sort="sort-city">Nilai</button></th>
                                  <th><button class="table-sort" data-sort="sort-type">Grade</button></th>

                                </tr>
                              </thead>
                              <tbody class="table-tbody">
                                @foreach ($hasil as $item)
                                <tr>
                                  <td class="sort-name">{{$item->mata_pelajaran}}</td>
                                  <td class="sort-city">{{$item->nilai}}</td>
                                  <td class="sort-type">
                                    @if ($item->nilai >= 80 )
                                        A
                                    @elseif($item->nilai <= 79 && $item->nilai >= 70)
                                        B
                                    @elseif($item->nilai <= 69 && $item->nilai >= 60)
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
