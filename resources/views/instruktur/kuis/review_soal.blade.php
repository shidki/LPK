<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/8183c3e7b3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('edit_profile/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div class="main-content">
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 200px; background-image: url({{asset('Login/img/gedung.png')}}); background-size: cover; background-position: center top;">
          <!-- Mask -->
          <span class="mask bg-gradient-default opacity-8"></span>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7" style="overflow: visible;">
          <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0 status_kuis">
              <div class="card card-profile shadow"  style="position: sticky; top: 50px;">
                <div class="row justify-content-center">
                  <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                      <a href="#">
                        <img src="{{ asset('edit_profile/img/profile.webp')}}" class="rounded-circle">
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4" > 
                </div>
                <div class="card-body pt-0 pt-md-4">
                  <div class="row">
                    <div class="col">
                      <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                        <div>
                          <span class="heading" id="soal_terjawab">0</span>
                          <span class="description">Soal Terjawab</span>
                        </div>
                        <div>
                          <span class="heading" id="soal_belum_terjawab">{{ $jml_soal }}</span>
                          <span class="description">Soal belum terjawab</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <h3>
                      <div id="timer-container" style="font-size: 18px;;">
                        @if ($nilai->nilai_fix == null)
                         Nilai Sementara: <b><span id="nilai_baru">{{ $nilai->nilai_sementara}}</span></b>
                         @else
                         Nilai : <b><span id="nilai_baru">{{ $nilai->nilai_fix}}</span></b>
                        @endif
                      </div>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-8 order-xl-1" style="">
              <form action="/submit/koreksi/{{$kuis->id_kuis}}/{{ $siswa->id_siswa}}" method="post" id="kuisForm">
                @csrf
                <div class="card bg-secondary shadow">
                  <div class="card-header bg-white border-0">
                    <div class="row align-items-center text-center" >
                      <div  style="width: 100%;">
                        <h1 class="mb-0"><b>Kuis {{ $kuis->judul_kuis}}</b></h1>
                        <h3 class="mb-0">Nama : {{ $siswa->nama}}</h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                      <h6 class="heading-small text-muted mb-4">Kerjakan Soal Berikut dengan Jawaban Benar</h6>
                      <div class="pl-lg-12">
                        @foreach ($soal as $soals )
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group focused">
                                @if ( $soals->type_soal == 'pilgan')
                                <label class="form-control-label" for="input-username">{{$loop->iteration}}. {{ $soals->pertanyaan }}</label>
                                @else
                                <div>
                                  <div style="display: flex; justify-content: space-between;margin-bottom: 10px;">
                                      <label class="form-control-label" for="input-username">{{$loop->iteration}}. {{ $soals->pertanyaan }}</label>
                                      <select @if (session('role') == "admin") disabled @endif {{ $status_koreksi == true ? 'disabled' : '' }} onchange="editStatus('{{ $soals->id_soal }}', '{{ $soals->id_kuis }}', '{{ $soals->id_siswa }}', '{{ $type }}')" required style="width: 150px;" class="form-select" aria-label="Default select example" name="status_jawaban_{{$soals->id_soal}}" id="status_jawaban_{{$soals->id_soal}}">
                                          <option  value="">Koreksi</option>
                                          <option {{ $soals->status == 'benar' ? 'selected' : '' }} value="benar">Benar</option>
                                          <option {{ $soals->status == 'salah' ? 'selected' : '' }} value="salah">Salah</option>
                                      </select>
                                  </div>
                                </div>
                                @endif
                                @if ($soals->type_soal == 'isian')
                                  <input type="text" value="{{$soals->jawaban}}" id="input-username" class="form-control form-control-alternative" disabled>
                                @elseif ($soals->type_soal == 'uraian')
                                  <textarea id="jawaban" cols="10" rows="7" id="input-username" class="form-control form-control-alternative" disabled >{{ $soals->jawaban }}</textarea>
                                @elseif( $soals->type_soal == 'pilgan')
                                  @foreach ($opsi as $opsis )
                                      @if ($opsis->id_soal == $soals->id_soal)
                                        <div class="form-check">
                                          <input @checked($soals->jawaban == $opsis->opsi) class="form-check-input custom-radio" type="radio" disabled value id="jawaban{{$opsis->id_opsi}}">
                                          <label style="font-weight: bold;" class="form-check-label" for="jawaban{{$opsis->id_opsi}}">
                                            {{ $opsis->opsi }} 
                                            @if ($soals->jawaban_benar == $opsis->opsi)
                                              <span style="margin-left: 10px;color: green; font-weight: bold">&#x2713;</span>
                                            @else
                                            <span style="margin-left: 10px;color: red; font-weight: bold">&cross;</span>
                                            @endif
                                          </label>
                                        </div>
                                      @endif
                                  @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                          <hr class="my-4">
                        @endforeach
                      </div>
                      <hr class="my-4">
                      <div class="pl-md-12">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group focused">
                              @if ($status_koreksi == false)
                                <a href="/list/kuis/{{$kuis->id_kuis}}"  class="btn btn-info">Kembali</a>
                                @if (session('role') == 'instruktur')
                                <button type="submit" id="btn_submit" class="btn btn-info">Selesai Koreksi</button>
                                @endif
                              @else
                                <a href="/list/kuis/{{$kuis->id_kuis}}"  class="btn btn-info">Kembali</a>
                                <a href="/cancel/koreksi/{{$kuis->id_kuis}}/{{$siswa->id_siswa}}"  class="btn btn-danger">Koreksi Ulang</a>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr class="my-4">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6 m-auto text-center">
            <div class="copyright">
              <p>Copyright by <a href="">LPK Cipta Kerja</a> Jateng</p>
            </div>
          </div>
        </div>
      </footer>


  @if (session('error_kuis'))
    <script>
      Swal.fire({
          title: "Gagal Memulai Kuis",
          text: "{{ session('error_kuis') }}", // Menggunakan blade syntax untuk menampilkan pesan
          icon: "error"
      });
          console.log("Error reset message:", "{{ session('error_kuis') }}");
    </script>
  @endif



<script>
  
    // ====================== UPDATE SOAL COUNT ==================
    document.addEventListener('DOMContentLoaded', function () {
        const soalTerjawabSpan = document.getElementById('soal_terjawab');
        const soalBelumTerjawabSpan = document.getElementById('soal_belum_terjawab');
        const allInputs = document.querySelectorAll('input, textarea'); // Pilih semua input dan textarea

        function updateAnsweredCount() {
          let answeredCount = 0;

          // Iterasi semua soal dan cek apakah soal tersebut sudah dijawab
          allInputs.forEach(input => {
            // Jika input bertipe radio atau checkbox, cek apakah sudah terpilih
            if ((input.type === 'radio' || input.type === 'checkbox') && input.checked) {
              answeredCount++;
            } 
            // Jika input bertipe text atau textarea, cek apakah sudah terisi
            else if ((input.type === 'text' || input.tagName === 'TEXTAREA') && input.value.trim() !== '') {
              answeredCount++;
            }
          });

          // Perbarui jumlah soal terjawab
          soalTerjawabSpan.textContent = answeredCount;
          // Perbarui jumlah soal yang belum terjawab
          soalBelumTerjawabSpan.textContent = {{ $jml_soal }} - answeredCount;
        }

        // Tambahkan event listener pada semua input yang relevan
        allInputs.forEach(input => {
          input.addEventListener('change', updateAnsweredCount);
          input.addEventListener('input', updateAnsweredCount);
        });

        // Panggil fungsi untuk perbarui jumlah soal terjawab saat pertama kali
        updateAnsweredCount();
      });

      function editStatus(id_soal, id_kuis, id_siswa, type) {
          const selectElement = document.getElementById('status_jawaban_' + id_soal);
          const selectedValue = selectElement.value;

          console.log('Type sent to server:', type);

          if (selectedValue) {
              fetch('/edit/status_jawaban', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                  },
                  body: JSON.stringify({
                      status: selectedValue,
                      id_soal: id_soal,
                      id_siswa: id_siswa,
                      id_kuis: id_kuis,
                      type_kuis: type
                  })
              })
              .then(response => response.json())
              .then(data => {
                  if (data.success) {
                      Swal.fire({
                          title: data.message,
                          icon: "success"
                      });
                      document.getElementById('nilai_baru').innerHTML = data.nilai_baru;
                      console.log("Success:", data.nilai_baru);
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
</script>
</body>
</html>