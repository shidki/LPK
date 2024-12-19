<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
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
                <div id="collapseKompNilai" class="collapse show" aria-labelledby="headingnilai"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Komponen:</h6>
                        <a class="collapse-item active" href="/dataKompNilai">Kelola Komponen Nilai</a>
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapselistkelas"
                    aria-expanded="true" aria-controls="collapselistkelas">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>List Kelas</span>
                </a>
                <div id="collapselistkelas" class="collapse" aria-labelledby="headingkelas"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelas:</h6>
                        @foreach ($listkelas as $listkelass )
                            <a class="collapse-item" href="/dataKelas{{$listkelass->nama_kelas}}">Kelas {{$listkelass->nama_kelas}}</a>
                        @endforeach
                    </div>
                </div>
            </li>--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile"
                    aria-expanded="true" aria-controls="collapseProfile">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Kelola Profil</span>
                </a>
                <div id="collapseProfile" class="collapse" aria-labelledby="headingProfile"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Profil:</h6>
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
                                                        
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Kelola Komponen Nilai</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                    <button data-bs-toggle="modal"  data-bs-target="#staticBackdrop" type="submit" class="btn btn-success btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah Komponen Nilai</span>
                                    </button>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Komponen Nilai</th>
                                            <th>Proporsi/Bobot Nilai</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($kompNilai as $kompNilais )
                                       <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{$kompNilais->nama_komp_nilai}}
                                            </td>
                                            <td>
                                                {{$kompNilais->proporsi_nilai}}%
                                            </td>
                                            <td class="text-center">
                                                <button data-id="{{ json_encode(['kompNilais' => $kompNilais->id_komp_nilai,'nama' => $kompNilais->nama_komp_nilai,'proporsi' => $kompNilais->proporsi_nilai]) }}" data-bs-toggle="modal"  data-bs-target="#staticBackdrop2" type="submit" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-pen"></i></button>
                                                <a href="/delete/kompNilai/{{ $kompNilais->id_komp_nilai }}" class="btn btn-danger btn-circle btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            {{-- modal tambah Komponen Nilai --}}
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" data-bs-toggle="modal"  data-bs-target="#staticBackdrop">Tambah Komponen Nilai</h5>
                        </div>
                        <form action="/add/KompNilai" method="post">
                            @csrf
                            <div class="modal-body">        
                                <div class="form-group">
                                    <label for="kompNilai">Nama Komponen Nilai<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input id="kompNilai" type="text" class="form-control" placeholder="Masukkan nama Komponen Nilai" required name="kompNilai">
                                </div>
                                <div id="error_kompNilai_container" style="display: flex; justify-content: space-between;margin-top: 10px;">
                                    <span id="error_kompNilai" class="text-danger mt-1" style="text-transform: capitalize"></span>
                                    <span id="jml_input_kompNilai_container">
                                    <span id="jml_input_kompNilai">0</span> 
                                    / 25</span>
                                </div>
                                <div class="form-group">
                                    <label for="proporsi">Proporsi  Nilai ( <span id="valueRange" style="font-weight: bold">0</span> % )<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input type="range" class="form-range" id="proporsi" name="proporsi" value="0" min="0" max="100" oninput="updateValue(this.value)">  
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
            {{-- modal edit kompNilai --}}
            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdrop2Label" data-bs-toggle="modal"  data-bs-target="#staticBackdrop2">Ubah Komponen Nilai</h5>
                        </div>
                        <form action="/edit/kompNilai" method="post">
                            @csrf
                            <div class="modal-body">  
                                <input type="hidden" name="kompNilais" id="kompNilais">      
                                <div class="form-group">
                                    <label for="kompNilaiEdit">Nama Komponen Nilai<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input id="kompNilaiEdit" type="text" class="form-control" placeholder="Masukkan nama Komponen Nilai" required name="kompNilai">
                                </div>
                                <div id="error_kompNilai_containerEdit" style="display: flex; justify-content: space-between;margin-top: 10px;">
                                    <span id="error_kompNilaiEdit" class="text-danger mt-1" style="text-transform: capitalize"></span>
                                    <span id="jml_input_kompNilai_containerEdit">
                                    <span id="jml_input_kompNilaiEdit">0</span> 
                                    / 25</span>
                                </div>
                                <div class="form-group">
                                    <label for="proporsiEdit">Proporsi  Nilai ( <span id="valueRange2" style="font-weight: bold">0</span> % )<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input type="range" class="form-range" id="proporsiEdit" name="proporsi" value="0" min="0" max="100" oninput="updateValue2(this.value)">  
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
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; DPN PERKASA 2024</span>
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
            function updateValue(value) {
                document.getElementById('valueRange').textContent = value;
            }
            function updateValue2(value) {
                document.getElementById('valueRange2').textContent = value;
            }
                document.addEventListener('DOMContentLoaded', function () {
                // Mengambil elemen berdasarkan ID
                var inputkompNilai = document.getElementById('kompNilai');
                var errorkompNilai = document.getElementById('error_kompNilai');
                var jmlInputString = document.getElementById('jml_input_kompNilai');
                var jmlInputString_container = document.getElementById('jml_input_kompNilai_container');
            
                // Fungsi untuk memperbarui jumlah karakter dan memeriksa limit
                function updateCharacterCount() {
                    var length = inputkompNilai.value.length;
                    jmlInputString.textContent = length; // Memperbarui jumlah karakter yang ditampilkan
            
                    if (length > 25) {
                        jmlInputString_container.style.color = "red";
                        inputkompNilai.value = inputkompNilai.value.substring(0, 25); // Memotong nilai input jika lebih dari 25 karakter
                        errorkompNilai.textContent = "Maksimal 25 huruf"; // Menampilkan pesan error
                    } else if (length >  25) {
                        jmlInputString_container.style.color = "red";
                        errorkompNilai.textContent = "Maksimal 25 huruf";
                    } else {
                        jmlInputString_container.style.color = "black";
                        errorkompNilai.textContent = ""; // Mengosongkan pesan error jika kurang dari 25 karakter
                    }
                }
            
                // Menambahkan event listener untuk merespons setiap kali ada input
                inputkompNilai.addEventListener('input', updateCharacterCount);
            });

                document.addEventListener('DOMContentLoaded', function () {
                // Mengambil elemen berdasarkan ID
                var inputkompNilai = document.getElementById('kompNilaiEdit');
                var errorkompNilai = document.getElementById('error_kompNilaiEdit');
                var jmlInputString = document.getElementById('jml_input_kompNilaiEdit');
                var jmlInputString_container = document.getElementById('jml_input_kompNilai_containerEdit');
            
                // Fungsi untuk memperbarui jumlah karakter dan memeriksa limit
                function updateCharacterCount() {
                    var length = inputkompNilai.value.length;
                    jmlInputString.textContent = length; // Memperbarui jumlah karakter yang ditampilkan
            
                    if (length > 25) {
                        jmlInputString_container.style.color = "red";
                        inputkompNilai.value = inputkompNilai.value.substring(0, 25); // Memotong nilai input jika lebih dari 25 karakter
                        errorkompNilai.textContent = "Maksimal 25 huruf"; // Menampilkan pesan error
                    } else if (length >  25) {
                        jmlInputString_container.style.color = "red";
                        errorkompNilai.textContent = "Maksimal 25 huruf";
                    } else {
                        jmlInputString_container.style.color = "black";
                        errorkompNilai.textContent = ""; // Mengosongkan pesan error jika kurang dari 25 karakter
                    }
                }
            
                // Menambahkan event listener untuk merespons setiap kali ada input
                inputkompNilai.addEventListener('input', updateCharacterCount);
            });

            var modalInstruktur = document.getElementById('staticBackdrop2');
            modalInstruktur.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var dataId = button.getAttribute('data-id');
                var parsedDataId = JSON.parse(dataId);
                
                var kompNilai = modalInstruktur.querySelector('#kompNilaiEdit');
                kompNilai.value = parsedDataId.nama;
                var proporsi = modalInstruktur.querySelector('#proporsiEdit');
                proporsi.value = parsedDataId.proporsi;
                var valueRange2 = modalInstruktur.querySelector('#valueRange2');
                valueRange2.textContent = parsedDataId.proporsi;
                var kompNilais = modalInstruktur.querySelector('#kompNilais');
                kompNilais.value = parsedDataId.kompNilais;

                updateCounter(kompNilai, 'jml_input_kompNilaiEdit',25);

            });
            function updateCounter(inputElement, counterId, maxLength) {
                var counter = document.getElementById(counterId);
                var length = inputElement.value.length;
                counter.textContent = length;
            }

            // Event listener for real-time input counting
            document.addEventListener('DOMContentLoaded', function () {
                const fields = [
                    { id: 'kompNilaiEdit', max: 25, counterId: 'jml_input_kompNilaiEdit' },
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
                @if (session('error_add'))
                <script>
                      Swal.fire({
                          title: "Gagal Menambah Komponen Nilai",
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
                @if (session('error_delete'))
                <script>
                      Swal.fire({
                          title: "Gagal Menghapus Komponen Nilai",
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
                @if (session('error_edit'))
                <script>
                      Swal.fire({
                          title: "Gagal Menambah Komponen Nilai",
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
                <style>
                    .swal-text-capitalize .swal2-html-container {
                        text-transform: capitalize;
                    }
                </style>
                @endif
    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin/js/demo/datatables-demo.js"></script>

</body>

</html>