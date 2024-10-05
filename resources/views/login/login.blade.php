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
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="#" class="sign-in-form">
            <h2 class="title">Masuk</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" required placeholder="Masukkan Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" required placeholder="Password" />
            </div>
            <input type="submit" value="Masuk" class="btn solid" />
          </form>
          <form action="#" class="sign-up-form">
            <h2 class="title">Daftar</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" required placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" required placeholder="Password" />
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" required placeholder="Konfirmasi Password" />
              </div>
            <input type="submit" class="btn" value="Daftar Akun" />
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
          <img src="Login/img/kuil2.jpg" class="image" alt="" />
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
          <img src="Login/img/kuil.jpg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="Login/app.js"></script>
  </body>
</html>