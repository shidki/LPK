<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reset Kata Sandi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Lupa Kata Sandi?</h1>
                                        <p class="mb-4">Masukkan email LPK dan kode verifikasi akan dikirimkan ke kotak masuk email tersebut</p>
                                    </div>
                                    <form class="user" method="post" action="{{ route('confirmResetPassword') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" name="email" aria-describedby="emailHelp"
                                                placeholder="Masukkan alamat email">
                                        </div>
                                        <div class="form-group d-none">
                                            <input type="number" class="form-control form-control-user"
                                                id="exampleInputKode" name="kode" name="kodeVerif" aria-describedby="KodeHelp"
                                                placeholder="Masukkan kode verifikasi">
                                        </div>
                                        <div class="form-group d-none">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputpassword" name="passwordVerif" aria-describedby="passwordHelp"
                                                placeholder="Masukkan kata sandi baru">
                                        </div>
                                        <a id="btn-reset" href="" class="btn btn-primary btn-user btn-block">
                                            Kirim Kode
                                        </a>
                                        <a id="btn-reset2" href="" class="btn btn-primary btn-user btn-block d-none">
                                            Cek Kode
                                        </a>
                                        <button type="submit" id="btn-reset3" class="btn btn-primary btn-user btn-block d-none">
                                            Atur Ulang Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/">Sudah punya akun? Masuk!!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>
    @if (session('error_reset'))
    <script>
          Swal.fire({
              title: "Gagal Mengubah Kata Sandi",
              text: "{{ session('error_reset') }}", // Menggunakan blade syntax untuk menampilkan pesan
              icon: "error"
          });
        console.log("Error reset message:", "{{ session('error_reset') }}");
    </script>
@endif
    <script>
        $(document).ready(function() {
            $('#btn-reset').on('click', function(e) {
                e.preventDefault();
                var email = $('#exampleInputEmail').val();
                $.ajax({
                    url: '/reset-password',
                    type: 'POST',
                    data: {
                        email: email,
                        _token: $('meta[name="csrf-token"]').attr('content') 
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#exampleInputKode').parent().removeClass('d-none');
                            $('#btn-reset').addClass('d-none');
                            $('#btn-reset2').removeClass('d-none');
                        } else {
                            alert('Terjadi kesalahan, coba lagi.');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Jika ada pesan validasi
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            for (const field in errors) {
                                errorMessage += errors[field].join(', ') + '\n'; // Gabungkan pesan kesalahan
                            }
                            alert('Kesalahan: \n' + errorMessage); // Tampilkan pesan kesalahan
                        } else {
                            alert('Terjadi kesalahan dalam menghubungi server.');
                        }
                    }
                });
            });
        });

        $('#btn-reset2').on('click', function(e) {
            e.preventDefault();
            var email = $('#exampleInputEmail').val();
            var kode = $('#exampleInputKode').val();
            $.ajax({
                url: '/reset-password2',
                type: 'POST',
                data: {
                    email: email,
                    kode: kode,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        $('#exampleInputpassword').parent().removeClass('d-none');
                        $('#btn-reset2').addClass('d-none'); // Sembunyikan tombol verifikasi
                        $('#btn-reset3').removeClass('d-none'); // Tampilkan tombol reset password
                    } else {
                        alert('Terjadi kesalahan, coba lagi.');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        for (const field in errors) {
                            errorMessage += errors[field].join(', ') + '\n';
                        }
                        alert('Kesalahan: \n' + errorMessage);
                    } else {
                        alert('Terjadi kesalahan dalam menghubungi server.');
                    }
                }
            });
        });
    </script>

</body>

</html>