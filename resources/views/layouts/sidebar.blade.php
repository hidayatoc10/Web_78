<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard &mdash; {{ auth()->user()->name }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../vendor/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="../vendor/chart.js/Chart.min.css">
    <link rel="stylesheet" href="../assets/css/style.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-override.min.css">
    <link rel="stylesheet" id="theme-color" href="../assets/css/dark.min.css">
    <link rel="stylesheet" href="../vendor/izitoast/css/iziToast.min.css">

</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>
        <header class="header-navbar fixed">
            <div class="header-wrapper">
                <div class="header-left">
                    <div class="sidebar-toggle action-toggle" style="margin-right: 10px">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="fullscreen-toggle action-toggle">
                        <i class="fas fa-expand"></i>
                    </div>
                </div>
                <div class="header-content">
                    <div class="theme-switch-icon"></div>
                    <div class="dropdown dropdown-menu-end">
                        <a href="" class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="label">
                                <span></span>
                                <div>{{ auth()->user()->name }}</div>
                            </div>
                            <img class="img-user" src="../assets/images/avatar1.png" alt="user">
                        </a>
                        <ul class="dropdown-menu small">
                            <li class="menu-content ps-menu">
                                <a href="#">
                                    <div class="description">
                                        <i class="ti-user"></i> Profile
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="description">
                                        <i class="ti-settings"></i> Setting
                                    </div>
                                </a>
                                <a href="/logoutAdmin">
                                    <div class="description">
                                        <i class="ti-power-off"></i> Logout
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <nav class="main-sidebar ps-menu">
            <div class="sidebar-header">
                <div class="text"><img src="../assets/images/logo.png" style="width: 70%" alt=""
                        srcset=""></div>
                <div class="close-sidebar action-toggle">
                    <i class="ti-close"></i>
                </div>
            </div>
            <div class="sidebar-content">
                <ul>
                    <li class="active">
                        <a href="dashboard_admin" class="link">
                            <i class="ti-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-category">
                        <span class="text-uppercase">User Interface</span>
                    </li>
                    <li>
                        <a href="#" class="main-menu has-dropdown">
                            <i class="ti-desktop"></i>
                            <span>UI Elements</span>
                        </a>
                        <ul class="sub-menu ">
                            <li><a href="data_kelas" class="link"><span>Kelas</span></a></li>
                            <li><a href="mata_pelajaran" class="link"><span>Mata Pelajaran</span></a></li>
                            <li><a href="siswa" class="link"><span>Siswa</span></a></li>
                            <li><a href="guru" class="link"><span>Guru</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="main-menu has-dropdown">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Guru</span>
                        </a>
                        <ul class="sub-menu ">
                            <li><a href="materii" class="link"><span>Materi</span></a></li>
                            <li><a href="tugass" class="link"><span>Tugas</span></a></li>
                            <li><a href="element-tabs-collapse.html" class="link"><span>Laporan</span></a></li>
                        </ul>
                    </li>
                    <li class="menu-category">
                        <span class="text-uppercase">SETTING</span>
                    </li>
                    <li>
                        <a href="charts.html" class="link">
                            <i class="ti-pencil-alt"></i>
                            <span>Edit Profil</span>
                        </a>
                    </li>
                    <li>
                        <a href="pengguna_sistem" class="link">
                            <i class="ti-user"></i>
                            <span>Pengguna Sistem</span>
                        </a>
                    </li>
                    <li>
                        <a href="akun_saya" class="link">
                            <i class="ti-settings"></i>
                            <span>Akun Saya</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        @yield('container')
        @yield('scripts')

        <footer>
            SMA NEGERI 78 JAKARTA
        </footer>
        <div class="overlay action-toggle">
        </div>
    </div>
    <script src="../vendor/ckeditor/ckeditor.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../assets/js/pages/index.min.js"></script>
    <script src="../assets/js/main.min.js"></script>
    <script src="../vendor/izitoast/js/iziToast.min.js"></script>
    <script src="../vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../assets/js/pages/alert.min.js"></script>
    <script>
        Main.init()
    </script>
    <script>
        document.querySelector('.fullscreen-toggle').addEventListener('click', () => {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        });
    </script>
    <style>
        .header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-toggle {
            cursor: pointer;
        }
    </style>
</body>

</html>
