<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>SIA DPN PERKASA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8183c3e7b3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dashboard/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid avatar-xxl rounded-circle" alt>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="ms-3">
                                    <div>
                                        <h4 class="card-title mb-2 text-center" style="font-weight: bold;">Selamat datang di DPN Perkasa Dashboard</h4>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-md-12">
                                            <div>
                                                <p class="text-muted mb-2 fw-medium"><i class="mdi mdi-email-outline me-2"></i>
                                                    @if (session('role') == "siswa")
                                                    {{ $siswa->email }}
                                                    @elseif (session('role') == "admin")
                                                        {{$admin}}
                                                    @elseif (session('role') == "instruktur")
                                                        {{$instruktur->email_ins}}
                                                    @endif
                                                    {{-- {{ session("role") }} --}}
                                                </p>
                                                
                                                <p class="text-muted fw-medium mb-0"><i class="mdi mdi-phone-in-talk-outline me-2"></i>
                                                    @if (session("role")  == "siswa")
                                                        {{ $siswa->no_hp }}
                                                    @elseif (session('role') == "instruktur")
                                                        {{$instruktur->no_hp_ins}}
                                                        @else
                                                        082xxx
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="team-tab" role="tabpanel">
                            <h4 class="card-title mb-4">Menu</h4>
                            <div class="row">
                                @if (session("role") == "siswa" )
                                    <div class="col-xl-4 col-md-6" id="team-1">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex mb-4">
                                                    <div class="flex-grow-1 align-items-start">
                                                        <div class="avatar-group float-start flex-grow-1">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Terrell Soto">
                                                                    {{-- <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt class="rounded-circle avatar-sm"> --}}
                                                                    <i class="fa-solid fa-qrcode" style="font-size: 2rem"></i>
                                                                </a>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="dropdown ms-2">
                                                        <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="javascript: void(0);">Scan Presensi</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger leave-team" data-id="1" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team" href="javascript: void(0);">Lihat Daftar Hadir</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 font-size-17">Presensi</h5>
                                                    <p class="text-muted  font-size-13 mb-0">Pindai Kode QR</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6" id="team-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex mb-4">
                                                    <div class="flex-grow-1 align-items-start">
                                                        <div class="avatar-group float-start flex-grow-1">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark Burke" data-bs-original-title="Mark Burke">
                                                                    {{-- <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt class="rounded-circle avatar-sm"> --}}
                                                                    <i class="fa-solid fa-book" style="font-size: 2rem"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 font-size-17">Materi</h5>
                                                    <p class="text-muted  font-size-13 mb-0">Materi Pembelajaran</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6" id="team-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex mb-4">
                                                    <div class="flex-grow-1 align-items-start">
                                                        <div class="avatar-group float-start flex-grow-1">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark Burke" data-bs-original-title="Mark Burke">
                                                                    <i class="fa-solid fa-file-pen" style="font-size: 2rem"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 font-size-17">Kuis</h5>
                                                    <p class="text-muted  font-size-13 mb-0">Kuis</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6" id="team-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex mb-4">
                                                    <div class="flex-grow-1 align-items-start">
                                                        <div class="avatar-group float-start flex-grow-1">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="William  Zawacki" data-bs-original-title="William  Zawacki">
                                                                    <i class="fa-solid fa-star-half-stroke" style="font-size: 2rem"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="dropdown ms-2">
                                                        <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="javascript: void(0);">Edit</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger leave-team" data-id="4" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team" href="javascript: void(0);">Leave Team</a>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 font-size-17">Penilaian</h5>
                                                    <p class="text-muted font-size-13 mb-0">KHS Siswa</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (session("role") == "instruktur" )
                                    <div class="col-xl-4 col-md-6" id="team-1" style="cursor: pointer" onclick="window.location.href='/view/absensi'">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex mb-4">
                                                    <div class="flex-grow-1 align-items-start">
                                                        <div class="avatar-group float-start flex-grow-1">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Terrell Soto">
                                                                    {{-- <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt class="rounded-circle avatar-sm"> --}}
                                                                    <i class="fa-solid fa-qrcode" style="font-size: 2rem"></i>
                                                                </a>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 font-size-17">Daftar Hadir</h5>
                                                    <p class="text-muted  font-size-13 mb-0">Lihat Daftar Hadir Siswa</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6" id="team-2" style="cursor: pointer" onclick="window.location.href='/materiPembelajaran'">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex mb-4">
                                                    <div class="flex-grow-1 align-items-start">
                                                        <div class="avatar-group float-start flex-grow-1">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark Burke" data-bs-original-title="Mark Burke">
                                                                    {{-- <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt class="rounded-circle avatar-sm"> --}}
                                                                    <i class="fa-solid fa-book" style="font-size: 2rem"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 font-size-17">Materi</h5>
                                                    <p class="text-muted  font-size-13 mb-0">Materi Pembelajaran</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6" id="team-3" style="cursor: pointer" onclick="window.location.href='/kuis'">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex mb-4">
                                                    <div class="flex-grow-1 align-items-start">
                                                        <div class="avatar-group float-start flex-grow-1">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark Burke" data-bs-original-title="Mark Burke">
                                                                    <i class="fa-solid fa-file-pen" style="font-size: 2rem"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 font-size-17">Kuis</h5>
                                                    <p class="text-muted  font-size-13 mb-0">Kelola Kuis</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6" id="team-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex mb-4">
                                                    <div class="flex-grow-1 align-items-start">
                                                        <div class="avatar-group float-start flex-grow-1">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="William  Zawacki" data-bs-original-title="William  Zawacki">
                                                                    <i class="fa-solid fa-star-half-stroke" style="font-size: 2rem"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="dropdown ms-2">
                                                        <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="javascript: void(0);">Edit</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger leave-team" data-id="4" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team" href="javascript: void(0);">Leave Team</a>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 font-size-17">Penilaian</h5>
                                                    <p class="text-muted font-size-13 mb-0">KHS Siswa</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                               @if (session("role") == "admin")
                                <div class="col-xl-4 col-md-6" id="team-5" style="cursor: pointer" onclick="window.location.href='/halamanAdmin'">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 align-items-start">
                                                    <div class="avatar-group float-start flex-grow-1">
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Dan Gibson" data-bs-original-title="Dan Gibson">
                                                                <i class="fa-solid fa-user" style="font-size: 2rem"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="dropdown ms-2">
                                                    <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript: void(0);">Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger leave-team" data-id="5" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team" href="javascript: void(0);">Leave Team</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div>
                                                <h5 class="mb-1 font-size-17">Administrasi</h5>
                                                <p class="text-muted  font-size-13 mb-0">Halaman Administrasi</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="pb-2">
                            <h4 class="card-title mb-3">About</h4>
                            <p>Hi I'm Jansh, has been the industry's standard dummy text To an English person, it will seem like simplified.
                            </p>
                            <ul class="ps-3 mb-0">
                                <li>it will seem like simplified.</li>
                                <li>To achieve this, it would be necessary to have uniform pronunciation</li>
                            </ul>

                        </div>
                        <hr>
                        <div class="pt-2">
                            <h4 class="card-title mb-4">My Skill</h4>
                            <div class="d-flex gap-2 flex-wrap">
                                <span class="badge badge-soft-secondary p-2">HTML</span>
                                <span class="badge badge-soft-secondary p-2">Bootstrap</span>
                                <span class="badge badge-soft-secondary p-2">Scss</span>
                                <span class="badge badge-soft-secondary p-2">Javascript</span>
                                <span class="badge badge-soft-secondary p-2">React</span>
                                <span class="badge badge-soft-secondary p-2">Angular</span>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-4">PROFIL 
                                @if (session("role") == "siswa")
                                    SISWA
                                @elseif (session("role") == "instruktur")
                                INSTRUKTUR
                                @else
                                Admin
                                @endif
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        @if (session("role") == "siswa")
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
                                                <td>{{ $siswa->tgl_masuk }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Status Siswa</th>
                                                <td>{{ $siswa->status }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Aksi</th>
                                                <td>
                                                    <a href="/edit/profile/{{ $siswa->id_siswa}}" class="btn btn-primary btn-icon-split btn-sm">
                                                        <span class="icon text-white-50" style="margin-right: 10px;">
                                                            <i class="fas fa-pen"></i>
                                                        </span>
                                                        <span class="text" style="font-weight: bold">Ubah Profil</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @elseif (session("role") == "admin")
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{ $admin }}</td>
                                            <tr>
                                                <th scope="row">Aksi</th>
                                                <td>
                                                    <a href="" class="btn btn-primary btn-icon-split btn-sm">
                                                        <span class="icon text-white-50" style="margin-right: 10px;">
                                                            <i class="fas fa-pen"></i>
                                                        </span>
                                                        <span class="text" style="font-weight: bold">Ubah Profil</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tr>
                                        @elseif (session("role") == "instruktur")
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
                                            <td>{{ $instruktur->tgl_masuk_ins }}</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    @if (session("role" == "siswa"))
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-4">Pencapaian Materi </h4>
                            <ul class="list-unstyled work-activity mb-0">
                                <li class="work-item" data-date="2020-21">
                                    <h6 class="lh-base mb-0">Materi 1</h6>
                                    <p class="font-size-13 mb-2">Pelajaran 1</p>
                                    {{-- <p>To achieve this, it would be necessary to have uniform grammar, and more common words.</p> --}}
                                </li>
                                <li class="work-item" data-date="2019-20">
                                    <h6 class="lh-base mb-0">Materi 2</h6>
                                    <p class="font-size-13 mb-2">Pelajaran 2</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
    </script>
</body>

</html>