<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dasbor Admin</title>

    <!-- Custom fonts for this template -->
    <script src="https://kit.fontawesome.com/8183c3e7b3.js" crossorigin="anonymous"></script>
    <!-- Custom fonts for this template -->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        th{
            text-align: center;
        }
    </style>
    <!-- Custom styles for this page -->
    <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    {{--<i class="fas fa-laugh-wink"></i>--}}
                </div>
                <div class="sidebar-brand-text mx-3">CIPTA KERJA <sup>ADMINISTRASI</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/halamanAdmin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dasbor</span></a>
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
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Akun</h6>
                        <a class="collapse-item" href="/akunSiswa">Siswa</a>
                        <a class="collapse-item" href="/akunInstruktur">Instruktur</a>
                        <a class="collapse-item" href="/akunAdmin">Admin</a>
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
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Bidang:</h6>
                        <a class="collapse-item" href="/dataBidang">Bidang</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePresensi"
                    aria-expanded="true" aria-controls="collapsePresensi">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Kelola Presensi</span>
                </a>
                <div id="collapsePresensi" class="collapse" aria-labelledby="headingPresensi"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Presensi:</h6>
                        <a class="collapse-item" href="/halaman/absensi">Presensi</a>
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
                        <a class="collapse-item" href="/dataKompNilai">Kelola Komponen Nilai</a>
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
            {{--<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseListkelas"
                    aria-expanded="true" aria-controls="collapseListkelas">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>List Kelas</span>
                </a>
                <div id="collapseListkelas" class="collapse" aria-labelledby="headingkelas"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelas:</h6>
                        @foreach ($kelas as $kelass )
                            <a class="collapse-item" href="/dataKelas{{$kelass->nama_kelas}}">Kelas {{$kelass->nama_kelas}}</a>
                        @endforeach
                    </div>
                </div>
            </li>--}}
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile"
                    aria-expanded="true" aria-controls="collapseProfile">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Kelola Profil</span>
                </a>
                <div id="collapseProfile" class="collapse show" aria-labelledby="headingProfile"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Profil:</h6>
                        <a class="collapse-item active" href="/dataSiswa">Siswa</a>
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
                    <span>Kembali</span></a>
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

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Kelola Data Profile / Siswa</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <button data-bs-toggle="modal"  data-bs-target="#staticBackdrop" type="submit" class="btn btn-success btn-icon-split mb-3">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Siswa</span>
                                </button>
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width: 50px">No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Alamat</th>
                                            <th>Kelas</th>
                                            <th>Bidang</th>
                                            <th>Tgl Masuk</th>
                                            <th>Tgl Lulus</th>
                                            <th>Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $siswas )
                                        <tr>
                                            <td style="text-align: center;width: 50px">{{ $loop->iteration}}</td>
                                            <td>{{ $siswas->nama }}</td>
                                            <td>{{ $siswas->email }}</td>
                                            <td>{{ $siswas->no_hp }}</td>
                                            <td>{{ $siswas->alamat }}</td>
                                            <td>{{ $siswas->nama_kelas }}</td>
                                            <td>{{ $siswas->nama_bidang }}</td>
                                            <td>{{ \Carbon\Carbon::parse($siswas->tgl_masuk )->translatedFormat('j F Y') }}</td>
                                            <td >
                                                @if ($siswas->tgl_lulus != null)
                                                    {{ \Carbon\Carbon::parse($siswas->tgl_lulus)->translatedFormat('j F Y') }}
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                            
                                            {{--<td>{{$siswas->tgl_lulus }}</td>--}}
                                            <td style="text-transform: capitalize">{{ $siswas->status }}</td>
                                            <td class="text-center" style="display: flex; justify-content: center; ">
                                                @if ($siswas->status !== "lulus")
                                                <button data-id="{{ json_encode(['id' => $siswas->id_siswa,'nama' => $siswas->nama,'email' => $siswas->email, 'no_hp' => $siswas->no_hp,'alamat' => $siswas->alamat, 'id_kelas' => $siswas->id_kelas, 'id_bidang' => $siswas->id_bidang, 'status' => $siswas->status]) }}" data-bs-toggle="modal"  data-bs-target="#staticBackdrop2" type="submit" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-pen"></i></button>
                                                <a href="/delete/siswa/{{ $siswas->id_siswa }}" class="btn btn-danger btn-circle btn-sm" style="margin-left: 10px">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @else
                                                -
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
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
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    {{-- MODAL TAMBAH SISWA --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Siswa</h5>
                </div>
                <form action="/add/siswa" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Siswa<strong class="text-danger font-weight-bold">*</strong></label>
                            <input id="nama" type="text" class="form-control" placeholder="Nama Siswa" required name="nama_siswa">
                        </div>
                        <div id="error_nama_container" style="display: flex; justify-content: space-between;margin-top: 10px;">
                            <span id="error_nama" class="text-danger mt-1" style="text-transform: capitalize"></span>
                            <span id="jml_input_nama_container">
                            <span id="jml_input_nama">0</span> 
                            / 50</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Siswa <strong class="text-danger font-weight-bold">*</strong></label>
                            <input id="email" type="email" class="form-control" placeholder="Email Siswa" required name="email">
                        </div>
                        <div id="error_email_container" style="display: flex; justify-content: space-between;margin-top: 10px;">
                            <span id="error_email" class="text-danger mt-1" style="text-transform: capitalize"></span>
                            <span id="jml_input_email_container">
                            <span id="jml_input_email">0</span> 
                            / 50</span>
                        </div>
                        <div class="form-group">
                            <label for="nohp">No HP<strong class="text-danger font-weight-bold">*</strong></label>
                            <input id="nohp" type="text" class="form-control" placeholder="No HP Siswa" required name="nohp">
                        </div>
                        <div id="error_nohp_container" style="display: flex; justify-content: space-between;margin-top: 10px;">
                            <span id="error_nohp" class="text-danger mt-1" style="text-transform: capitalize"></span>
                            <span id="jml_input_nohp_container">
                            <span id="jml_input_nohp">0</span> 
                            / 14</span>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat<strong class="text-danger font-weight-bold">*</strong></label>
                            <textarea required name="alamat" class="form-control" id="" cols="10" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="bidang_siswa">Bidang Minat<strong class="text-danger font-weight-bold">*</strong></label>
                            <select  required name="bidang_siswa" class="form-select form-select-sm" id="bidang_siswa">
                                <option value="">Pilih Bidang</option>
                                @foreach ($bidang as $bidangs )
                                    <option value="{{$bidangs->id_bidang }}">{{$bidangs->nama_bidang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas<strong class="text-danger font-weight-bold">*</strong></label>
                            <select  required name="kelas_siswa" class="form-select form-select-sm" id="kelas_siswa">
                                <option value="">Kelas Siswa</option>
                                @foreach ($kelas as $kelass )
                                    <option value="{{$kelass->id_kelas }}">{{$kelass->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Tanggal Masuk<strong class="text-danger font-weight-bold">*</strong></label>
                            <input id="date" type="date" class="form-control" placeholder="Tanggal Masuk Siswa" required name="tglMasuk">
                        </div>
                        <div class="form-group">
                            <label for="status">Status<strong class="text-danger font-weight-bold">*</strong></label>
                            <select required name="status_siswa" class="form-select form-select-sm" id="status_siswa">
                                <option value="">Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak_aktif">Tidak Aktif</option>
                                <option value="mangkir">Mangkir</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT SISWA --}}
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdrop2Label">Ubah Siswa</h5>
                </div>
                <form action="/edit_siswa_admin" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Siswa<strong class="text-danger font-weight-bold">*</strong></label>
                            <input id="siswas" type="hidden" class="form-control" placeholder="Nama Siswa" name="siswas">
                            <input id="namaEdit" type="text" class="form-control" placeholder="Nama Siswa" required name="nama_siswaEdit">
                        </div>
                        <div id="error_nama_containerEdit" style="display: flex; justify-content: space-between;margin-top: 10px;">
                            <span id="error_namaEdit" class="text-danger mt-1" style="text-transform: capitalize"></span>
                            <span id="jml_input_nama_containerEdit">
                            <span id="jml_input_namaEdit">0</span> 
                            / 50</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Siswa <strong class="text-danger font-weight-bold">*</strong></label>
                            <input id="emailEdit" type="email" class="form-control" placeholder="Email Siswa" required name="emailEdit">
                        </div>
                        <div id="error_email_containerEdit" style="display: flex; justify-content: space-between;margin-top: 10px;">
                            <span id="error_emailEdit" class="text-danger mt-1" style="text-transform: capitalize"></span>
                            <span id="jml_input_email_containerEdit">
                            <span id="jml_input_emailEdit">0</span> 
                            / 50</span>
                        </div>
                        <div class="form-group">
                            <label for="nohp">No HP<strong class="text-danger font-weight-bold">*</strong></label>
                            <input id="nohpEdit" type="text" class="form-control" placeholder="No HP Siswa" required name="nohpEdit">
                        </div>
                        <div id="error_nohp_containerEdit" style="display: flex; justify-content: space-between;margin-top: 10px;">
                            <span id="error_nohpEdit" class="text-danger mt-1" style="text-transform: capitalize"></span>
                            <span id="jml_input_nohp_containerEdit">
                            <span id="jml_input_nohEditp">0</span> 
                            / 14</span>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat<strong class="text-danger font-weight-bold">*</strong></label>
                            <textarea required id="alamatEdit" name="alamatEdit" class="form-control" id="" cols="10" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="bidang_siswa">Bidang Minat<strong class="text-danger font-weight-bold">*</strong></label>
                            <select  required  name="bidang_siswaEdit" class="form-select form-select-sm" id="bidang_siswaEdit">
                                <option value="">Pilih Bidang</option>
                                @foreach ($bidang as $bidangs )
                                    <option value="{{$bidangs->id_bidang }}">{{$bidangs->nama_bidang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas<strong class="text-danger font-weight-bold">*</strong></label>
                            <select  required name="kelas_siswaEdit" class="form-select form-select-sm" id="kelas_siswaEdit">
                                <option value="">Kelas Siswa</option>
                                @foreach ($kelas as $kelass )
                                    <option value="{{$kelass->id_kelas }}">{{$kelass->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status<strong class="text-danger font-weight-bold">*</strong></label>
                            <select required name="status_siswaEdit" class="form-select form-select-sm" id="status_siswaEdit" onchange="Lulus()">
                                <option value="">Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak_aktif">Tidak Aktif</option>
                                <option value="mangkir">Mangkir</option>
                                <option value="lulus">Lulus</option>
                            </select>
                            <script>
                                function Lulus(){
                                    var select = document.getElementById("status_siswaEdit").value;
                                    var tglLulus = document.getElementById("tglLulus");
                                    if(select == "lulus"){
                                        tglLulus.style.display = "block";
                                    }else{
                                        tglLulus.style.display = "none";

                                    }
                                }
                            </script>
                        </div>
                        <div class="form-group" id="tglLulus" style="display: none;">
                            <label for="date">Tanggal Lulus<strong class="text-danger font-weight-bold">*</strong></label>
                            <input id="" type="date" class="form-control" name="tglLulus">
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Mengambil elemen berdasarkan ID
                var inputNama = document.getElementById('nama');
                var errorNama = document.getElementById('error_nama');
                var jmlInputString = document.getElementById('jml_input_nama');
                var jmlInputString_container = document.getElementById('jml_input_nama_container');
            
                // Fungsi untuk memperbarui jumlah karakter dan memeriksa limit
                function updateCharacterCount() {
                    var length = inputNama.value.length;
                    jmlInputString.textContent = length; // Memperbarui jumlah karakter yang ditampilkan
            
                    if (length > 50) {
                        jmlInputString_container.style.color = "red";
                        inputNama.value = inputNama.value.substring(0, 50); // Memotong nilai input jika lebih dari 50 karakter
                        errorNama.textContent = "Maksimal 50 huruf"; // Menampilkan pesan error
                    } else if (length >  50) {
                        jmlInputString_container.style.color = "red";
                        errorNama.textContent = "Maksimal 50 huruf";
                    } else {
                        jmlInputString_container.style.color = "black";
                        errorNama.textContent = ""; // Mengosongkan pesan error jika kurang dari 50 karakter
                    }
                }
            
                // Menambahkan event listener untuk merespons setiap kali ada input
                inputNama.addEventListener('input', updateCharacterCount);
            });

            document.addEventListener('DOMContentLoaded', function () {
                // Mengambil elemen berdasarkan ID
                var inputemail = document.getElementById('email');
                var erroremail = document.getElementById('error_email');
                var jmlInputString = document.getElementById('jml_input_email');
                var jmlInputString_container = document.getElementById('jml_input_email_container');
            
                // Fungsi untuk memperbarui jumlah karakter dan memeriksa limit
                function updateCharacterCount() {
                    var length = inputemail.value.length;
                    jmlInputString.textContent = length; // Memperbarui jumlah karakter yang ditampilkan
            
                    if (length > 50) {
                        jmlInputString_container.style.color = "red";
                        inputemail.value = inputemail.value.substring(0, 50); // Memotong nilai input jika lebih dari 50 karakter
                        erroremail.textContent = "Maksimal 50 huruf"; // Menampilkan pesan error
                    } else if (length >  50) {
                        jmlInputString_container.style.color = "red";
                        erroremail.textContent = "Maksimal 50 huruf";
                    } else {
                        jmlInputString_container.style.color = "black";
                        erroremail.textContent = ""; // Mengosongkan pesan error jika kurang dari 50 karakter
                    }
                }
            
                // Menambahkan event listener untuk merespons setiap kali ada input
                inputemail.addEventListener('input', updateCharacterCount);
            });

            document.addEventListener('DOMContentLoaded', function () {
                // Mengambil elemen berdasarkan ID
                var inputnohp = document.getElementById('nohp');
                var errornohp = document.getElementById('error_nohp');
                var jmlInputString = document.getElementById('jml_input_nohp');
                var jmlInputString_container = document.getElementById('jml_input_nohp_container');
            
                // Fungsi untuk memperbarui jumlah karakter dan memeriksa limit
                function updateCharacterCount() {
                    var length = inputnohp.value.length;
                    jmlInputString.textContent = length; // Memperbarui jumlah karakter yang ditampilkan
            
                    if (length > 14) {
                        jmlInputString_container.style.color = "red";
                        inputnohp.value = inputnohp.value.substring(0, 14); // Memotong nilai input jika lebih dari 14 karakter
                        errornohp.textContent = "Maksimal 14 angka"; // Menampilkan pesan error
                    } else if (length >  14) {
                        jmlInputString_container.style.color = "red";
                        errornohp.textContent = "Maksimal 14 angka";
                    } else {
                        jmlInputString_container.style.color = "black";
                        errornohp.textContent = ""; // Mengosongkan pesan error jika kurang dari 50 karakter
                    }
                }
            
                // Menambahkan event listener untuk merespons setiap kali ada input
                inputnohp.addEventListener('input', updateCharacterCount);
            });

            // untuk edit siswa
            var modalSiswa = document.getElementById('staticBackdrop2');
            modalSiswa.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var dataId = button.getAttribute('data-id');
                var parsedDataId = JSON.parse(dataId);
                
                var siswas = modalSiswa.querySelector('#siswas');
                siswas.value = parsedDataId.id;
                var NamaSiswa = modalSiswa.querySelector('#namaEdit');
                NamaSiswa.value = parsedDataId.nama;
                var emailSiswa = modalSiswa.querySelector('#emailEdit');
                emailSiswa.value = parsedDataId.email;
                var nohpEdit = modalSiswa.querySelector('#nohpEdit');
                nohpEdit.value = parsedDataId.no_hp;
                var alamatEdit = modalSiswa.querySelector('#alamatEdit');
                alamatEdit.value = parsedDataId.alamat;
                var bidang_siswaEdit = modalSiswa.querySelector('#bidang_siswaEdit');
                bidang_siswaEdit.value = parsedDataId.id_bidang;
                var kelas_siswaEdit = modalSiswa.querySelector('#kelas_siswaEdit');
                kelas_siswaEdit.value = parsedDataId.id_kelas;
                var status_siswaEdit = modalSiswa.querySelector('#status_siswaEdit');
                status_siswaEdit.value = parsedDataId.status;

                updateCounter(NamaSiswa, 'jml_input_namaEdit', 50);
                updateCounter(emailSiswa, 'jml_input_emailEdit', 50);
                updateCounter(nohpEdit, 'jml_input_nohEditp', 14);
            });

            function updateCounter(inputElement, counterId, maxLength) {
                var counter = document.getElementById(counterId);
                var length = inputElement.value.length;
                counter.textContent = length;
            }

            // Event listener for real-time input counting
            document.addEventListener('DOMContentLoaded', function () {
                const fields = [
                    { id: 'namaEdit', max: 50, counterId: 'jml_input_namaEdit' },
                    { id: 'emailEdit', max: 50, counterId: 'jml_input_emailEdit' },
                    { id: 'nohpEdit', max: 14, counterId: 'jml_input_nohEditp' }
                ];

                fields.forEach(field => {
                    const input = document.getElementById(field.id);
                    const counter = document.getElementById(field.counterId);
                    
                    input.addEventListener('input', function () {
                        // Trim the input to max length
                        if (input.value.length > field.max) {
                            input.value = input.value.substring(0, field.max);
                        }
                        const length = input.value.length;
                        counter.textContent = length;
                        
                        // Optional: Change counter color if it exceeds max length
                        if (length > field.max) {
                            counter.style.color = 'red';
                        } else {
                            counter.style.color = 'black';
                        }
                    });

                    // Initial update of the counter
                    updateCounter(input, counter.id, field.max);
                });
            });
            
    </script>
    <style>
        .swal-text-capitalize .swal2-html-container {
            text-transform: capitalize;
        }
    </style>
        @if (session('error_add'))
        <script>
              Swal.fire({
                  title: "Gagal Menambah Siswa",
                  text: "{{ session('error_add') }}", // Menggunakan blade syntax untuk menampilkan pesan
                  icon: "error",
                          customClass: {
                            popup: 'swal-text-capitalize' // Tambahkan class custom
                        }
              });
            console.log("Error reset message:", "{{ session('error_add') }}");
        </script>
        @endif
        @if (session('sukses_add'))
        <script>
              Swal.fire({
                  title: "{{ session('sukses_add') }}",
                  icon: "success",
                          customClass: {
                            popup: 'swal-text-capitalize' // Tambahkan class custom
                        }
              });
            console.log("Error reset message:", "{{ session('sukses_add') }}");
        </script>
        @endif

        {{-- alert edit --}}
        @if (session('error_edit'))
        <script>
              Swal.fire({
                  title: "Gagal Mengubah Siswa",
                  text: "{{ session('error_edit') }}", // Menggunakan blade syntax untuk menampilkan pesan
                  icon: "error",
                          customClass: {
                            popup: 'swal-text-capitalize' // Tambahkan class custom
                        }
              });
            console.log("Error reset message:", "{{ session('error_edit') }}");
        </script>
        @endif
        @if (session('sukses_edit'))
        <script>
              Swal.fire({
                  title: "{{ session('sukses_edit') }}",
                  icon: "success",
                          customClass: {
                            popup: 'swal-text-capitalize' // Tambahkan class custom
                        }
              });
            console.log("Error reset message:", "{{ session('sukses_edit') }}");
        </script>
        @endif
        @if (session('error_delete'))
        <script>
              Swal.fire({
                  title: "Gagal Menghapus Siswa",
                  text: "{{ session('error_delete') }}", // Menggunakan blade syntax untuk menampilkan pesan
                  icon: "error",
                          customClass: {
                            popup: 'swal-text-capitalize' // Tambahkan class custom
                        }
              });
            console.log("Error reset message:", "{{ session('error_delete') }}");
        </script>
        @endif
        @if (session('sukses_delete'))
        <script>
              Swal.fire({
                  title: "{{ session('sukses_delete') }}",
                  icon: "success",
                          customClass: {
                            popup: 'swal-text-capitalize' // Tambahkan class custom
                        }
              });
            console.log("Error reset message:", "{{ session('sukses_delete') }}");
        </script>
        @endif

    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Page level custom scripts -->
    <script src="admin/js/demo/datatables-demo.js"></script>

</body>

</html>