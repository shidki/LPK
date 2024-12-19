<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dasbor Siswa</title>
    <script src="https://kit.fontawesome.com/8183c3e7b3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('edit_profile/style.css')}}">
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
                        Waktu tersisa: <b><span id="timer"></span></b>
                      </div>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-8 order-xl-1" style="">
              <form action="/submit/kuis/{{$kuis->id_kuis}}" method="post" id="kuisForm">
                @csrf
                <div class="card bg-secondary shadow">
                  <div class="card-header bg-white border-0">
                    <div class="row align-items-center text-center" >
                      <div  style="width: 100%;">
                        <h1 class="mb-0"><b>Kuis {{ $kuis->judul_kuis}}</b></h1>
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
                                <label class="form-control-label" for="input-username">{{$loop->iteration}}. {{ $soals->pertanyaan }}</label>
                                <input type="hidden" value="{{$soals->id_soal}}" name="id_soal_{{$soals->id_soal}}" id="">
                                <input type="hidden" value="{{$soals->type_soal}}" name="type_{{$soals->id_soal}}" id="">
                                <input type="hidden" name="jawaban_{{ $soals->id_soal }}" value=""> 
                                @if ($soals->type_soal == 'isian')
                                  <input type="text" name="jawaban_{{ $soals->id_soal }}" id="input-username" class="form-control form-control-alternative" placeholder="Masukkan Jawaban">
                                @elseif ($soals->type_soal == 'uraian')
                                  <textarea name="jawaban_{{ $soals->id_soal }}" id="jawaban" cols="10" rows="7" id="input-username" class="form-control form-control-alternative" placeholder="Masukkan Jawaban"></textarea>
                                @elseif( $soals->type_soal == 'pilgan')
                                  @foreach ($opsi as $opsis )
                                      @if ($opsis->id_soal == $soals->id_soal)
                                        {{--<input type="hidden" name="jawaban_{{ $soals->id_soal }}" value="NULL">--}}
                                        <div class="form-check">
                                          <input value="{{$opsis->opsi}}" class="form-check-input" type="radio" name="jawaban_{{ $soals->id_soal }}" id="jawaban{{$opsis->id_opsi}}">
                                          <label class="form-check-label" for="jawaban{{$opsis->id_opsi}}">
                                            {{ $opsis->opsi }}
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
                              <button type="submit" id="btn_submit" class="btn btn-info">Submit</button>
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
  // ============================ TIMER ===========================
  document.addEventListener('DOMContentLoaded', function () {
    const startTime = new Date("{{ $logKuis->start_time }}"); // Pastikan logKuis memiliki start_time
    const duration = 60  * 60 * 1000; // 10 menit dalam milidetik
    const endTime = new Date(startTime.getTime() + duration);

    console.log("Start Time:", startTime); // Debugging
    console.log("End Time:", endTime);

    let timerInterval; // Deklarasi timerInterval di luar fungsi

    function updateTimer() {
        const now = new Date();
        const timeLeft = endTime - now;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            document.getElementById('kuisForm').submit(); // Submit form saat waktu habis
            return;
        }

        const minutes = Math.floor(timeLeft / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
        document.getElementById('timer').textContent = `${minutes} menit ${seconds} detik`;
    }

    updateTimer();
    timerInterval = setInterval(updateTimer, 1000); // Mulai interval setelah deklarasi
});


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
</script>
</body>
</html>