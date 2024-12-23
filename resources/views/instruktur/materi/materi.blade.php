<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dasbor Instruktur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="instruktur/style.css">
    <link rel="stylesheet" href="dashboard/style/style.css">
    <script src="https://kit.fontawesome.com/8183c3e7b3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <style>
        .star-checkbox {
            display: none; /* Sembunyikan checkbox asli */
        }

        .star-label {
            font-size: 30px; /* Ukuran bintang */
            color: grey; /* Warna bintang yang tidak dipilih */
            cursor: pointer;
        }

        .star-checkbox:checked + .star-label {
            color: rgb(255, 0, 0); /* Warna bintang yang dipilih */
        }
    </style>
</head>

<body>
    <div class="navigasi text-center">
        <div class="header">
            <img src="dashboard/img/logo.png" alt="" class="logo">
          <h5>LPK CIPTA KERJA DPN PERKASA JATENG</h5>
        </div>
        <div class="btn-logout header">              
            <a href="/logout" class="text-light" style="text-decoration: none;"><span class="name-profile" style="margin-right: 10px;">Keluar</span><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="text-center border-end">
                                    <img src="{{asset('dashboard/img/profil.avif')}}" class="img-fluid avatar-xxl rounded-circle" alt>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="ms-3">
                                    <div>
                                        <h5 class="card-title mb-2 text-center" style="font-weight: bold;">Selamat Datang di LPK Cipta Kerja</h5>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-md-12">
                                            <div>
                                                <p class="text-muted mb-2 fw-medium"><i class="mdi mdi-email-outline me-2"></i>{{ $instruktur->email_ins }}
                                                </p>
                                                <p class="text-muted fw-medium mb-0"><i class="mdi mdi-phone-in-talk-outline me-2"></i>{{ $instruktur->no_hp_ins }}
                                                </p>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    
                                    <!-- end ul -->
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="tab-content p-4">


                        <div class="tab-pane active show" id="tasks-tab" role="tabpanel">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                                <h4 class="card-title mb-4"><a href="/halamanDashboard" style="text-decoration: none;">Menu </a>\ Daftar Bab</h4>
                                <button data-bs-toggle="modal"  data-bs-target="#staticBackdrop" type="submit" class="btn btn-primary" style="padding: 0 30px;height: 40px;"><i class="fa fa-plus"></i></button>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="task-list-box" id="landing-task">
                                        @foreach ($mapel as $mapels )
                                        <div style="cursor: pointer;" id="task-item-{{ $mapels->id_mapel }}" data-bs-toggle="modal" data-bs-target="#modalView-{{ $mapels->id_mapel }}">
                                            <div class="card task-box rounded-3">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-xl-6 col-sm-5">
                                                            <div class="checklist form-check font-size-15" >
                                                                {{--<input type="checkbox" class="star-checkbox" id="starCheck{{ $mapels->id_mapel }}">
                                                                <label for="starCheck{{ $mapels->id_mapel }}" class="star-label">♥</label>--}}
                                                                <label class="form-check-label ms-1 task-title" for="customCheck1"><b>Bab:</b> {{ $mapels->nama_mapel }}</label>
                                                            </div>
                                                        </div>
                                                        <!-- end col -->
                                                        <div class="col-xl-6 col-sm-7">
                                                            <div class="row align-items-center">
                                                                <div class="col-xl-5 col-md-6 col-sm-5">
                                                                    <div class="avatar-group mt-3 mt-xl-0 task-assigne">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-7 col-md-6 col-sm-7">
                                                                    <div class="d-flex flex-wrap gap-3 mt-3 mt-xl-0 justify-content-md-end">
                                                                        <div>
                                                                            {{--<span class="badge rounded-pill badge-soft-warning font-size-11 task-status">Progress</span>--}}
                                                                        </div>
                                                                        <div>
                                                                            {{--<a @disabled(true) class="mb-0 text-muted fw-medium"><i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>4/8</a>--}}
                                                                        </div>
                                                                        <div>
                                                                            <button style="border: none; background-color: transparent;" class="mb-0 text-muted fw-medium" data-bs-toggle="modal" data-bs-target="#modal-{{ $mapels->id_mapel }}"><i class="mdi mdi-square-edit-outline font-size-16 align-middle"></i></button>
                                                                        </div>
                                                                        <div>
                                                                            <a href="/delete/mapel/{{$mapels->id_mapel}}" onclick="deleteItem(event)" class="delete-item">
                                                                                <i class="mdi mdi-trash-can-outline align-middle font-size-16 text-danger"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-4">Profil 
                                @if (session("role") == "siswa")
                                    Admin
                                @elseif (session("role") == "instruktur")
                                Instruktur
                                @else
                                Admin
                                @endif
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Nama</th>
                                            <td>{{ $instruktur->nama_ins}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Alamat</th>
                                            <td>{{ $instruktur->alamat_ins }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">No Telp</th>
                                            <td>{{ $instruktur->no_hp_ins }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tanggal Masuk</th>
                                            <td>{{ \Carbon\Carbon::parse($instruktur->tgl_masuk_ins)->translatedFormat('j F Y') }}</td>
                                        </tr>
                                        
                                        {{--<tr>
                                            <th scope="row">Aksi</th>
                                            <td>
                                                <a href="/edit/profile/{{ $instruktur->id_ins}}" class="btn btn-primary btn-icon-split btn-sm">
                                                    <span class="icon text-white-50" style="margin-right: 10px;">
                                                        <i class="fas fa-pen"></i>
                                                    </span>
                                                    <span class="text" style="font-weight: bold">Ubah Profil</span>
                                                </a>
                                            </td>
                                        </tr>--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>
    {{-- modal tambah materi --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel" data-bs-toggle="modal"  data-bs-target="#staticBackdrop">Tambah Bab</h5>
                </div>
                <form action="/add/mapel" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">        
                        <div class="form-group">
                            <label for="mapel">Nama Judul Bab<strong class="text-danger font-weight-bold">*</strong></label>
                            <input id="mapel" type="text" class="form-control" placeholder="Masukkan Judul Bab" required name="mapel">
                        </div>
                        <div id="error_mapel_container" style="display: flex; justify-content: space-between;margin-top: 10px;">
                            <span id="error_mapel" class="text-danger mt-1" style="text-transform: capitalize"></span>
                            <span id="jml_input_mapel_container">
                            <span id="jml_input_mapel">0</span> 
                            / 50</span>
                        </div>
                        <div class="form-group">
                            <label for="tahunAkademik">Tahun Akademik<strong class="text-danger font-weight-bold">*</strong></label>
                            <select required class="form-select" name="tahunAkademik" id="tahunAkademik">
                                <option value="">Tahun Akademik</option>
                                <?php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 1; // 3 tahun sebelum tahun sekarang
                                    $endYear = $currentYear;   // 1 tahun setelah tahun sekarang

                                    for ($year = $startYear; $year <= $endYear; $year++) {
                                        $nextYear = $year + 1;
                                        echo "<option value='{$year}'>{$year}/{$nextYear}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group" style="margin-top: 30px;">
                            <label for="materi">File Materi Pembelajaran<strong class="text-danger font-weight-bold">*</strong></label>
                            <div style="display: flex; justify-content: space-between;margin-top: 10px;" id="btnFileContainer">
                                <button  type="button" id="btnKurangFile" class="btn btn-primary" style="padding: 0 30px;"><i class="fa fa-minus"></i></button>
                                <button  type="button" id="btnTambahFile" class="btn btn-primary" style="padding: 0 30px;"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="file1"><b>File Materi 1</b><strong class="text-danger font-weight-bold"> *</strong></label>
                            <input id="materi" type="text" class="form-control" placeholder="Masukkan Nama Judul Materi" required name="judulMateri1">
                            <input id="file1" accept="application/pdf" style="margin-top: 10px;" type="file" class="form-control" placeholder="Masukkan File Materi" required name="file1">
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

        {{-- modal edit materi --}}
        @foreach ($mapel as $mapels )
            <div class="modal fade" id="modal-{{ $mapels->id_mapel }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-{{ $mapels->id_mapel }}Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-{{ $mapels->id_mapel }}Label" data-bs-toggle="modal"  data-bs-target="#modal-{{ $mapels->id_mapel }}">Ubah Bab {{ $mapels->nama_mapel}}</h5>
                        </div>
                        <form action="/edit/mapel" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body" id="modalEdit">        
                                <div class="form-group-{{ $mapels->id_mapel }}">
                                    <label for="mapelEdit">Nama Judul Bab<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input type="hidden" name="mapelss" value="{{$mapels->id_mapel}}">
                                    <input id="mapelEdit" value="{{$mapels->nama_mapel}}" type="text" class="form-control" placeholder="Masukkan Judul Bab" required name="mapelEdit">
                                </div>
                                <div id="error_mapelEdit_container" style="display: flex; justify-content: space-between;margin-top: 10px;">
                                    <span id="error_mapelEdit" class="text-danger mt-1" style="text-transform: capitalize"></span>
                                    <span id="jml_input_mapelEdit_container">
                                    <span id="jml_input_mapelEdit">0</span> 
                                    / 50</span>
                                </div>
                                <div class="form-group-{{ $mapels->id_mapel }}">
                                    <label for="tahunAkademik">Tahun Akademik<strong class="text-danger font-weight-bold">*</strong></label>
                                    <select required  class="form-select" name="tahunAkademikEdit" id="tahunAkademik">
                                        <option  value="">Tahun Akademik </option>
                                        <?php
                                                $currentYear = date('Y');
                                                $startYear = $currentYear - 1; // Mulai dari 1 tahun sebelum tahun sekarang
                                                $endYear = $currentYear;       // Hingga tahun sekarang

                                                for ($year = $startYear; $year <= $endYear; $year++) {
                                                    $nextYear = $year + 1;
                                                    // Bandingkan dengan $mapels->tahun_akademik
                                                    $isSelected = ($mapels->thn_akademik == "{$year}") ? "selected" : "";
                                                    echo "<option value='{$year}' {$isSelected}>{$year}/{$nextYear}</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group-{{ $mapels->id_mapel }}" style="margin-top: 30px;">
                                    <label for="filemateri">Tambah File Materi Pembelajaran Baru<strong class="text-danger font-weight-bold">*</strong></label>
                                    <div style="display: flex; justify-content: space-between;margin-top: 10px;" id="btnFileContainerEdit">
                                        <button  type="button" id="btnKurangFileEdit" class="btn btn-primary" style="padding: 0 30px;"><i class="fa fa-minus"></i></button>
                                        <button  type="button" id="btnTambahFileEdit" class="btn btn-primary" style="padding: 0 30px;"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="form-group-{{ $mapels->id_mapel }}" style="margin-top: 20px;">
                                    <label for="file1Edit"><b>File Materi 1</b><strong class="text-danger font-weight-bold"> *</strong></label>
                                    <input id="materi1Edit" type="text" class="form-control" placeholder="Masukkan Nama Judul Materi"  name="judulMateriEdit1">
                                    <input id="file1Edit" accept="application/pdf" style="margin-top: 10px;" type="file" class="form-control" placeholder="Masukkan File Materi"  name="fileEdit1">
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
        @endforeach
        {{-- modal view materi --}}
        @foreach ($mapel as $mapels )
            <div class="modal fade" id="modalView-{{ $mapels->id_mapel }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-{{ $mapels->id_mapel }}Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-{{ $mapels->id_mapel }}Label" data-bs-toggle="modal"  data-bs-target="#modal-{{ $mapels->id_mapel }}">Materi dari bab {{ $mapels->nama_mapel}}</h5>
                        </div>
                        <div class="modal-body">
                            @foreach ($materi as $materis )
                            @if ($materis->id_mapels == $mapels->id_mapel)
                            <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                               <a style="padding-bottom: 2px; border-bottom: 1px solid rgb(72, 72, 72); text-decoration: none;width: 80%;" href="{{asset($materis->dok_materi)}}" target="_blank"><b>Materi:</b> {{ $materis->judul_materi}}</a>
                                <div style="display: flex; justify-content: space-between;">
                                    <div>
                                        <button data-id="{{ json_encode(['id' => $materis->id_materi, 'nama' => $materis->judul_materi,'path' => $materis->dok_materi ]) }}" style="border: none; background-color: transparent;" class="mb-0 text-muted fw-medium" data-bs-toggle="modal" data-bs-target="#modalMateri"><i class="mdi mdi-square-edit-outline font-size-16 align-middle"></i></button>

                                        <a href="/delete/materi/{{$materis->id_materi}}" class="delete-item">
                                            <i class="mdi mdi-trash-can-outline align-middle font-size-16 text-danger"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                            @endforeach
                        </div>
                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="modal fade" id="modalMateri" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-MateriLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-Materi" data-bs-toggle="modal"  data-bs-target="#modal">Materi Bab</h5>
                    </div>
                    <form action="/edit/materi" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                                <div class="form-group-">
                                    <label for="materiEditModal">Nama Judul Materi<strong class="text-danger font-weight-bold">*</strong></label>
                                    <input type="hidden" name="id_materi_modal" id="id_materi_modal" value="">
                                    <input id="materiEditModal" value="" type="text" class="form-control" placeholder="Masukkan Judul Materi" required name="materiEditModal">
                                </div>
                                <div class="form-group" style="margin-top: 10px;">
                                    <label for="filemateriEditModal">File Materi</label>
                                    <input id="filemateriEditModal" accept="application/pdf" value="" type="file" class="form-control"  name="filemateriEditModal">
                                </div>
                            </div>
                            <div class="modal-footer" style="text-align: center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Ubah</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    <script>
        let fileCount = 1; // Memulai dengan file1

        document.getElementById('btnTambahFile').addEventListener('click', function () {
            fileCount++;
            
            // Buat elemen div untuk form-group baru
            const newFileGroup = document.createElement('div');
            newFileGroup.classList.add('form-group');
            newFileGroup.style.marginTop = '20px';
            newFileGroup.innerHTML = `
                <label for="file${fileCount}"><b>File Materi ${fileCount}</b><strong class="text-danger font-weight-bold"> *</strong></label>
                <input id="materi${fileCount}" type="text" class="form-control" placeholder="Masukkan Nama Judul Materi" required name="judulMateri${fileCount}">
                <input id="file${fileCount}" accept="application/pdf" type="file" style="margin-top: 10px;" class="form-control" placeholder="Masukkan File Materi" required name="file${fileCount}">
            `;
            
            // Tambahkan form-group baru ke dalam container modal-body
            document.querySelector('.modal-body').appendChild(newFileGroup);
        });

        document.getElementById('btnKurangFile').addEventListener('click', function () {
            if (fileCount > 1) { // Jangan hapus file pertama
                const lastFileGroup = document.getElementById(`file${fileCount}`).parentNode;
                lastFileGroup.remove();
                fileCount--;
            }
        });


        document.addEventListener('click', function (event) {
            // Mengecek apakah tombol tambah file yang diklik di dalam modal tertentu
            if (event.target && event.target.id === 'btnTambahFileEdit') {
                const modalId = event.target.closest('.modal').id; // Ambil ID modal yang relevan
                const mapelId = modalId.split('-')[1]; // Mendapatkan ID mapel dari ID modal
                
                // Menghitung jumlah file input di dalam modal tertentu
                let fileCountEdit = document.querySelectorAll(`#modal-${mapelId} input[type="file"]`).length;
                fileCountEdit++; // Menambah jumlah file yang akan ditambahkan

                // Buat elemen div untuk form-group baru
                const newFileGroup = document.createElement('div');
                newFileGroup.classList.add('form-group', `form-group-${mapelId}`);
                newFileGroup.style.marginTop = '20px';
                newFileGroup.innerHTML = `
                    <label for="file${fileCountEdit}Edit-${mapelId}"><b>File Materi ${fileCountEdit}</b><strong class="text-danger font-weight-bold"> *</strong></label>
                    <input id="materi${fileCountEdit}Edit-${mapelId}" type="text" class="form-control" placeholder="Masukkan Nama Judul Materi" required name="judulMateriEdit${fileCountEdit}">
                    <input id="file${fileCountEdit}Edit-${mapelId}" accept="application/pdf" type="file" style="margin-top: 10px;" class="form-control" placeholder="Masukkan File Materi" required name="fileEdit${fileCountEdit}">
                `;
                
                // Tambahkan form-group baru ke dalam container modal-body
                document.querySelector(`#modal-${mapelId} .modal-body`).appendChild(newFileGroup);
            }

            // Mengecek apakah tombol kurang file yang diklik di dalam modal tertentu
            if (event.target && event.target.id === 'btnKurangFileEdit') {
                const modalId = event.target.closest('.modal').id; // Ambil ID modal yang relevan
                const mapelId = modalId.split('-')[1]; // Mendapatkan ID mapel dari ID modal

                const fileGroups = document.querySelectorAll(`#modal-${mapelId} .form-group-${mapelId}`);
                if (fileGroups.length > 1) { // Jangan hapus file pertama
                    const lastFileGroup = fileGroups[fileGroups.length - 1];
                    lastFileGroup.remove();
                }
            }
        });

        var materiModal = document.getElementById('modalMateri');
            materiModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var dataId = button.getAttribute('data-id');
                var parsedDataId = JSON.parse(dataId);
                
                var id = materiModal.querySelector('#id_materi_modal');
                id.value = parsedDataId.id;
                var materi = materiModal.querySelector('#materiEditModal');
                materi.value = parsedDataId.nama;


            });

        document.addEventListener('DOMContentLoaded', function () {
                // Mengambil elemen berdasarkan ID
                var inputmapel = document.getElementById('mapel');
                var errormapel = document.getElementById('error_mapel');
                var jmlInputString = document.getElementById('jml_input_mapel');
                var jmlInputString_container = document.getElementById('jml_input_mapel_container');
            
                // Fungsi untuk memperbarui jumlah karakter dan memeriksa limit
                function updateCharacterCount() {
                    var length = inputmapel.value.length;
                    jmlInputString.textContent = length; // Memperbarui jumlah karakter yang ditampilkan
            
                    if (length > 50) {
                        jmlInputString_container.style.color = "red";
                        inputmapel.value = inputmapel.value.substring(0, 50); // Memotong nilai input jika lebih dari 50 karakter
                        errormapel.textContent = "Maksimal 50 huruf"; // Menampilkan pesan error
                    } else if (length ===  50) {
                        jmlInputString_container.style.color = "red";
                        errormapel.textContent = "Maksimal 50 huruf";
                    } else {
                        jmlInputString_container.style.color = "black";
                        errormapel.textContent = ""; // Mengosongkan pesan error jika kurang dari 50 karakter
                    }
                }
            
                // Menambahkan event listener untuk merespons setiap kali ada input
                inputmapel.addEventListener('input', updateCharacterCount);
            });
        document.addEventListener('DOMContentLoaded', function () {
                // Mengambil elemen berdasarkan ID
                var inputmapel = document.getElementById('mapelEdit');
                var errormapel = document.getElementById('error_mapelEdit');
                var jmlInputString = document.getElementById('jml_input_mapelEdit');
                var jmlInputString_container = document.getElementById('jml_input_mapelEdit_container');
            
                // Fungsi untuk memperbarui jumlah karakter dan memeriksa limit
                function updateCharacterCount() {
                    var length = inputmapel.value.length;
                    jmlInputString.textContent = length; // Memperbarui jumlah karakter yang ditampilkan
            
                    if (length > 50) {
                        jmlInputString_container.style.color = "red";
                        inputmapel.value = inputmapel.value.substring(0, 50); // Memotong nilai input jika lebih dari 50 karakter
                        errormapel.textContent = "Maksimal 50 huruf"; // Menampilkan pesan error
                    } else if (length ===  50) {
                        jmlInputString_container.style.color = "red";
                        errormapel.textContent = "Maksimal 50 huruf";
                    } else {
                        jmlInputString_container.style.color = "black";
                        errormapel.textContent = ""; // Mengosongkan pesan error jika kurang dari 50 karakter
                    }
                }
            
                // Menambahkan event listener untuk merespons setiap kali ada input
                inputmapel.addEventListener('input', updateCharacterCount);
            });


            function deleteItem(event) {
                event.preventDefault(); // Mencegah pengalihan langsung ke URL
                event.stopPropagation(); // Mencegah event click merambat ke elemen induk

                // Tambahkan konfirmasi penghapusan atau lakukan aksi yang diperlukan di sini
                if (confirm("Apakah Anda yakin ingin menghapus item ini?")) {
                    window.location.href = event.currentTarget.getAttribute('href');
                }
            }
    </script>
    @if (session('error_add'))
    <script>
          Swal.fire({
              title: "Materi gagal ditambahkan!",
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
    @if (session('error_delete'))
    <script>
          Swal.fire({
              title: "Materi gagal ditambahkan!",
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
              title: "Materi gagal ditambahkan!",
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
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
    </script>
</body>

</html>