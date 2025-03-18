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
                                <h4 class="card-title mb-4"><a href="/halamanDashboard" style="text-decoration: none;">Menu  </a>\ Kelola Kuis</h4>
                                <button data-bs-toggle="modal"  data-bs-target="#staticBackdrop" type="submit" class="btn btn-primary" style="padding: 0 30px;height: 40px;"><i class="fa fa-plus"></i></button>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="task-list-box" id="landing-task">
                                        @foreach ($kuis as $kuiss )
                                        <div style="cursor: pointer;" id="task-item" onclick="window.location.href='/view/soal/{{$kuiss->id_kuis}}'">
                                            <div class="card task-box rounded-3">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-xl-6 col-sm-5">
                                                            <div class="checklist form-check font-size-15" >
                                                                {{--<input type="checkbox" class="star-checkbox" id="starCheck{{ $kuiss->id_kuis }}">
                                                                <label for="starCheck{{ $kuiss->id_kuis }}" class="star-label">♥</label>--}}
                                                                <label class="form-check-label ms-1 task-title" for="customCheck1">Kuis: <b>{{ $kuiss->judul_kuis }}</b></label>
																<hr>
																<div class="form-check-label ms-1 task-title" style="font-size: 15px;">Bab: {{ $kuiss->nama_mapel}}</div>
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
                                                                            <button data-id="{{ json_encode(['kuiss' => $kuiss->id_kuis, "judul" => $kuiss->judul_kuis, "idmapel" => $kuiss->id_mapel, "namamapel" => $kuiss->nama_mapel]) }}" onclick="event.stopPropagation()" style="border: none; background-color: transparent;" class="mb-0 text-muted fw-medium" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><i class="mdi mdi-square-edit-outline font-size-16 align-middle"></i></button>
                                                                        </div>
                                                                        <div>
                                                                            <a href="/delete/kuis/{{$kuiss->id_kuis}}" onclick="deleteItem(event)" class="delete-item">
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
                                    Siswa
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
    {{-- modal tambah kuis --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel" data-bs-toggle="modal"  data-bs-target="#staticBackdrop">Tambah Kuis</h5>
                </div>
                <form action="/add/kuis" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">        
                        <div class="form-group">
                            <label for="kuis">Judul Kuis<strong class="text-danger font-weight-bold">*</strong></label>
                            <input id="kuis" type="text" class="form-control" placeholder="Masukkan Nama Kuis" required name="judulKuis">
                        </div>
                        <div id="error_kuis_container" style="display: flex; justify-content: space-between;margin-top: 10px;">
                            <span id="error_kuis" class="text-danger mt-1" style="text-transform: capitalize"></span>
                            <span id="jml_input_kuis_container">
                            <span id="jml_input_kuis">0</span> 
                            / 50</span>
                        </div>
                        <div class="form-group">
                            <label for="MapelKuis">Pilih Bab<strong class="text-danger font-weight-bold">*</strong></label>
                            <select required class="form-select" name="MapelKuis" id="MapelKuis">
                                <option value="">Pilih Bab</option>
                                @foreach ($mapel as $mapels )
                                	<option value="{{$mapels->id_mapel}}">{{ $mapels->nama_mapel}}</option>
								@endforeach
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
    {{-- modal edit kuis --}}
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdrop2Label" data-bs-toggle="modal"  data-bs-target="#staticBackdrop2">Ubah Kuis</h5>
                </div>
                <form action="/edit/kuis" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">        
                        <div class="form-group">
                            <label for="kuisEdit">Judul Kuis<strong class="text-danger font-weight-bold">*</strong></label>
							<input type="hidden" name="juduls" id="juduls">
                            <input id="kuisEdit" type="text" class="form-control" placeholder="Masukkan Nama Kuis" required name="judulKuisEdit">
                        </div>
                        <div id="error_kuisEdit_container" style="display: flex; justify-content: space-between;margin-top: 10px;">
                            <span id="error_kuisEdit" class="text-danger mt-1" style="text-transform: capitalize"></span>
                            <span id="jml_input_kuisEdit_container">
                            <span id="jml_input_kuisEdit">0</span> 
                            / 50</span>
                        </div>
                        <div class="form-group">
                            <label for="MapelKuisEdit">Pilih Bab<strong class="text-danger font-weight-bold">*</strong></label>
                            <select required class="form-select" name="MapelKuisEdit" id="MapelKuisEdit">
                                <option value="">Pilih Bab</option>
                                @foreach ($mapel as $mapels )
                                	<option value="{{$mapels->id_mapel}}">{{ $mapels->nama_mapel}}</option>
								@endforeach
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
    <script>

        document.addEventListener('DOMContentLoaded', function () {
                // Mengambil elemen berdasarkan ID
                var inputkuis = document.getElementById('kuis');
                var errorkuis = document.getElementById('error_kuis');
                var jmlInputString = document.getElementById('jml_input_kuis');
                var jmlInputString_container = document.getElementById('jml_input_kuis_container');
            
                // Fungsi untuk memperbarui jumlah karakter dan memeriksa limit
                function updateCharacterCount() {
                    var length = inputkuis.value.length;
                    jmlInputString.textContent = length; // Memperbarui jumlah karakter yang ditampilkan
            
                    if (length > 50) {
                        jmlInputString_container.style.color = "red";
                        inputkuis.value = inputkuis.value.substring(0, 50); // Memotong nilai input jika lebih dari 50 karakter
                        errorkuis.textContent = "Maksimal 50 huruf"; // Menampilkan pesan error
                    } else if (length >  50) {
                        jmlInputString_container.style.color = "red";
                        errorkuis.textContent = "Maksimal 50 huruf";
                    } else {
                        jmlInputString_container.style.color = "black";
                        errorkuis.textContent = ""; // Mengosongkan pesan error jika kurang dari 50 karakter
                    }
                }
            
                // Menambahkan event listener untuk merespons setiap kali ada input
                inputkuis.addEventListener('input', updateCharacterCount);
            });


            //function deleteItem(event) {
            //    event.preventDefault(); // Mencegah pengalihan langsung ke URL
            //    event.stopPropagation(); // Mencegah event click merambat ke elemen induk

            //    // Tambahkan konfirmasi penghapusan atau lakukan aksi yang diperlukan di sini
            //    if (confirm("Apakah Anda yakin ingin menghapus item ini?")) {
            //        window.location.href = event.currentTarget.getAttribute('href');
            //    }
            //}
            function deleteItem(event) {
                event.preventDefault(); // Mencegah navigasi default
                event.stopImmediatePropagation(); // Menghentikan propagasi event ke elemen induk

                // Ambil URL dari elemen yang diklik
                const url = event.currentTarget.getAttribute("href");

                // Tampilkan SweetAlert
                Swal.fire({
                    title: "Anda yakin menghapus kuis ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika user mengonfirmasi, arahkan ke URL
                        window.location.href = url;
                    }
                });
            }

			var modalInstruktur = document.getElementById('staticBackdrop2');
            modalInstruktur.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var dataId = button.getAttribute('data-id');
                var parsedDataId = JSON.parse(dataId);
                
                var judulKuis = modalInstruktur.querySelector('#kuisEdit');
                judulKuis.value = parsedDataId.judul;
                var MapelKuis = modalInstruktur.querySelector('#MapelKuisEdit');
                MapelKuis.value = parsedDataId.idmapel;
                var juduls = modalInstruktur.querySelector('#juduls');
                juduls.value = parsedDataId.kuiss;

                updateCounter(judulKuis, 'jml_input_kuisEdit',50);

            });
            function updateCounter(inputElement, counterId, maxLength) {
                var counter = document.getElementById(counterId);
                var length = inputElement.value.length;
                counter.textContent = length;
            }

            // Event listener for real-time input counting
            document.addEventListener('DOMContentLoaded', function () {
                const fields = [
                    { id: 'kuisEdit', max: 50, counterId: 'jml_input_kuisEdit' },
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
              title: "Gagal",
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
              title: "Gagal",
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
              title: "Gagal",
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