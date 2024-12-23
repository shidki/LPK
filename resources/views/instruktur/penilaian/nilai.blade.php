<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dasbor Instruktur</title>

    <!-- Custom fonts for this template -->
    <script src="https://kit.fontawesome.com/8183c3e7b3.js" crossorigin="anonymous"></script>
    <!-- Custom fonts for this template -->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="{{ asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .opsiNone{
            display: none;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-text mx-3">CIPTA KERJA <sup>PENILAIAN</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/view/soal">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Kelola Nilai</span>
				</a>
            </li>
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

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><a href="/kuis">Menu</a> \ Kelola NIlai</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <h6><b>Bobot penilaian</b></h6>
                                @foreach ($komponen_nilai as $item )
                                <div style="display: flex;justify-center: space-between; width: 35%;">
                                    <span style="width: 50%">{{$item->nama_komp_nilai}}</span>
                                    <span style="width: 5%">:</span>
                                    <span style="width: 30%"> {{$item->proporsi_nilai}}%</span>
                                </div>
                                @endforeach
                                <table class="table table-bordered" id="" width="100%" cellspacing="0" style="margin-top: 20px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; width: 100px">No</th>
                                            <th style="text-align: center;">Nama Siswa</th>
                                            @foreach ($komponen_nilai as $item )
                                                <th style="text-align: center; width: 180px;text-transform:capitalize;">{{ $item->nama_komp_nilai}}</th>
                                            @endforeach
                                            <th class="text-center">Nilai Keseluruhan</th>
                                            <th class="text-center" style="text-align: center; width: 80px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datasiswa as $siswa)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $siswa->nama }}</td>
                                                @foreach ($komponen_nilai as $komponen)
                                                    @php
                                                        // Cari nilai berdasarkan siswa dan komponen
                                                        $nilai = $nilaiSiswa->where('id_siswa', $siswa->id_siswa)
                                                                            ->where('id_komp_nilai', $komponen->id_komp_nilai)
                                                                            ->first()?->nilai ?? '-';
                                                    @endphp
                                                    <td style="text-align: center">{{ $nilai }}</td>
                                                @endforeach
                                                @php
                                                 $totalNilai = 0;
                                                // Ambil semua nilai berdasarkan siswa
                                                $nilaiBobot = $nilaiSiswa->where('id_siswa', $siswa->id_siswa);

                                                
                                                foreach ($nilaiBobot as $item) {
                                                    $bobot = 0;
                                                    foreach ($komponen_nilai as $items) {
                                                        if($items->id_komp_nilai == $item->id_komp_nilai){
                                                            $bobot = $items->proporsi_nilai / 100;
                                                        }
                                                    }
                                                    
                                                    $totalNilai += $item->nilai*$bobot ?? 0; // Tambahkan nilai atau 0 jika null
                                                }
                                                @endphp
                                                <td style="text-align: center">{{ $totalNilai }}</td>
                                                <td class="text-center">
                                                    <button
                                                    data-id="{{ json_encode([
                                                        'id_siswa' => $siswa->id_siswa
                                                    ]) }}"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#staticBackdrop2" 
                                                        type="button" 
                                                        class="btn btn-primary btn-circle btn-sm">
                                                    <i class="fa fa-pen"></i>
                                                </button>
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

    {{-- MODAL EDIT NILAI --}}
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdrop2Label">Ubah Nilai</h5>
                </div>
                <form action="/edit/nilai" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="nilaiModal"></div>
                        <input type="hidden" name="id_siswa" id="id_siswa">
						<hr>
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
    var modalInstruktur = document.getElementById('staticBackdrop2');

    modalInstruktur.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Tombol yang memicu modal
        var dataId = button.getAttribute('data-id'); // Ambil data-id
        var parsedDataId = JSON.parse(dataId); // Parsing JSON

        console.log(parsedDataId.id_siswa); // Debug: Lihat id_siswa yang diambil

        // Kirimkan request AJAX ke server untuk mengambil data nilai berdasarkan id_siswa
        $.ajax({
            url: '/get/nilai/' + parsedDataId.id_siswa, // Endpoint sesuai route di Laravel
            method: 'GET',
            success: function(response) {
                
                var inputNilai = '';
                if (Array.isArray(response)) {
                    console.log(response); 
                    response.forEach(function(item) {
                        inputNilai += `
                            <div class="form-group">
                                <label for="nilai_${item.id_komp_nilai}">Komponen Nilai: ${item.nama_komp_nilai}</label>
                                <input type="number" class="form-control" 
                                    name="nilai_${item.id_komp_nilai}" 
                                    value="${item.nilai}" 
                                    required>
                            </div>
                        `;
                    });
                } else {
                    inputNilai = '<p class="text-danger">Tidak ada data nilai ditemukan.</p>';
                }

                // Tambahkan input dinamis ke dalam modal
                var modalBody = modalInstruktur.querySelector('.nilaiModal');
                modalBody.innerHTML = inputNilai;

                // Set nilai input hidden untuk id_siswa
                var idSiswaInput = modalInstruktur.querySelector('#id_siswa');
                idSiswaInput.value = parsedDataId.id_siswa;
            },
            error: function(xhr, status, error) {
                console.error("Terjadi kesalahan:", error);
            }
        });
    });


    </script>    
        @if (session('error_add'))
        <script>
              Swal.fire({
                  title: "Gagal Menambah Siswa",
                  text: "{{ session('error_add') }}", // Menggunakan blade syntax untuk menampilkan pesan
                  icon: "error"
              });
            console.log("Error reset message:", "{{ session('error_add') }}");
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

        {{-- alert edit --}}
        @if (session('error_edit'))
        <script>
              Swal.fire({
                  title: "Gagal Mengubah Siswa",
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
        @if (session('error_delete'))
        <script>
              Swal.fire({
                  title: "Gagal Menghapus Siswa",
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

    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>

</body>

</html>