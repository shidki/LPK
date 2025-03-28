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
                    <h1 class="h3 mb-2 text-gray-800">Presensi / Kelola Absensi</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <span></span>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <a href="/laporan/bulanan" class="btn btn-info" style="margin-bottom: 20px;">Laporan Bulanan</a>
									<select name="selectKelas" class="form-select" style="margin-bottom: 20px;" id="selectKelas" onchange="selectedKelas()">
										<option value="">Pilih Kelas</option>
										@foreach ($kelas as $item)
											<option @selected(isset($kelasSelected) && $item->id_kelas == $kelasSelected->id_kelas) value="{{$item->id_kelas}}">{{$item->nama_kelas}}</option>
										@endforeach
									</select>
                                    @if ($tglJadwal != null)
                                        <select name="tglJadwal" class="form-select" style="margin-bottom: 20px;" id="tglJadwal" onchange="tanggalJadwal()">
										<option value="">Pilih jadwal tanggal</option>
										@foreach ($tglJadwal as $item)
											<option @selected(isset($tanggal_selected) && $item->tanggal_pelaksanaan == $tanggal_selected) value="{{$item->tanggal_pelaksanaan}}">{{$item->tanggal}}</option>
										@endforeach
									    </select>
                                    @endif
									
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width: 50px">No</th>
                                            <th style="text-align: center;width: 200px">Nama Siswa</th>
                                            <th class="text-center" style="text-align: center;width: 50px">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($siswa !== null)
                                            @php $no = 1; @endphp 
                                            @foreach ($siswa as $siswas )
                                            @if ($siswas->status !== "lulus")
                                            <tr>
                                                <td style="text-align: center">{{ $no }}</td>
                                                <td style="text-align: center">{{ $siswas->nama }}</td>
                                                <td style="text-align: center">
                                                @php
                                                    $idDisabled2 = false;
                                                    $isDisabled = \Carbon\Carbon::parse($tanggal_selected)->greaterThan(\Carbon\Carbon::now());
                                                    if($status_jadwal != null && ($status_jadwal == "libur" || $status_jadwal == "aktif")){
                                                        $idDisabled2 = true;
                                                    }
                                                @endphp
                                                    <select @if ($isDisabled || $idDisabled2) disabled @endif name="status_absen" class="form-select"  id="status_absen_{{ $siswas->id_siswa }}" onchange="editStatus('{{ $siswas->id_siswa }}', '{{ $id_jadwal }}')">
                                                        <option style="text-transform: capitalize;" value="{{ $siswas->status_presensi ?? 'Belum Absen' }}" selected>
                                                            {{ $siswas->status_presensi ?? 'Belum Absen' }}
                                                        </option>
                                                        @if ($siswas->status_presensi == 'Sakit')
                                                            <option style="text-transform: capitalize;" value="Hadir">Hadir</option>
                                                            <option style="text-transform: capitalize;" value="Alpha">Alpha</option>
                                                            <option style="text-transform: capitalize;" value="Izin">Izin</option>
                                                        @elseif ($siswas->status_presensi == 'Hadir')
                                                            <option style="text-transform: capitalize;" value="Sakit">Sakit</option>
                                                            <option style="text-transform: capitalize;" value="Alpha">Alpha</option>
                                                            <option style="text-transform: capitalize;" value="Izin">Izin</option>
                                                        @elseif ($siswas->status_presensi == 'Alpha')
                                                            <option style="text-transform: capitalize;" value="Hadir">Hadir</option>
                                                            <option style="text-transform: capitalize;" value="Sakit">Sakit</option>
                                                            <option style="text-transform: capitalize;" value="Izin">Izin</option>
                                                        @elseif ($siswas->status_presensi == 'Izin')
                                                            <option style="text-transform: capitalize;" value="Hadir">Hadir</option>
                                                            <option style="text-transform: capitalize;" value="Alpha">Alpha</option>
                                                            <option style="text-transform: capitalize;" value="Sakit">Sakit</option>
                                                        @else
                                                            <!-- Opsi default jika nilai tidak sesuai -->
                                                            <option style="text-transform: capitalize;" value="Hadir">Hadir</option>
                                                            <option style="text-transform: capitalize;" value="Alpha">Alpha</option>
                                                            <option style="text-transform: capitalize;" value="Sakit">Sakit</option>
                                                            <option style="text-transform: capitalize;" value="Izin">Izin</option>
                                                        @endif
                                                    </select>												
                                                </td>
                                            </tr>
                                            @php $no++; @endphp
                                            @endif
                                            @endforeach
                                        @endif
                                    </tbody>
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
                function selectedKelas(){
                    const selectElement = document.getElementById('selectKelas');
                    const selectedValue = selectElement.value;

                    if (selectedValue) {
                        window.location.href = `/halaman/absensi/${selectedValue}`;
                    }
                }
                function tanggalJadwal(){
                    const selectElement = document.getElementById('tglJadwal');
                    const selectedValue = selectElement.value;
                    const selectedKelas = document.getElementById("selectKelas").value;

                    if (selectedValue) {
                        window.location.href = `/halaman/absensi/${selectedKelas}/${selectedValue}`;
                    }
                }
                //function editStatus(id_siswa,id_jadwal){
                //    const selectElement = document.getElementById('status_absen');
                //    const selectedValue = selectElement.value;

                //    if (selectedValue) {
                //        window.location.href = `/edit/absen/siswa/${selectedValue}/${id_siswa}/${id_jadwal}`;
                //    }
                //}
                function editStatus(id_siswa, id_jadwal) {
                    const selectElement = document.getElementById('status_absen_' + id_siswa);
                    const selectedValue = selectElement.value;

                    if (selectedValue) {
                        fetch('/edit/absen/siswaAdmin', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                status: selectedValue,
                                id_siswa: id_siswa,
                                id_jadwal: id_jadwal
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: data.message,
                                    icon: "success"
                                });
                                console.log("Success:", data.message);
                            } else {
                                Swal.fire({
                                    title: data.message,
                                    icon: "error"
                                });
                                console.log("Error:", data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan.');
                        });
                    }
                }



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

            var modalInstruktur = document.getElementById('editStatus');
            modalInstruktur.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var dataId = button.getAttribute('data-id');
                var parsedDataId = JSON.parse(dataId);
                
                var absensis = modalInstruktur.querySelector('#absensis');
                absensis.value = parsedDataId.absensis;
                var status = modalInstruktur.querySelector('#status');
                status.value = parsedDataId.status;

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
                @if (session('error_add'))
                <script>
                      Swal.fire({
                          title: "Gagal Menambah Akun",
                          text: "{{ session('error_add') }}", // Menggunakan blade syntax untuk menampilkan pesan
                          icon: "error",
                          customClass: {
                            popup: 'swal-text-capitalize' // Tambahkan class custom
                        }
                      });
                    console.log("Error reset message:", "{{ session('error_add') }}");
                </script>
                @endif
                @if (session('error_start'))
                <script>
                      Swal.fire({
                          title: "Gagal memulai kelas",
                          text: "{{ session('error_start') }}", // Menggunakan blade syntax untuk menampilkan pesan
                          icon: "error",
                          customClass: {
                            popup: 'swal-text-capitalize' // Tambahkan class custom
                        }
                      });
                    console.log("Error reset message:", "{{ session('error_start') }}");
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
                <style>
                    .swal-text-capitalize .swal2-html-container {
                        text-transform: capitalize;
                    }
                </style>
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