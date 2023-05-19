<?php
include "./inc/header.php";
include "./inc/navbar.php";

$page = @$_GET['page'];

if($page == 'beranda' || $page == '') {
	include './inc/pages/dashboard.php';
} elseif($page == 'kjp-plus') {
	include './inc/pages/kjpplus.php';
} elseif($page == 'kjmu') {
	include './inc/pages/kjmu.php';
} elseif($page == 'bpms') {
	include './inc/pages/bpms.php';
} elseif($page == 'beasiswa-anak-nakes') {
	include './inc/pages/beasiswa-anak-nakes.php';
} elseif($page == 'kasubag-tu') {
	include './inc/pages/kasubag-tu.php';
} elseif($page == 'berita-pengumuman') {
	include './inc/pages/berita-pengumuman.php';
} elseif($page == 'hubungi-kami') {
	include './inc/pages/hubungi-kami.php';
} elseif($page == 'profil') {
	include './inc/pages/profil.php';
} elseif($page == 'baca-berita') {
	include './inc/pages/baca-berita.php';
} 

include "./inc/footer.php";
?>