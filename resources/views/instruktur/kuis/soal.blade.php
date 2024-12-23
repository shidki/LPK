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
                <div class="sidebar-brand-icon rotate-n-15">
                    {{--<i class="fas fa-laugh-wink"></i>--}}
                </div>
                <div class="sidebar-brand-text mx-3">CIPTA KERJA <sup>ADMINISTRASI</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/view/soal">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Kelola Soal</span>
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

                        <!-- Nav Item - User Information -->

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><a href="/kuis">Kelola Kuis</a> \ Kelola Soal</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Soal</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <button data-bs-toggle="modal"  data-bs-target="#staticBackdrop" type="submit" class="btn btn-success btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah Soal</span>
                                    </button>
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:20px;">No</th>
                                            <th style="text-align: center;">Pertanyaan</th>
                                            <th style="text-align: center; width: 50px;">Jenis Soal</th>
                                            <th style="text-align: center; width: 20px;">Opsi</th>
                                            <th style="text-align: center; width: 200px;">Jawaban Benar</th>
                                            <th style="text-align: center; width: 150px;">Bab</th>
                                            <th class="text-center" style="text-align: center; width: 30px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										@foreach($soal as $soals)
										<tr>
											<td style="text-align: center;">{{ $loop->iteration }}</td>
											<td>
                                                <div style="display: flex; justify-content: space-between;">
                                                    <div>{{ $soals->pertanyaan }}</div>
                                                    @if ($soals->type_soal =='pilgan')
                                                        <button style="margin-right: 10px;border: none; background-color: transparent;" data-id="{{ json_encode(['soals' => $soals->id_soal,'soal' => $soals->pertanyaan]) }}" data-bs-toggle="modal"  data-bs-target="#staticBackdrop3" type="submit" class=""><i class="fas fa-pen"></i></button>
                                                    @else
                                                        <button style="margin-right: 10px;border: none; background-color: transparent;" data-id="{{ json_encode(['soals' => $soals->id_soal,'soal' => $soals->pertanyaan, 'jawaban' => $soals->jawaban]) }}" data-bs-toggle="modal"  data-bs-target="#staticBackdrop2" type="submit" class=""><i class="fas fa-pen"></i></button>
                                                    @endif
                                                </div>
                                            </td>
											<td style="text-transform: capitalize">
                                            @if ($soals->type_soal == "pilgan")
                                                Pilihan Ganda
                                            @else
                                            {{ $soals->type_soal }}
                                            @endif    
                                            </td>											
											<td>
                                                @if ($soals->type_soal == "pilgan")

                                                <div style="text-align: center;"><button style="border: none; background-color: transparent;" type="button" data-bs-target="#viewOpsiModal{{$soals->id_soal}}" data-bs-toggle="modal"><i class="fa fa-search"></i></button></div>
                                                @else
                                                 <div style="text-align: center;"><b>-</b> </div>   
                                                @endif
                                            </td>
											{{-- MODAL VIEW OPSI JAWABAN --}}
                                            <div class="modal fade" id="viewOpsiModal{{ $soals->id_soal }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewOpsiModalLabel{{ $soals->id_soal }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewOpsiModalLabel{{ $soals->id_soal }}">Opsi Jawaban untuk Soal No {{ $loop->iteration }}</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group list-group-flush">
                                                                @if ($soals->type_soal == 'pilgan')
                                                                    @foreach ($opsi as $opsis)
                                                                        @if ($opsis->id_soal == $soals->id_soal)
                                                                            <li style="margin-left: 20px;margin-top: 10px;">
                                                                                <div style="display: flex; justify-content: space-between;">
                                                                                    <div>{{ $opsis->opsi }}</div>
                                                                                    <button style="margin-right: 10px" data-id="{{ json_encode(['opsis' => $opsis->id_opsi,'opsi' => $opsis->opsi,'soal' => $opsis->id_soal]) }}" data-bs-toggle="modal"  data-bs-target="#editOpsiModal" type="submit" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-pen"></i></button>
                                                                                </div>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer" style="text-align: center">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
									
											<td>
                                                @if ($soals->type_soal =='pilgan')
                                                <div style="display: flex; justify-content: space-between;">
                                                    <div>{{ $soals->jawaban }}</div>
                                                    <div>
                                                        
                                                        <button 
                                                            style="margin-right: 10px; background: transparent; border: none;" 
                                                            data-id="{{ json_encode(collect($opsi)->filter(fn($o) => $o->id_soal == $soals->id_soal)
                                                                ->mapWithKeys(function ($o, $index) {
                                                                    return ["opsi" . ($index + 1) => $o->opsi];
                                                                })
                                                                ->merge(['soal' => $soals->id_soal,"jawaban" => $soals->jawaban])
                                                                ->all()) }}" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editJawabanbenar" 
                                                            type="button"
                                                        >
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @else
                                                            {{--<button style="margin-right: 10px; background: transparent;border: none;" data-id="{{ json_encode(['soals' => $soals->id_soal,'jawaban' => $soals->jawaban]) }}" data-bs-toggle="modal"  data-bs-target="#staticBackdrop3" type="submit"><i class="fas fa-pen"></i></button>--}}
                                                <div style="text-align: center"><b>-</b></div>
                                                @endif
                                            </td>
											<td >{{ $soals->judul_kuis }}</td>
											<td class="text-center" style="align-content: center ;" >
                                                {{--@if ($soals->type_soal =='pilgan')
                                                    <button style="margin-right: 10px" data-id="{{ json_encode(['soals' => $soals->id_soal,'soal' => $soals->pertanyaan]) }}" data-bs-toggle="modal"  data-bs-target="#staticBackdrop3" type="submit" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-pen"></i></button>
                                                @else
                                                    <button style="margin-right: 10px" data-id="{{ json_encode(['soals' => $soals->id_soal,'soal' => $soals->pertanyaan, 'jawaban' => $soals->jawaban]) }}" data-bs-toggle="modal"  data-bs-target="#staticBackdrop2" type="submit" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-pen"></i></button>
                                                @endif--}}
                                                <a href="/delete/soal/{{$soals->id_soal}}" class="btn btn-danger btn-circle btn-sm">
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


    {{-- MODAL TAMBAH SOAL --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Soal</h5>
                </div>
                <form action="/add/soal" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="soal">Soal<strong class="text-danger font-weight-bold">*</strong></label>
                            <input type="hidden" name="kuiss" value="{{$kuiss}}">
                            <textarea id="soal" class="form-control" placeholder="Masukkan Pertanyaan" required name="soal" cols="30" rows="10"></textarea>
                        </div>
						<div class="form-group">
                            <label for="tipe_soal">Tipe Soal<strong class="text-danger font-weight-bold">*</strong></label>
                            <select  required name="tipe_soal" class="form-select form-select-sm" id="tipe_soal">
                                <option value="">Pilih Tipe Soal</option>
								<option value="pilgan">Pilihan Ganda</option>
								<option value="isian">Isian</option>
								<option value="uraian">Uraian</option>
                            </select>
                        </div>
						<hr>
                        <div class="form-group opsiPilgan opsiNone">
                            <h5 class="text-center">Opsi Pilihan Ganda <br> ( checklist untuk memilih jawaban yang benar )</h5>
                            <div style="margin-top: 10px">
                                <div style="display: flex; justify-content: space-between; align-items: center">
                                    <label for="opsiA">Opsi A <strong class="text-danger font-weight-bold"></strong></label>
                                    <input type="radio" name="checkOpsi" value="" id="radioA" onclick="setRadioValue('opsiA', 'radioA')">
                                </div>
                                <input id="opsiA" type="text" class="form-control" placeholder="Masukkan Opsi Jawaban A" required name="opsiA" oninput="updateRadioValue('opsiA', 'radioA')">
                            </div>
                            <div style="margin-top: 10px">
                                <div style="display: flex; justify-content: space-between; align-items: center">
                                    <label for="opsiB">Opsi B <strong class="text-danger font-weight-bold"></strong></label>
                                    <input type="radio" name="checkOpsi" value="" id="radioB" onclick="setRadioValue('opsiB', 'radioB')">
                                </div>
                                <input id="opsiB" type="text" class="form-control" placeholder="Masukkan Opsi Jawaban B" required name="opsiB" oninput="updateRadioValue('opsiB', 'radioB')">
                            </div>
                            <div style="margin-top: 10px">
                                <div style="display: flex; justify-content: space-between; align-items: center">
                                    <label for="opsiC">Opsi C <strong class="text-danger font-weight-bold"></strong></label>
                                    <input type="radio" name="checkOpsi" value="" id="radioC" onclick="setRadioValue('opsiC', 'radioC')">
                                </div>
                                <input id="opsiC" type="text" class="form-control" placeholder="Masukkan Opsi Jawaban C" required name="opsiC" oninput="updateRadioValue('opsiC', 'radioC')">
                            </div>
                            <div style="margin-top: 10px">
                                <div style="display: flex; justify-content: space-between; align-items: center">
                                    <label for="opsiD">Opsi D <strong class="text-danger font-weight-bold"></strong></label>
                                    <input type="radio" name="checkOpsi" value="" id="radioD" onclick="setRadioValue('opsiD', 'radioD')">
                                </div>
                                <input id="opsiD" type="text" class="form-control" placeholder="Masukkan Opsi Jawaban D" required name="opsiD" oninput="updateRadioValue('opsiD', 'radioD')">
                            </div>
                        </div>
						<div class="form-group isian opsiNone">
                            {{--<h5 class="text-center">Jawaban Isian</h5>
                            <label for="isian">isian<strong class="text-danger font-weight-bold">*</strong></label>
							<input id="isian" type="text" class="form-control" placeholder="Masukkan Jawaban" required name="isian">--}}
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

    {{-- MODAL EDIT SOAL --}}
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdrop2Label">Ubah Soal</h5>
                </div>
                <form action="/edit/soal" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="soal">Soal<strong class="text-danger font-weight-bold">*</strong></label>
                            <input type="hidden" id="soalss" name="soalss">
                            <textarea id="soalEdit" class="form-control" placeholder="Masukkan Pertanyaan" required name="soal" cols="30" rows="10"></textarea>
                        </div>
						<hr>
						{{--<div class="form-group">
                            <h5 class="text-center">Jawaban Isian</h5>
                            <label for="isianEdit">isian<strong class="text-danger font-weight-bold">*</strong></label>
							<input id="isianEdit" type="text" class="form-control" placeholder="Masukkan Jawaban" required name="isian">
                        </div>--}}
                    </div>
                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- MODAL EDIT SOAL --}}
    <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop3Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdrop3Label">Ubah Soal</h5>
                </div>
                <form action="/edit/soal" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="soal">Soal<strong class="text-danger font-weight-bold">*</strong></label>
                            <input type="hidden" id="soalssEdit2" name="soalss">
                            <textarea id="soalEdit2" class="form-control" placeholder="Masukkan Pertanyaan" required name="soal" cols="30" rows="10"></textarea>
                        </div>
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
    {{-- MODAL EDIT JAWABAN BENAR --}}
    <div class="modal fade" id="editJawabanbenar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editJawabanbenarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJawabanbenarLabel">Ubah Jawaban</h5>
                </div>
                <form action="/edit/jawabanBenar" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div>Jawaban benar saat ini : <b><span id="jawabanBenarOld"></span></b></div>
                            <input type="hidden" id="soalsJawaban" name="soalss">
                            <select class="form-select form-select-sm" name="jawaban" id="selectJawaban">

                            </select>
                        </div>
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
    {{-- MODAL EDIT OPSI --}}
    <div class="modal fade" id="editOpsiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editOpsiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOpsiModalLabel">Ubah Opsi Jawaban</h5>
                </div>
                <form action="/edit/opsi" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="opsi">opsi<strong class="text-danger font-weight-bold">*</strong></label>
                            <input type="hidden" id="opsissEdit" name="opsis">
                            <input type="hidden" id="oldOpsi" name="oldOpsi">
                            <input type="hidden" id="soalsEdit" name="soal">
                            <input id="opsissEdit2" class="form-control" placeholder="Masukkan Opsi Jawaban" required name="opsi" type="text">
                        </div>
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


            var modalSoals = document.getElementById('staticBackdrop3');
            modalSoals.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var dataId = button.getAttribute('data-id');
                var parsedDataId = JSON.parse(dataId);
                
                var siswas = modalSoals.querySelector('#soalssEdit2');
                siswas.value = parsedDataId.soals;
                var soalsSiswa = modalSoals.querySelector('#soalEdit2');
                soalsSiswa.value = parsedDataId.soal;

            });
            var modalOpsiss = document.getElementById('editOpsiModal');
            modalOpsiss.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var dataId = button.getAttribute('data-id');
                var parsedDataId = JSON.parse(dataId);
                
                var idOpsi = modalOpsiss.querySelector('#opsissEdit');
                idOpsi.value = parsedDataId.opsis;
                var opsi = modalOpsiss.querySelector('#opsissEdit2');
                opsi.value = parsedDataId.opsi;
                var oldOpsi = modalOpsiss.querySelector('#oldOpsi');
                oldOpsi.value = parsedDataId.opsi;
                var soalsSiswa = modalOpsiss.querySelector('#soalsEdit');
                soalsSiswa.value = parsedDataId.soal;

            });
            var modalSoals2 = document.getElementById('staticBackdrop2');
            modalSoals2.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var dataId = button.getAttribute('data-id');
                var parsedDataId = JSON.parse(dataId);
                
                var siswas = modalSoals2.querySelector('#soalss');
                siswas.value = parsedDataId.soals;
                var soalsSiswa = modalSoals2.querySelector('#soalEdit');
                soalsSiswa.value = parsedDataId.soal;
                var jawaban = modalSoals2.querySelector('#isianEdit');
                jawaban.value = parsedDataId.jawaban;

            });
    // Pastikan ini dijalankan setelah DOM siap
    document.addEventListener("DOMContentLoaded", function () {
        const editJawabanModal = document.getElementById('editJawabanbenar');
        
        // Event listener untuk modal saat akan ditampilkan
        editJawabanModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Tombol yang diklik
            const data = JSON.parse(button.getAttribute('data-id')); // Ambil data-id dari tombol
            
            const selectJawaban = document.getElementById('selectJawaban');
            const jawabanBenarOld = document.getElementById('jawabanBenarOld');
            const soalInput = document.getElementById('soalsJawaban');

            // Bersihkan opsi lama di <select>
            selectJawaban.innerHTML = '';

            // Isi input hidden dengan ID soal
            soalInput.value = data.soal;

            // Populate opsi ke <select>
            for (const key in data) {
                if (key.startsWith('opsi')) { // Cari key yang merupakan opsi
                    const option = document.createElement('option');
                    option.value = data[key]; // Nilai opsi
                    option.textContent = data[key]; // Teks opsi
                    selectJawaban.appendChild(option);
                }
            }

            // Tampilkan jawaban lama (jika ada)
            jawabanBenarOld.textContent = data.jawaban || '-';
        });
    });
    </script>

    {{-- opsi jawaban --}}
    <script>
        function updateRadioValue(inputId, radioId) {
            const input = document.getElementById(inputId);
            const radio = document.getElementById(radioId);
            radio.value = input.value; // Perbarui nilai radio sesuai teks input
        }
    
        function setRadioValue(inputId, radioId) {
            const input = document.getElementById(inputId);
            const radio = document.getElementById(radioId);
            if (input.value === "") {
                alert("Mohon isi teks terlebih dahulu sebelum memilih opsi ini.");
                radio.checked = false; // Jika teks kosong, batalkan pilihan radio
            }
        }
    
        document.addEventListener('DOMContentLoaded', function () {
            const tipeSoal = document.getElementById('tipe_soal');
            const opsiPilgan = document.querySelector('.opsiPilgan');
            //const opsiIsian = document.querySelector('.isian');
            //const isianInput = document.getElementById('isian');
            const opsiPilganInputs = document.querySelectorAll('.opsiPilgan input');

            tipeSoal.addEventListener('change', function () {
                if (this.value === 'pilgan') {
                    // Tampilkan opsi pilihan ganda dan sembunyikan isian
                    opsiPilgan.classList.remove('opsiNone');
                    //opsiIsian.classList.add('opsiNone');

                    // Tambahkan atribut required untuk opsi pilihan ganda
                    opsiPilganInputs.forEach(input => {
                        if (input.type === 'text') {
                            input.setAttribute('required', 'required');
                        }
                    });

                    // Hapus atribut required untuk isian
                    //isianInput.removeAttribute('required');
                } else if (this.value === 'isian') {
                    // Tampilkan isian dan sembunyikan opsi pilihan ganda
                    //opsiIsian.classList.remove('opsiNone');
                    opsiPilgan.classList.add('opsiNone');

                    // Tambahkan atribut required untuk isian
                    //isianInput.setAttribute('required', 'required');

                    // Hapus atribut required untuk opsi pilihan ganda
                    opsiPilganInputs.forEach(input => {
                        input.removeAttribute('required');
                    });
                } else {
                    // Sembunyikan semua opsi
                    opsiPilgan.classList.add('opsiNone');
                    //opsiIsian.classList.add('opsiNone');

                    // Hapus atribut required dari semua input
                    //isianInput.removeAttribute('required');
                    opsiPilganInputs.forEach(input => {
                        input.removeAttribute('required');
                    });
                }
            });

            // Set kondisi awal
            tipeSoal.dispatchEvent(new Event('change'));
        });

    </script>
    
        @if (session('error_add'))
        <script>
              Swal.fire({
                  title: "Gagal Menambah Kuis",
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
                  title: "Gagal Mengubah Kuis",
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
                  title: "Gagal Menghapus Kuis",
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