<?php
session_start();

if (!isset($_SESSION['data_session'])) {
    header('location: login.php');
} else {
    include '../mainconfig.php';
    include '../inc/header.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow" id="navbar-2">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="<?php echo $baseUrl; ?>assets/images/main_logo.png" alt="" width="43" height="43">
            <span class="text-primary">HALAMAN ADMIN</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="?page=dashboard">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="?page=data-panduan">Kelola Data Panduan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="?page=data-berita">Kelola Data Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="?page=data-user">Kelola Data User</a>
                </li>
                <li class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Lainnya
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="?page=data-pengaduan">Data Pengaduan</a></li>
                        <li><a class="dropdown-item" href="?page=data-pengaduan">Statistik Pengunjung</a></li>
                    </ul>
                </li>
                <li class="nav-item d-block d-sm-none">
                    <a class="nav-link" href="logout.php" onclick="return confirm('Yakin ingin keluar?')">
                        Keluar
                    </a>
                </li>
                <li class="nav-item d-none d-sm-block d-md-none">
                    <a class="nav-link" href="logout.php" onclick="return confirm('Yakin ingin keluar?')">
                        Keluar
                    </a>
                </li>
                <li class="nav-item d-none d-md-block d-lg-none">
                    <a class="nav-link" href="logout.php" onclick="return confirm('Yakin ingin keluar?')">
                        Keluar
                    </a>
                </li>
                <li class="nav-item d-none d-xl-block d-xxl-none">
                    <a class="nav-link bg-danger rounded-circle" href="logout.php" onclick="return confirm('Yakin ingin keluar?')">
                        <i class="fa fa-power-off text-white px-1" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block d-xl-none">
                    <a class="nav-link bg-danger rounded-circle" href="logout.php" onclick="return confirm('Yakin ingin keluar?')">
                        <i class="fa fa-power-off text-white px-1" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php

$page = $_GET['page'];

if($page == '' || $page == 'dashboard') {
    include 'pages/dashboard.php';
} elseif($page == 'data-panduan') {
    include 'pages/panduan/data-panduan.php';
} elseif($page == 'hapus-panduan') {
    include 'pages/panduan/hapus.php';
} elseif($page == 'edit-panduan') {
    include 'pages/panduan/edit.php';
} elseif($page == 'data-berita') {
    include 'pages/berita/data-berita.php';
} elseif($page == 'edit-berita') {
    include 'pages/berita/edit.php';
} elseif($page == 'hapus-berita') {
    include 'pages/berita/hapus.php';
} elseif($page == 'data-pengaduan') {
    include 'pages/pengaduan/data.php';
} elseif($page == 'detail-pengaduan') {
    include 'pages/pengaduan/detail.php';
} elseif($page == 'hapus-pengaduan') {
    include 'pages/pengaduan/hapus.php';
} elseif($page == 'data-user') {
    include 'pages/users/data.php';
} elseif($page == 'edit-pengguna') {
    include 'pages/users/edit.php';
} elseif($page == 'hapus-pengguna') {
    include 'pages/users/hapus.php';
} 

include '../inc/footer.php';
}
?>