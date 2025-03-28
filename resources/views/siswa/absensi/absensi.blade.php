<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dasbor Siswa
        
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('instruktur/style.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/style/style.css')}}">
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
            <img src="{{asset('dashboard/img/logo.png')}}" alt="" class="logo">
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
                                                <p class="text-muted mb-2 fw-medium"><i class="mdi mdi-email-outline me-2"></i>{{ $siswa->email }}
                                                </p>
                                                <p class="text-muted fw-medium mb-0"><i class="mdi mdi-phone-in-talk-outline me-2"></i>{{ $siswa->no_hp }}
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
                                <h4 class="card-title mb-4"><a href="/halamanDashboard" style="text-decoration: none;">Menu  </a>\ Riwayat Presensi</h4>
                                <a class="btn btn-success btn-icon-split mb-3 ml-3" href="/scan/absen/qr">Scan Absen</a>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="task-list-box" id="landing-task" style="height: 300px; overflow-y: scroll;">
                                        @foreach ($absen as $absens )
                                            <div id="task-item">
                                                <div class="card task-box rounded-3">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-xl-6 col-sm-5">
                                                                <div class="checklist form-check font-size-15" >
                                                                    <label class="form-check-label ms-1 task-title" for="customCheck1"><b>{{ $absens->status_presensi }}</b></label>
                                                                    <hr>
                                                                    <div class="form-check-label ms-1 task-title" style="font-size: 15px;">{{ $absens->formatted_date}}</div>
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
                                            <td>{{ $siswa->nama}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Alamat</th>
                                            <td>{{ $siswa->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">No Telp</th>
                                            <td>{{ $siswa->no_hp }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tanggal Masuk</th>
                                            <td>{{ \Carbon\Carbon::parse($siswa->tgl_masuk)->translatedFormat('j F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Status</th>
                                            <td style="text-transform: uppercase">{{ $siswa->status }}</td>
                                        </tr>
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


            function deleteItem(event) {
                event.preventDefault(); // Mencegah pengalihan langsung ke URL
                event.stopPropagation(); // Mencegah event click merambat ke elemen induk

                // Tambahkan konfirmasi penghapusan atau lakukan aksi yang diperlukan di sini
                if (confirm("Apakah Anda yakin ingin menghapus item ini?")) {
                    window.location.href = event.currentTarget.getAttribute('href');
                }
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
    @if (session('error_edit'))
    <script>
          Swal.fire({
              title: "Gagal Menambah Kuis",
              text: "{{ session('error_edit') }}", // Menggunakan blade syntax untuk menampilkan pesan
              icon: "error"
          });
        console.log("Error reset message:", "{{ session('error_edit') }}");
    </script>
    @endif
    @if ($sukses_absen)
    <script>
        Swal.fire({
            title: "{{ $sukses_absen }}",
            icon: "success"
        });
        console.log("Pesan:", "{{ $sukses_absen }}");
    </script>
    @endif
    @if ($error_absen)
    <script>
        Swal.fire({
            title: "{{ $error_absen }}",
            icon: "error"
        });
        console.log("Pesan:", "{{ $error_absen }}");
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
    <script data-cfasync="false" src="{{asset('/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
    <script src="{{asset('https://code.jquery.com/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript">
    </script>
</body>

</html>