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
                <a class="nav-link" href="/view/jadwal/{{$kelas}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Kelola Jadwal</span></a>
            </li>

            

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/dataKelas">
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
                    <h1 class="h3 mb-2 text-gray-800"><a href="/dataKelas">Kelola Kelas</a> / Jadwal</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Jadwal {{$kelas->nama_kelas}}</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <button onclick="window.location.href='/tambah/jadwal/{{$kelas->id_kelas}}'" type="submit" class="btn btn-success btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah Jadwal</span>
                                    </button>
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width: 50px">No</th>
                                            <th style="text-align: center;">Tanggal Pelaksanaan</th>
                                            <th class="text-center" style="text-align: center;width: 50px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($jadwal as $jadwals )
                                       <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $jadwals['tanggal_format'] }}</td>
                                            <td class="text-center">
                                                <a 
                                                    @if ($jadwals['status'] == "selesai" || $jadwals['status'] == "mulai"|| $jadwals['status'] == "libur") 
                                                        href="#" 
                                                        onclick="return false;" 
                                                        class="btn btn-danger disabled"
                                                    @else 
                                                        class="btn btn-primary"
                                                        href="/editstatus/libur/{{$jadwals['id_jadwal']}}" 
                                                    @endif>
                                                    Libur
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


            {{-- modal tambah akun --}}
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" data-bs-toggle="modal"  data-bs-target="#staticBackdrop">Tambah Akun</h5>
                        </div>
                        <form action="/add/akun/admin" method="post">
                            @csrf
                            <div class="modal-body">        
                                <div class="form-group">
                                    <label for="email">Email<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input id="email" type="email" class="form-control" placeholder="Masukkan alamat email" required name="email">
                                </div>
                                <div id="error_email_container" style="display: flex; justify-content: space-between;margin-top: 10px;">
                                    <span id="error_email" class="text-danger mt-1" style="text-transform: capitalize"></span>
                                    <span id="jml_input_email_container">
                                    <span id="jml_input_email">0</span> 
                                    / 50</span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input id="password" type="password" class="form-control" placeholder="Masukkan Kata Sandi" required name="password">
                                </div>
                                <div class="form-group">
                                    <label for="konfirmasiPw">Konfirmasi Passowrd<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input id="konfirmasiPw" name="konfirmasiPw" type="password" class="form-control" placeholder="Masukkan Ulang Kata Sandi" required>
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
            {{-- modal edit akun --}}
            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdrop2Label" data-bs-toggle="modal"  data-bs-target="#staticBackdrop2">Ubah Akun</h5>
                        </div>
                        <form action="/edit/akun/admin" method="post">
                            @csrf
                            <div class="modal-body">  
                                <input type="hidden" name="akuns" id="akuns">      
                                <div class="form-group">
                                    <label for="email">Email<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input id="emailEdit" type="email" class="form-control" placeholder="Masukkan alamat email" readonly name="email">
                                </div>
                                <div id="error_email_containerEdit" style="display: flex; justify-content: space-between;margin-top: 10px;">
                                    <span id="error_emailEdit" class="text-danger mt-1" style="text-transform: capitalize"></span>
                                    <span id="jml_input_email_containerEdit">
                                    <span id="jml_input_emailEdit">0</span> 
                                    / 50</span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Kata Sandi<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input id="password" type="password" class="form-control" placeholder="Masukkan Kata Sandi Baru" required name="password">
                                </div>
                                <div class="form-group">
                                    <label for="konfirmasiPw">Konfirmasi Passowrd<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input id="konfirmasiPw" name="konfirmasiPw" type="password" class="form-control" placeholder="Masukkan Ulang Kata Sandi Baru" required>
                                </div>
                            </div>
                            <div class="modal-footer" style="text-align: center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- modal edit status --}}
            <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdrop2Label" data-bs-toggle="modal"  data-bs-target="#staticBackdrop2">Ubah Status Akun</h5>
                        </div>
                        <form action="/edit/status/akun/admin" method="post">
                            @csrf
                            <div class="modal-body">  
                                <input type="hidden" name="akuns" id="akunsTatus">      
                                <div class="form-group">
                                    <label for="email">Status<strong class="text-danger font-weight-bold">*</strong></label>
                                    <select required name="status" class="form-select" id="status">
                                        <option value="">Ubah Status Akun</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak_aktif">Tidak Aktif</option>
                                    </select>
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
                var inputemail = document.getElementById('emailEdit');
                var erroremail = document.getElementById('error_emailEdit');
                var jmlInputString = document.getElementById('jml_input_emailEdit');
                var jmlInputString_container = document.getElementById('jml_input_email_containerEdit');
            
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

            var modalInstruktur = document.getElementById('staticBackdrop2');
            modalInstruktur.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var dataId = button.getAttribute('data-id');
                var parsedDataId = JSON.parse(dataId);
                
                var email = modalInstruktur.querySelector('#emailEdit');
                email.value = parsedDataId.email;
                var email = modalInstruktur.querySelector('#akuns');
                email.value = parsedDataId.id;

                updateCounter(email, 'jml_input_emailEdit', 50);

            });
            var modalStatus = document.getElementById('staticBackdrop3');
            modalStatus.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var dataId = button.getAttribute('data-id');
                var parsedDataId = JSON.parse(dataId);
                
                var status = modalStatus.querySelector('#status');
                status.value = parsedDataId.status;
                var akunsTatus = modalStatus.querySelector('#akunsTatus');
                akunsTatus.value = parsedDataId.id;

            });

            function updateCounter(inputElement, counterId, maxLength) {
                var counter = document.getElementById(counterId);
                var length = inputElement.value.length;
                counter.textContent = length;
            }

            // Event listener for real-time input counting
            document.addEventListener('DOMContentLoaded', function () {
                const fields = [
                    { id: 'emailEdit', max: 50, counterId: 'jml_input_emailEdit' },
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
                          title: "Gagal Menambah Jadwal",
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
                          title: "Gagal Menghapus Akun",
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
                          title: "Gagal Menambah Admin",
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