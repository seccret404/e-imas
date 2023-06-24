@extends('layout.presensi')

@section('header')
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">E-Presensi</div>
    <div class="right"></div>
</div>
<style>
    .webcam, .webcam video{
        display: inline-block;
        width: 70% !important;

        border-radius: 15px;
        margin-top:-40px;


    }
    #map { height: 300px;width: 600px }

</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>
@endsection

@section('content')
    <div class="row-container " style="margin-top: 70px">
        <div class="col-12 text-center">
            @if (Session::get('warning'))
                                    <div class="alert alert-warning">

                                            {{Session::get('warning')}}
                                    </div>
                                @endif

        <form action="presensi/store/guru" method="post">
            @csrf
            <input type="text" hidden  name="lokasiin"  id="lokasiin">
            <input type="text"hidden name="lokasion" id="lokasion">
            <div class="row">
            <div class="col-6">
                 <div class="webcam" >

            </div>
        </div>
            <div class="col-6">
                <div id="map">
                </div>
            </div>

        </div>

    </div>
    <div class="row text-center">
        <div class="col">

            <button type="submit" class="btn btn-primary btn-block" style="width: 30%">
                <ion-icon name="camera-outline"></ion-icon>
                Absen Masuk
            </button>
    </div>
    </div>
    {{-- <div class="row mt-2 justify-content-center">
        <div class="col-6 mb-5">
            <div id="map">
            </div>
        </div>

    </div> --}}
</form>

    <audio id="notifikasi_in">
    <source src="{{ asset('assets/sound/notifikasi_in.mp3')}}" type="audio/mpeg">
</audio>
<audio id="notifikasi_out">
    <source src="{{ asset('assets/sound/notifikasi_out.mp3')}}">
</audio>
@endsection


@push('myscript')
<script>
    var notifikasi_in = document.getElementById('notifikasi_in');
    var notifikasi_out = document.getElementById('notifikasi_out');

    Webcam.set({
        height:480,
        width:400,
        image_format:'jpeg',
        jpeg_quality:80

    });

    Webcam.attach('.webcam');

    var lokasi1 = document.getElementById('lokasiin');
    var lokasi2 = document.getElementById('lokasion');

    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

    }

    function successCallback(position){
    lokasi1.value = position.coords.latitude;
    lokasi2.value = position.coords.longitude
    var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 25,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
    var circle = L.circle([2.379135,99.151415 ], {
    color: 'red',
    fillColor: '#f04',
    fillOpacity: 0.5,
    radius: 1000
        }).addTo(map);
    }
    function errorCallback(){


    }
</script>

@endpush
