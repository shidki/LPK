<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dasbor Siswa</title>
    <script src="https://kit.fontawesome.com/8183c3e7b3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('edit_profile/style.css')}}">
</head>
<body>
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
          <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"  href="/halamanDashboard" >kembali</a>
            <!-- Form -->
            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
              <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center">
                    <div class="media-body ml-2 d-none d-lg-block">
                      <span class="mb-0 text-sm  font-weight-bold">{{ $siswa->nama }}</span>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="height: 200px; background-image: url({{asset('Login/img/gedung.png')}}); background-size: cover; background-position: center top;">
          <!-- Mask -->
          <span class="mask bg-gradient-default opacity-8"></span>
          <!-- Header container -->
          <div class="container-fluid d-flex align-items-center">
            <div class="row">
              
            </div>
          </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
          <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
              <div class="card card-profile shadow">
                <div class="row justify-content-center">
                  <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                      <a href="#">
                        <img src="{{ asset('edit_profile/img/profile.webp')}}" class="rounded-circle">
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                  {{-- <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                    <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                  </div> --}}
                </div>
                <div class="card-body pt-0 pt-md-4">
                  <div class="row">
                    <div class="col">
                      <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                        <div>
                          <span class="heading">Status</span>
                          <span class="description" style="text-transform: uppercase">{{ $siswa->status}}</span>
                        </div>
                        {{--<div>
                          <span class="heading">89</span>
                          <span class="description">Rata-Rata Nilai</span>
                        </div>--}}
                      </div>
                    </div>
                  </div>
                  {{--<div class="text-center">
                    <h3>
                      {{ $siswa->nama }}
                    </h3>
                    <div class="h5 font-weight-300" style="text-transform: capitalize;">
                      <i class="ni location_pin mr-2"></i>Bidang {{ $siswa->nama_bidang }}
                    </div>
                    <div class="h5 mt-4" style="text-transform: capitalize;">
                      <i class="ni business_briefcase-24 mr-2" ></i>Kelas {{ $siswa->nama_kelas }}
                    </div>
                    <div>
                      <i class="ni education_hat mr-2"></i>{{ $siswa->no_hp }}
                    </div>
                    <hr class="my-4">
                    <p>{{ $siswa->alamat }}</p>
                  </div>--}}
                </div>
              </div>
            </div>
            <div class="col-xl-8 order-xl-1">
              <form action="/edit_siswa" method="post">
                @csrf
                <div class="card bg-secondary shadow">
                  <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h3 class="mb-0">Profil</h3>
                      </div>
                      <div class="col-4 text-right">
                        <button type="submit" id="btn_submit" class="btn btn-info">Ubah Profil</button>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                      <h6 class="heading-small text-muted mb-4">Informasi Profil</h6>
                      <div class="pl-lg-4">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group focused">
                              <label class="form-control-label" for="input-username">Nama</label>
                              <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Masukkan Nama" disabled value="{{ $siswa->nama }}">
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-email">Email</label>
                              <input type="email" name="email" id="input-email" class="form-control form-control-alternative" value="{{ $siswa->email }}" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group focused">
                              <label class="form-control-label" for="input-first-name">No Telp</label>
                              <input type="text" id="no_hp" name="no_hp" id="input-first-name" class="form-control form-control-alternative" placeholder="Masukkan No hp" value="{{ $siswa->no_hp }}">
                              <div id="error_no_hp_container" style="display: flex; justify-content: space-between;margin-top: 10px;">
                                <span id="error_no_hp"  style="text-transform: capitalize;color: red;"></span>
                                <span style="font-size: 12px;" id="jml_input_no_hp_container">
                                <span id="jml_input_no_hp">0</span> 
                                / 14</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr class="my-4">
                      <div class="pl-lg-4">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group focused">
                              <label class="form-control-label" for="input-address">Alamat</label>
                              <input id="input-address" name="alamat" class="form-control form-control-alternative" placeholder="Masukkan Alamat" value="{{ $siswa->alamat }}" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="form-group focused">
                              <label class="form-control-label" for="input-city">Kelas</label>
                              <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="Masukkan Kelas" disabled value="{{ $siswa->nama_kelas }}">
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group focused">
                              <label class="form-control-label" for="input-country">Bidang</label>
                              <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Masukkan Bidang" disabled value="{{ $siswa->nama_bidang }}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr class="my-4">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6 m-auto text-center">
            <div class="copyright">
              <span>Copyright &copy;LPK CIPTA KERJA DPN PERKASA JATENG 2024</span>
            </div>
          </div>
        </div>
      </footer>
      @if (session('sukses_edit'))
      <script>
            Swal.fire({
                title: "Sukses",
                text: "{{ session('sukses_edit') }}", // Menggunakan blade syntax untuk menampilkan pesan
                icon: "success"
            });
          console.log("success reset message:", "{{ session('sukses_edit') }}");
      </script>
      @endif
      @if (session('error_edit'))
      <script>
            Swal.fire({
                title: "Sukses",
                text: "{{ session('error_edit') }}", // Menggunakan blade syntax untuk menampilkan pesan
                icon: "error"
            });
          console.log("error reset message:", "{{ session('error_edit') }}");
      </script>
      @endif

      <script>
        document.addEventListener('DOMContentLoaded', function () {
    // Mengambil elemen berdasarkan ID
    var inputno_hp = document.getElementById('no_hp');
    var errorno_hp = document.getElementById('error_no_hp');
    var jmlInputString = document.getElementById('jml_input_no_hp');
    var jmlInputString_container = document.getElementById('jml_input_no_hp_container');
    var btn_submit = document.getElementById('btn_submit');

    // Fungsi untuk memperbarui jumlah karakter dan memeriksa limit
    function updateCharacterCount() {
        var length = inputno_hp.value.length;
        jmlInputString.textContent = length; // Memperbarui jumlah karakter yang ditampilkan

        if (length > 14) {
            jmlInputString_container.style.color = "red";
            inputno_hp.value = inputno_hp.value.substring(0, 14); // Memotong nilai input jika lebih dari 14 karakter
            errorno_hp.textContent = "Maksimal 14 angka"; // Menampilkan pesan error
        }else {
            jmlInputString_container.style.color = "black";
            btn_submit.disabled = false;
            errorno_hp.textContent = ""; // Mengosongkan pesan error jika kurang dari 14 karakter
        }
    }

    // Memanggil fungsi saat halaman di-refresh untuk memperbarui tampilan jumlah karakter
    updateCharacterCount();

    // Menambahkan event listener untuk merespons setiap kali ada input
    inputno_hp.addEventListener('input', updateCharacterCount);
});



      </script>
</body>
</html>