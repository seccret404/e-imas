<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="{{asset('tabler/dist/css/tabler.min.css?1674944402')}}" rel="stylesheet" />
    <link href="{{asset('tabler/dist/css/tabler-flags.min.css?1674944402')}}" rel="stylesheet" />
    <link href="{{asset('tabler/dist/css/tabler-payments.min.css?1674944402')}}" rel="stylesheet" />
    <link href="{{asset('tabler/dist/css/tabler-vendors.min.css?167494440')}}2" rel="stylesheet" />
    <link href="{{asset('tabler/dist/css/demo.min.css?1674944402')}}" rel="stylesheet" />
    <link href="{{asset('tabler/dist/css/wizard.css')}}" rel="stylesheet" />
</head>
<body>
    <div class="container bg-white mt-2 mb-4 " style="width: 700px">
    <div><br>
        <h1 class="mt-3">Form Pendaftaran Penerimaan Siswa Baru</h1>
        <div id="multi-step-form-container">
            <!-- Form Steps / Progress Bar -->
            <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                <!-- Step 1 -->
                <li class="form-stepper-active text-center form-stepper-list" step="1">
                    <a class="mx-2">
                        <span class="form-stepper-circle">
                            <span>1</span>
                        </span>
                        <div class="label">Data Pribadi</div>
                    </a>
                </li>
                <!-- Step 2 -->
                <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>2</span>
                        </span>
                        <div class="label text-muted">Data Sekolah</div>
                    </a>
                </li>

                <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>3</span>
                        </span>
                        <div class="label text-muted">Data Akhir</div>
                    </a>
                </li>

            </ul>
            <!-- Step Wise Form Content -->
            <form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST">
                <!-- Step 1 Content -->
                <section id="step-1" class="form-step">
                    {{-- <h2 class="font-normal">Account Basic Details</h2>
                    <!-- Step 1 input fields -->
                    <div class="mt-3">
                        Step 1 input fields goes here..
                    </div> --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <label class="form-label">Nama Lengkap</label>
                            <input type="text" value="" class="form-control" placeholder="Nama Lengkap">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                <input type="date" value="" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <label class="form-label">No Kartu Keluarga</label>
                                <input type="text" value="" class="form-control" placeholder="121200xx">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                <input type="text" value="" class="form-control" placeholder="Batamxx">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="form-label">Jenis Kelamin</div>
                                    <div>
                                    <label class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" checked="">
                                    <span class="form-check-label">Laki-laki</span>
                                  </label>
                                  <label class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin">
                                    <span class="form-check-label">Perempuan</span>
                                  </label>

                                </div>
                              </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <label class="form-label">Alamat Rumah</label>
                                <input type="text" value="" class="form-control" placeholder="Alamat...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <label class="form-label">RT/RW</label>
                                <input type="text" value="" class="form-control" placeholder="05">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <label class="form-label">Kecamatan</label>
                                    <select name="tahun" class="form-control">
                                        <option value="">Pilih Kecamatan</option>
                                        <option value="">Taliwang</option>
                                        <option value="">Seteluk</option>
                                        <option value="">Maluk</option>
                                        <option value="">Sekokang</option>

                                      </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <label class="form-label">No.Hp</label>
                                <input type="text" value="" class="form-control" placeholder="08..">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Upload Foto</label>
                                    <label for="images" class="drop-container">
                                        <input type="file" id="images" name="file" accept="image/*" required>
                                      </label>
                                </div>
                            </div>
                        </div>



                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="2">Lanjut</button>
                    </div>
                </section>
                <!-- Step 2 Content, default hidden on page load. -->
                <section id="step-2" class="form-step d-none">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <label class="form-label">Asal Sekolah</label>
                            <input type="text" value="" class="form-control" placeholder="Asal Sekolah">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <label class="form-label">Alamat Sekolah</label>
                            <input type="text" value="" class="form-control" placeholder="Jln.no.....">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <label class="form-label">Tahun Lulus</label>
                                <select name="tahun" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    <?php
                                      $tahunSekarang = date("Y");
                                      for ($tahun = $tahunSekarang; $tahun >= 2000; $tahun--) {
                                        echo "<option value='$tahun'>$tahun</option>";
                                      }
                                    ?>
                                  </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Upload Ijazah</label>
                                <label for="images" class="drop-container">
                                    <input type="file" id="images" name="file" accept="image/*" required>
                                  </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="1">Kembali</button>
                        <button class="button btn-navigate-form-step" type="button" step_number="3">Lanjut</button>

                    </div>
                </section>
                <!-- Step 3 Content, default hidden on page load. -->
                <section id="step-3" class="form-step d-none">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <p class="form-label text-muted">Apa bila siswa baru memiliki prestasi di sekolah sebelum nya, dapat melampirkan bukti berupa sertifikat pada form ini.</p>

                                <label class="form-label">Upload Prestasi</label>
                                <label for="images" class="drop-container">
                                    <input type="file" id="images" name="file" accept="image/*" required>
                                  </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="form-label">Jurusan Yang akan Di Pilih</div>
                                    <div>
                                    <label class="form-check">
                                    <input class="form-check-input" type="radio" name="jurusan" checked="">
                                    <span class="form-check-label">IPA</span>
                                  </label>
                                  <label class="form-check">
                                    <input class="form-check-input" type="radio" name="jurusan">
                                    <span class="form-check-label">IPS</span>
                                  </label>

                                 </div>
                                </div>
                            </div>
                        </div>
                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="2">Kembali</button>
                        <button class="button submit-btn" type="submit">Kirim</button>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

<script src="{{asset('tabler/dist/libs/apexcharts/dist/apexcharts.min.js?1674944402')}}" defer></script>
<script src="{{asset('tabler/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1674944402')}}" defer></script>
<script src="{{asset('tabler/dist/libs/jsvectormap/dist/maps/world.js?1674944402')}}" defer></script>
<script src="{{asset('tabler/dist/libs/jsvectormap/dist/maps/world-merc.js?1674944402')}}" defer></script>
<!-- Tabler Core -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{asset('tabler/dist/js/tabler.min.js?1674944402')}}" defer></script>
<script src="{{asset('tabler/dist/js/demo.min.js?1674944402')}}" defer></script>
<script src="{{asset('tabler/dist/js/wizard.js')}}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
crossorigin=""></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
</body>
</html>
