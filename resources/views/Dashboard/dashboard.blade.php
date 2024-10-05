<!doctype html>
<html lang="en">

<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
  <title>Dashboard</title>
  <meta name="description" content="Wave is a Bootstrap 5 One Page Template.">
  <meta name="author" content="BootstrapBrain">

  
  <link rel="icon" type="image/png" sizes="512x512" href="dashboard/assets/favicon/favicon-512x512.png">

  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Satisfy&display=swap" rel="stylesheet">

  
  <link rel="stylesheet" href="dashboard/assets/css/wave-bsb.css">

  
</head>

<body data-bs-spy="scroll" data-bs-target="#bsb-tpl-navbar" data-bs-smooth-scroll="true" tabindex="0">
  
  <header id="header" class="sticky-top bsb-tpl-header-sticky bsb-tpl-header-sticky-animationX" >    
    <nav id="scrollspyNav" style="height: 10px" class="navbar navbar-expand-lg bsb-tpl-bg-blue bsb-navbar bsb-navbar-hover bsb-navbar-caret bsb-tpl-navbar-sticky" data-bsb-sticky-target="#header">
        <div class="container bg-danger">
            <a class="navbar-brand" @disabled(true)>
                <img src="dashboard/assets/img/logo.png" class="bsb-tpl-logo" alt="">
                <span>LPK Cipta Kerja DPN Perkasa Jateng</span>
            </a>
        </div>
    </nav>

  </header>

  
  <section id="scrollspyHero" class="bsb-hero-2 bsb-tpl-bg-blue py-5 py-xl-8 py-xxl-10">
    <div class="container overflow-hidden">
      <div class="row gy-3 gy-lg-0 align-items-lg-center justify-content-lg-between">
        <div class="col-12 col-lg-6 order-1 order-lg-0">
          <h5 class="profile" style="font-size: 40px" class="display-3 fw-bolder mb-3">Muhamad Ridwan Ash'shidqi</h5>
            <p class="profile d-flex  mb-3" style="width: 400px">
                <span class="" style=" display: block;">Email</span>
                <span class="d-flex  justify-content-between" style="margin-left: 20px;width: 60%" >
                    <span>:</span>
                    <span>shidkigaming7@gmail.com</span>
                </span>
            </p>
            <p class="profile d-flex  mb-3" style="width: 400px">
                <span class="" style=" display: block;">NO Telp</span>
                <span class="d-flex  justify-content-between" style="margin-left: 20px;width: 60%" >
                    <span>:</span>
                    <span>0811</span>
                </span>
            </p>
          <div class="d-grid gap-2 d-sm-flex ">
            <button type="button" class="btn btn-primary bsb-btn-3xl rounded-pill">Ubah Profile</button>
          </div>
        </div>
        <div class="col-12 col-lg-5 text-center">
          <img class="img-fluid" loading="lazy" src="dashboard/assets/img/hero/profile.png" alt="" style="-webkit-mask-image: url(dashboard/assets/img/hero/hero-blob-1.svg); mask-image: url(dashboard/assets/img/hero/hero-blob-1.svg);">
        </div>
      </div>
    </div>
  </section>

  
  <main id="main">
    <section id="scrollspyBlog" class="bsb-tpl-bg-linen py-5 py-xl-8 bsb-section-py-xxl-1">
      <div class="container">
        <div class="row gy-5 gy-lg-0 align-items-center">
          {{-- <div class="col-12 col-lg-4">
            <h2 class="display-3 fw-bolder mb-4">Our <mark class="bsb-tpl-highlight bsb-tpl-highlight-yellow"><span class="bsb-tpl-font-hw display-1 text-accent fw-normal">Blog</span></mark></h2>
            <p class="fs-4 mb-4 mb-xl-5">Stay tuned and updated by the latest updates from our blog.</p>
            <a href="#!" class="btn bsb-btn-2xl btn-primary rounded-pill">More Plans</a>
          </div> --}}
          <div class="col-12 col-lg-12">
            <div class="row justify-content-xl-end">
              <div class="col-12 col-xl-11">
                <div class="row gy-4 gy-xxl-5 gx-xxl-5">
                  <div class="col-12 col-lg-6">
                    <article>
                      <figure class="rounded overflow-hidden mb-3 bsb-overlay-hover">
                        <a href="#!" class="text-center bg-light" style="padding: 50px;">
                          <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="dashboard/assets/img/icon/buku.jpg" height="200px" alt="">
                        </a>
                        <figcaption>
                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInLeft" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                          </svg>
                          <h4 class="h6 text-white font-bold bsb-hover-fadeInRight mt-2">Buka Materi</h4>
                        </figcaption>
                      </figure>
                      <div class="entry-header mb-3">
                        <ul class="entry-meta list-unstyled d-flex mb-2">
                          <li>
                            <a class="link-primary text-decoration-none" href="#!">Materi</a>
                          </li>
                        </ul>
                        <h2 class="entry-title h4 mb-0">
                          <a class="link-dark text-decoration-none" href="#!">Modul Pembelajaran</a>
                        </h2>
                      </div>
                    </article>
                  </div>
                  <div class="col-12 col-lg-6">
                    <article>
                      <figure class="rounded overflow-hidden mb-3 bsb-overlay-hover">
                        <a href="#!" class="text-center bg-light" style="padding: 50px;">
                            <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="dashboard/assets/img/icon/kuis.jpg" height="200px" alt="">
                          </a>
                        <figcaption>
                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInLeft" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                          </svg>
                          <h4 class="h6 text-white bsb-hover-fadeInRight mt-2">Buka Kuis</h4>
                        </figcaption>
                      </figure>
                      <div class="entry-header mb-3">
                        <ul class="entry-meta list-unstyled d-flex mb-2">
                          <li>
                            <a class="link-primary text-decoration-none" href="#!">Kuis</a>
                          </li>
                        </ul>
                        <h2 class="entry-title h4 mb-0">
                          <a class="link-dark text-decoration-none" href="#!">Kuis Materi Pembelajaran</a>
                        </h2>
                      </div>
                    </article>
                  </div>
                  <div class="col-12 col-lg-6">
                    <article>
                      <figure class="rounded overflow-hidden mb-3 bsb-overlay-hover">
                        <a href="#!" class="text-center bg-light" style="padding: 50px;">
                            <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="dashboard/assets/img/icon/kalender.png" height="200px" alt="">
                          </a>
                        <figcaption>
                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInLeft" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                          </svg>
                          <h4 class="h6 text-white bsb-hover-fadeInRight mt-2">Buka Daftar Hadir</h4>
                        </figcaption>
                      </figure>
                      <div class="entry-header mb-3">
                        <ul class="entry-meta list-unstyled d-flex mb-2">
                          <li>
                            <a class="link-primary text-decoration-none" href="#!">Absensi</a>
                          </li>
                        </ul>
                        <h2 class="entry-title h4 mb-0">
                          <a class="link-dark text-decoration-none" href="#!">Daftar Hadir Pembelajaran</a>
                        </h2>
                      </div>
                    </article>
                  </div>
                  <div class="col-12 col-lg-6">
                    <article>
                      <figure class="rounded overflow-hidden mb-3 bsb-overlay-hover">
                        <a href="#!" class="text-center bg-light" style="padding: 50px;">
                            <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="dashboard/assets/img/icon/admin.jpg" height="200px" alt="">
                          </a>
                        <figcaption>
                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInLeft" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                          </svg>
                          <h4 class="h6 text-white bsb-hover-fadeInRight mt-2">Buka Administrasi</h4>
                        </figcaption>
                      </figure>
                      <div class="entry-header mb-3">
                        <ul class="entry-meta list-unstyled d-flex mb-2">
                          <li>
                            <a class="link-primary text-decoration-none" href="#!">Administrasi</a>
                          </li>
                        </ul>
                        <h2 class="entry-title h4 mb-0">
                          <a class="link-dark text-decoration-none" href="#!">Halaman Administrasi</a>
                        </h2>
                      </div>
                    </article>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  
  <footer class="footer">
    <div class="bg-light py-1 py-md-5 py-xl-2 border-top border-light-subtle">
      <div class="container overflow-hidden  ">
        <div class="row gy-4">
          <div class="col-xs-12 col-md-12">
            <div class="copyright text-center">
              &copy; 2024. TIM LPK Cipta Kerja DPN Perkasa Jateng.
            </div>
          </div>
        </div>
      </div>
    </div>

  </footer>

  
  <script src="https://unpkg.com/jquery@3.6.1/dist/jquery.min.js"></script>
  <script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
  <script src="https://unpkg.com/isotope-packery@2.0.1/packery-mode.pkgd.min.js"></script>
  <script src="https://unpkg.com/imagesloaded@5.0.0/imagesloaded.pkgd.min.js"></script>
  <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
