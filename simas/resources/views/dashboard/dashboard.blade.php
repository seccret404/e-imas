@extends('layout.presensi')
@section('content')
<div id="appCapsule">
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                @if (Auth::guard('karyawan')->user()->gambar)
                @php
                    $path = Storage::url('uploads/karyawan/'. Auth::guard('karyawan')->user()->gambar);

                @endphp
                <img src="{{url($path)}}" alt="avatar" class="imaged w64 " style="height:78px">
                @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64">

                @endif
            </div>
            <div id="user-info">
                <h2 id="user-name">{{Auth::guard('karyawan')->user()->nama_lengkap}}</h2>
                <span id="user-role">{{Auth::guard('karyawan')->user()->jabatan}}</span>
            </div>
        </div>
    </div>
    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/editprofile" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/izin" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/histori" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/create" class="orange" style="font-size: 40px;">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Lokasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                @if ($masuk != null)
                                @php
                                    $path = Storage::url('uploads/absensi/'. $masuk->foto_in);

                                @endphp
                                        <img src="{{ url($path)}}" class="imaged w64 ">

                                    @else
                                    <ion-icon name="camera"></ion-icon>

                                @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $masuk != null ? $masuk->jam_in : 'Belum Absen'   }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($masuk != null && $masuk->jam_out != null)
                                    @php
                                        $path = Storage::url('uploads/absensi/'. $masuk->foto_out);

                                    @endphp
                                            <img src="{{ url($path)}}" class="imaged w64 ">

                                        @else
                                        <ion-icon name="camera"></ion-icon>

                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>{{ $masuk != null && $masuk->jam_out != null ? $masuk->jam_out : 'Belum Absen'   }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="presensi">
            <h3>Rekap Presensi Bulan {{$namabulan[$bulanini]}} Tahun {{$tahunini}}.</h3>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding:16px 12px !important">
                            <span class="badge bg-danger" style="position: absolute; top:3px;right:10px;font-size:0.6rem;x-index:999">{{$rekappresensi->jmlhhadir}}</span>
                            <ion-icon name="accessibility-outline" style="font-size: 1.6rem" class="text-primary"></ion-icon>
                            <br><span style="font-size: 0.8rem">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding:16px 12px !important">
                            @php

                            @endphp
                            <span class="badge bg-danger" style="position: absolute; top:3px;right:10px;font-size:0.6rem;x-index:999">{{$rekapizin->jmlhizin}}</span>
                            <ion-icon name="newspaper-outline" class="text-success"></ion-icon>
                            <br><span style="font-size: 0.8rem">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding:16px 12px !important">
                            <span class="badge bg-danger" style="position: absolute; top:3px;right:10px;font-size:0.6rem;x-index:999">{{$rekapizin->jumlahsakit}}</span>
                            <ion-icon name="medkit-outline" class="text-warning"></ion-icon>
                            <br><span style="font-size: 0.8rem" >Sakit</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding:16px 12px !important">
                            <span class="badge bg-danger" style="position: absolute; top:3px;right:10px;font-size:0.6rem;x-index:999">{{$rekappresensi->jmlhterlambat}}</span>
                            <ion-icon name="alarm-outline" class="text-danger"></ion-icon>
                           <br> <span style="font-size: 0.7rem">Terlambat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="rekappresence">
            <div id="chartdiv"></div>
            <!-- <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence primary">
                                    <ion-icon name="log-in"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Hadir</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence green">
                                    <ion-icon name="document-text"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Izin</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence warning">
                                    <ion-icon name="sad"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Sakit</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence danger">
                                    <ion-icon name="alarm"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Terlambat</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div> --}}
        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($histori_bulanan as $item)
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="finger-print-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>{{date("d-m-Y", strtotime($item->tgl_presensi))}}</div>

                                    <span class="badge badge-success">In: {{$item->jam_in}}</span>
                                    <span class="badge badge-danger">Out: {{$masuk != null && $item->jam_out != null ? $item->jam_out : 'Belum Absen'}}</span>

                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($rank as $lead)
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div><b>{{$lead->nama_lengkap}}</b> <br>
                                    <small class="text-muted">{{$lead->jabatan}}</small></div>
                                    <span class="badge {{$lead->jam_in < "11:00:00" ? "bg-success" : "bg-danger" }}">{{$lead->jam_in}}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach


                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
