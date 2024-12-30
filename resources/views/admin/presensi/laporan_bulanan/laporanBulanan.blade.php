<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dasbor Admin</title>
    <script src="https://kit.fontawesome.com/8183c3e7b3.js" crossorigin="anonymous"></script>
    <!-- Custom fonts for this template -->
    <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Custom styles for this page -->
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">DPN PERKASA <sup>ADMINISTRASI</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/halamanAdmin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Kelola Akun</span>
                </a>
                <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Akun</h6>
                        <a class="collapse-item " href="/akunSiswa">Siswa</a>
                        <a class="collapse-item " href="/akunInstruktur">Instruktur</a>
                        <a class="collapse-item " href="/akunAdmin">Admin</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Kelola Bidang</span>
                </a>
                <div id="collapseUtilities" class="collapse " aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Bidang:</h6>
                        <a class="collapse-item " href="/dataBidang">Bidang</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePresensi"
                    aria-expanded="true" aria-controls="collapsePresensi">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Kelola Presensi</span>
                </a>
                <div id="collapsePresensi" class="collapse show" aria-labelledby="headingPresensi"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Presensi:</h6>
                        <a class="collapse-item active" href="/halaman/absensi">Presensi</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKompNilai"
                    aria-expanded="true" aria-controls="collapseKompNilai">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Kelola Komponen Nilai</span>
                </a>
                <div id="collapseKompNilai" class="collapse" aria-labelledby="headingnilai"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Komponen:</h6>
                        <a class="collapse-item " href="/dataKompNilai">Kelola Komponen Nilai</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsekelas"
                    aria-expanded="true" aria-controls="collapsekelas">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Kelola Kelas</span>
                </a>
                <div id="collapsekelas" class="collapse" aria-labelledby="headingkelas"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelas:</h6>
                        <a class="collapse-item" href="/dataKelas">Kelas</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMateri"
                    aria-expanded="true" aria-controls="collapseMateri">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Kelola Materi</span>
                </a>
                <div id="collapseMateri" class="collapse" aria-labelledby="headingMateri"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Materi:</h6>
                        <a class="collapse-item" href="/dataMateri">Kelola Materi</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile"
                    aria-expanded="true" aria-controls="collapseProfile">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Kelola Profile</span>
                </a>
                <div id="collapseProfile" class="collapse" aria-labelledby="headingProfile"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Profile:</h6>
                        <a class="collapse-item" href="/dataSiswa">Siswa</a>
                        <a class="collapse-item" href="/dataInstruktur">Instruktur</a>
                        <a class="collapse-item" href="/dataAdmin">Admin</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="/logout">
                    <i class="fa-solid fa-door-open"></i>
                    <span>Keluar</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/halamanDashboard">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    Nama Admin
                                </span>                         
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><a href="/halaman/absensi">Kelola Presensi </a>/ Laporan Bulanan</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <span></span>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<form action="/download_laporan_bulanan" method="POST">
                                        @csrf
                                        <select required name="selectKelas" class="form-select" style="margin-bottom: 20px;" id="selectKelas" onchange="selectedKelas()">
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($kelas as $item)
                                                <option  value="{{$item->id_kelas}}">{{$item->nama_kelas}}</option>
                                            @endforeach
                                        </select>

                                        <select name="selectBulan" class="form-select" style="margin-bottom: 20px; display: none;" id="bulanSelect" onchange="selectedBulan()">
                                            <option value="">Pilih Bulan</option>
                                        </select>

                                        <select required onchange="selectedTahun()" name="selectTahun" class="form-select" style="margin-bottom: 20px; display: none;" id="tahunSelect">
                                            <option value="">Pilih Tahun</option>
                                        </select>
                                        <button style="display: none;" id="btn_submit" type="submit" class="btn btn-info">Unduh</button>
                                    </form>                     
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;LPK CIPTA KERJA DPN PERKASA JATENG 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script>
                function selectedKelas() {
                    var kelasSelected = document.getElementById('selectKelas').value;
                    var bulanSelect = document.getElementById('bulanSelect');
                    var tahunSelect = document.getElementById('tahunSelect');
                    var btn_submit = document.getElementById('btn_submit');


                    // Menampilkan atau menyembunyikan dropdown bulan berdasarkan pilihan kelas
                    if (kelasSelected != "") {
                        bulanSelect.style.display = "block"; // Tampilkan dropdown bulan
                        updateBulanSelect(); // Update opsi bulan
                    } else {
                        bulanSelect.style.display = "none"; // Sembunyikan dropdown bulan jika kelas tidak dipilih
                        tahunSelect.style.display = "none"; // Sembunyikan dropdown bulan jika kelas tidak dipilih
                        btn_submit.style.display = "none"; // Sembunyikan dropdown bulan jika kelas tidak dipilih
                    }
                }
                function updateBulanSelect() {
                    var bulanSelect = document.getElementById('bulanSelect');

                    // Daftar bulan
                    var bulanArray = [
                        {value: 1, text: 'Januari'},
                        {value: 2, text: 'Februari'},
                        {value: 3, text: 'Maret'},
                        {value: 4, text: 'April'},
                        {value: 5, text: 'Mei'},
                        {value: 6, text: 'Juni'},
                        {value: 7, text: 'Juli'},
                        {value: 8, text: 'Agustus'},
                        {value: 9, text: 'September'},
                        {value: 10, text: 'Oktober'},
                        {value: 11, text: 'November'},
                        {value: 12, text: 'Desember'}
                    ];

                    // Menghapus semua opsi bulan yang ada sebelumnya
                    bulanSelect.innerHTML = '<option value="">Pilih Bulan</option>';

                    // Menambahkan opsi bulan
                    bulanArray.forEach(function(bulan) {
                        var option = document.createElement("option");
                        option.value = bulan.value;
                        option.text = bulan.text;
                        bulanSelect.appendChild(option);
                    });
                }
                function selectedBulan() {
                    var bulan = document.getElementById('bulanSelect').value;
                    var tahunSelect = document.getElementById('tahunSelect');
                    var tahun = document.getElementById('tahunSelect').value;
                    var btn_submit = document.getElementById('btn_submit');
                    // Menampilkan atau menyembunyikan dropdown tahun berdasarkan pilihan bulan
                    if (bulan != "") {
                        tahunSelect.style.display = "block"; // Tampilkan dropdown tahun
                        updateTahunSelect(); // Update opsi tahun
                    } else {
                        tahunSelect.style.display = "none"; // Sembunyikan dropdown tahun jika bulan tidak dipilih
                        btn_submit.style.display = "none"; // Sembunyikan dropdown tahun jika bulan tidak dipilih
                    }
                }
                function selectedTahun() {
                    var bulan = document.getElementById('tahunSelect').value;
                    var btn_submit = document.getElementById('btn_submit');

                    // Menampilkan atau menyembunyikan dropdown tahun berdasarkan pilihan bulan
                    if (bulan != "") {
                        btn_submit.style.display = "block"; // Tampilkan dropdown tahun
                    } else {
                        btn_submit.style.display = "none"; // Sembunyikan dropdown tahun jika bulan tidak dipilih
                    }
                }

                function updateTahunSelect() {
                    var tahunSelect = document.getElementById('tahunSelect');
                    var currentYear = new Date().getFullYear(); // Tahun saat ini
                    var startYear = currentYear - 3; // Tahun 3 tahun sebelumnya

                    // Menghapus semua opsi tahun yang ada sebelumnya
                    tahunSelect.innerHTML = '<option value="">Pilih Tahun</option>';

                    // Menambahkan opsi tahun baru
                    for (var i = startYear; i <= currentYear; i++) {
                        var option = document.createElement("option");
                        option.value = i;
                        option.text = i;
                        tahunSelect.appendChild(option);
                    }
                }
    </script>
                @if (session('error_add'))
                <script>
                      Swal.fire({
                          title: "Gagal Menambah Akun",
                          text: "{{ session('error_add') }}", // Menggunakan blade syntax untuk menampilkan pesan
                          icon: "error"
                      });
                    console.log("Error reset message:", "{{ session('error_add') }}");
                </script>
                @endif
                @if (session('error_start'))
                <script>
                      Swal.fire({
                          title: "Gagal memulai kelas",
                          text: "{{ session('error_start') }}", // Menggunakan blade syntax untuk menampilkan pesan
                          icon: "error"
                      });
                    console.log("Error reset message:", "{{ session('error_start') }}");
                </script>
                @endif
                @if (session('sukses_add'))
                <script>
                      Swal.fire({
                          title: "{{ session('sukses_add') }}",
                          icon: "success"
                      });
                    console.log("Error reset message:", "{{ session('sukses_add') }}");
                </script>
                @endif
                @if (session('error_delete'))
                <script>
                      Swal.fire({
                          title: "Gagal Menghapus Akun",
                          text: "{{ session('error_delete') }}", // Menggunakan blade syntax untuk menampilkan pesan
                          icon: "error"
                      });
                    console.log("Error reset message:", "{{ session('error_delete') }}");
                </script>
                @endif
                @if (session('sukses_delete'))
                <script>
                      Swal.fire({
                          title: "{{ session('sukses_delete') }}",
                          icon: "success"
                      });
                    console.log("Error reset message:", "{{ session('sukses_delete') }}");
                </script>
                @endif
                @if (session('error_edit'))
                <script>
                      Swal.fire({
                          title: "Gagal Menambah Admin",
                          text: "{{ session('error_edit') }}", // Menggunakan blade syntax untuk menampilkan pesan
                          icon: "error"
                      });
                    console.log("Error reset message:", "{{ session('error_edit') }}");
                </script>
                @endif
                @if (session('sukses_edit'))
                <script>
                      Swal.fire({
                          title: "{{ session('sukses_edit') }}",
                          icon: "success"
                      });
                    console.log("Error reset message:", "{{ session('sukses_edit') }}");
                </script>
                @endif
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js')}}"></script>
    
    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    
    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/datatables-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>