<!DOCTYPE html>
<html lang="en">
  <!-- coding by @helpme_coder -->
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="Login/app.css" />
    <title>Form Pendaftaran Akun</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  </head>

  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="{{ route('masuk') }}" class="sign-in-form" method="post">
            @csrf
            <h2 class="title">MASUK</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" name="email"  placeholder="Masukkan alamat email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password"  placeholder="Masukkan kata sandi" />
            </div>
            <div class="error_msg" style="color: red; margin-bottom: 10px;">{{ session('login_error') }}</div>
            <div>Lupa kata sandi? Klik <a href="/resetSandi" style="text-decoration: none; color: red;">di sini</a></div>
            <input type="submit" value="Masuk" class="btn solid" />
          </form>
          <form action="{{route('daftar')}}" method="post" class="sign-up-form">
            @csrf
            <h2 class="title">DAFTAR</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="emailReg"  placeholder="Masukkan Alamat Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="passwordReg"  placeholder="Buat Kata Sandi " />
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirmPasswordReg"  placeholder="Ulangi Kata Sandi" />
              </div>
            <input type="submit" class="btn" value="Daftar" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h2 style="font-size: 1.8rem">Selamat Datang  di LPK Cipta Kerja</h2>
            <h4 style="margin-bottom: 20px;">
              Bersama LPK Cipta Kerja, Raih Kesuksesan di Jepang!
            </h4>
            <p>
              Daftar akun untuk membuka portal akademik
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Daftar Akun
            </button>
          </div>
          <img src="Login/img/gedung.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Sudah punya akun ?</h3>
            <p>
              Lapor admin untuk segera aktifasi akun, kemudian segera login jika akun telah teraktifasi
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Masuk
            </button>
          </div>
          <img src="Login/img/gedung.png" class="image" alt="" />
        </div>
      </div>
    </div>

    @if (session('success_reset'))
    <script>
          Swal.fire({
              title: "Berhasil mengubah kata sandi",
              text: "{{ session('success_reset') }}", 
              icon: "success"
          });
    </script>
    @endif
    @if (session('message'))
    <script>
          Swal.fire({
              title: "{{ session('message') }}",
              
              icon: "success"
          });
    </script>
    @endif
    @if (session('signup_error'))
    <script>
          Swal.fire({
              title: "Gagal",
              text: "{{ session('signup_error') }}", 
              icon: "error"
          });
    </script>
    @endif
    @if (session('error_login'))
    <script>
          Swal.fire({
              title: "{{ session('error_login') }}",
              text: "Hubungi Admin Untuk Aktivasi Akun", 
              icon: "error"
          });
    </script>
    @endif
    @if (session('error_login2'))
    <script>
          Swal.fire({
              title: "Akun tidak dapat digunakan",
              text: "{{session('error_login2')}}", 
              icon: "error"
          });
    </script>
    @endif
    @if (session('sukses_edit'))
    <script>
          Swal.fire({
              title: "Berhasil mengubah password",
              text: "{{ session('sukses_edit') }}", 
              icon: "success"
          });
    </script>
    @endif

    <script src="Login/app.js"></script>


  </body>
</html>