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
            <h2 class="title">Masuk</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" name="email"  placeholder="Masukkan Alamat Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password"  placeholder="Masukkan Kata Sandi" />
            </div>
            <div>Lupa kata sandi? Klik <a href="/resetSandi" style="text-decoration: none; color: red;">Disini</a></div>
            <input type="submit" value="Masuk" class="btn solid" />
          </form>
          <form action="{{route('daftar')}}" method="post" class="sign-up-form">
            @csrf
            <h2 class="title">Daftar</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="emailReg"  placeholder="Masukkan Alamat Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="passwordReg"  placeholder="Masukkan Kata Sandi" />
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
            <h3>Belum punya akun ?</h3>
            <p>
              Daftar akun untuk membuka portal sistem akademik pembelajaran
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
              title: "Berhasil Mengubah Kata Sandi",
              text: "{{ session('success_reset') }}", 
              icon: "success"
          });
    </script>
    @endif

    <script src="Login/app.js"></script>


  </body>
</html>