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
      <div class="name-profile" style="margin-right: 10px;">Muhamad Ridwan Ash'shidqi</div>
      <a href="/logout" class="text-light"><i class="fa-solid fa-right-from-bracket"></i></a>
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
                                    <h4 class="text-primary mt-3 mb-2" style="font-size: 18px;">Muhamad Ridwan Ash'shidqi</h4>
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
                                                <p class="text-muted mb-2 fw-medium"><i class="mdi mdi-email-outline me-2"></i>{{ session('email') }}
                                                </p>
                                                <p class="text-muted fw-medium mb-0"><i class="mdi mdi-phone-in-talk-outline me-2"></i>082xxxxx
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs nav-tabs-custom border-bottom-0 mt-3 nav-justfied" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link px-4 active " data-bs-toggle="tab" href="#team-tab" role="tab" aria-selected="true">
                                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                <span class="d-none d-sm-block">Materi Pembelajaran</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a  class="nav-link px-4" href="">
                                                <span class="d-block d-sm-none"><i class="mdi mdi-menu-open"></i></span>
                                                <span class="d-none d-sm-block">Kuis</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link px-4" href="">
                                                <span class="d-block d-sm-none"><i class="mdi mdi-account-group-outline"></i></span>
                                                <span class="d-none d-sm-block">Presensi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link px-4" href="/halamanAdmin">
                                                <span class="d-block d-sm-none"><i class="mdi mdi-account-group-outline"></i></span>
                                                <span class="d-none d-sm-block">Administrasi</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="team-tab" role="tabpanel">
                            <h4 class="card-title mb-4">Team</h4>
                            <div class="row">
                                <div class="col-xl-4 col-md-6" id="team-1">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 align-items-start">
                                                    <div class="avatar-group float-start flex-grow-1">
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Terrell Soto">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Ruhi Shah">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-block" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Denny Silva">
                                                                <div class="avatar-sm">
                                                                    <div class="avatar-title rounded-circle bg-primary">
                                                                        D
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown ms-2">
                                                    <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript: void(0);">Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger leave-team" data-id="1" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team" href="javascript: void(0);">Leave Team</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 font-size-17">Marketing</h5>
                                                <p class="text-muted  font-size-13 mb-0">4 Projects</p>
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
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Julia Halsey" data-bs-original-title="Julia Halsey">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Ayaan Curry" data-bs-original-title="Ayaan Curry">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Jansh Wells" data-bs-original-title="Jansh Wells">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Denny Silva" data-bs-original-title="Denny Silva">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown ms-2">
                                                    <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript: void(0);">Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger leave-team" data-id="2" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team" href="javascript: void(0);">Leave
Team</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 font-size-17">Blog Template</h5>
                                                <p class="text-muted  font-size-13 mb-0">5 Projects</p>
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
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Julia Halsey" data-bs-original-title="Julia Halsey">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Ayaan Curry" data-bs-original-title="Ayaan Curry">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Ayaan Curry" data-bs-original-title="Ayaan Curry">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown ms-2">
                                                    <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript: void(0);">Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger leave-team" data-id="3" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team" href="javascript: void(0);">Leave
Team</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 font-size-17">Multipurpose Landing</h5>
                                                <p class="text-muted  font-size-13 mb-0">2 Projects</p>
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
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Jansh Wells" data-bs-original-title="Jansh Wells">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Hattie Bustos" data-bs-original-title="Hattie Bustos">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown ms-2">
                                                    <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript: void(0);">Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger leave-team" data-id="4" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team" href="javascript: void(0);">Leave
Team</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 font-size-17">Brand Logo Design</h5>
                                                <p class="text-muted font-size-13 mb-0">5 Projects</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6" id="team-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 align-items-start">
                                                    <div class="avatar-group float-start flex-grow-1">
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-block" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="James Ross">
                                                                <div class="avatar-sm">
                                                                    <div class="avatar-title rounded-circle bg-purple">
                                                                        J
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Jansh Wells" data-bs-original-title="Jansh Wells">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Dan Gibson" data-bs-original-title="Dan Gibson">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown ms-2">
                                                    <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript: void(0);">Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger leave-team" data-id="5" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team" href="javascript: void(0);">
Leave Team</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 font-size-17">Landing Page</h5>
                                                <p class="text-muted  font-size-13 mb-0">3 Projects</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6" id="team-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 align-items-start">
                                                    <div class="avatar-group float-start flex-grow-1">
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Terrell Soto" data-bs-original-title="Terrell Soto">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Ruhi Shah" data-bs-original-title="Ruhi Shah">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-block" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Denny Silva">
                                                                <div class="avatar-sm">
                                                                    <div class="avatar-title rounded-circle bg-primary">
                                                                        D
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Jansh Wells" data-bs-original-title="Jansh Wells">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown ms-2">
                                                    <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger leave-team" data-id="6" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team" href="javascript: void(0);">Leave
Team</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 font-size-17">New Create Admin UI</h5>
                                                <p class="text-muted  font-size-13 mb-0">1 Projects</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6" id="team-7">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 align-items-start">
                                                    <div class="avatar-group float-start flex-grow-1">
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Abel Owen" data-bs-original-title="Abel Owen">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Jansh Wells" data-bs-original-title="Jansh Wells">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="rounded-circle avatar-sm">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown ms-2">
                                                    <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript: void(0);">Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger leave-team" href="javascript: void(0);" data-id="7" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team">Leave Team</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 font-size-17">Creating Dashboard UI Kit</h5>
                                                <p class="text-muted  font-size-13 mb-0">6 Projects</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
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
                </div>
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-4">Personal Details</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>Jansh Wells</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Location</th>
                                            <td>California, United States</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Language</th>
                                            <td>English</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Website</th>
                                            <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="18797a7b292a58686a777a717b367b7775">[email&#160;protected]</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-4">Work Experince</h4>
                            <ul class="list-unstyled work-activity mb-0">
                                <li class="work-item" data-date="2020-21">
                                    <h6 class="lh-base mb-0">ABCD Company</h6>
                                    <p class="font-size-13 mb-2">Web Designer</p>
                                    <p>To achieve this, it would be necessary to have uniform grammar, and more common words.</p>
                                </li>
                                <li class="work-item" data-date="2019-20">
                                    <h6 class="lh-base mb-0">XYZ Company</h6>
                                    <p class="font-size-13 mb-2">Graphic Designer</p>
                                    <p class="mb-0">It will be as simple as occidental in fact, it will be Occidental person, it will seem like simplified.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
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