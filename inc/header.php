<?php

include 'mainconfig.php';

// Mendapatkan informasi sistem operasi
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$os_platform  = "Tidak ditemukan";
$os_array     = array(
  '/windows nt 10/i'      =>  'Windows 10',
  '/windows nt 6.3/i'     =>  'Windows 8.1',
  '/windows nt 6.2/i'     =>  'Windows 8',
  '/windows nt 6.1/i'     =>  'Windows 7',
  '/windows nt 6.0/i'     =>  'Windows Vista',
  '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
  '/windows nt 5.1/i'     =>  'Windows XP',
  '/windows xp/i'         =>  'Windows XP',
  '/windows nt 5.0/i'     =>  'Windows 2000',
  '/windows me/i'         =>  'Windows ME',
  '/win98/i'              =>  'Windows 98',
  '/win95/i'              =>  'Windows 95',
  '/win16/i'              =>  'Windows 3.11',
  '/macintosh|mac os x/i' =>  'Mac OS X',
  '/mac_powerpc/i'        =>  'Mac OS 9',
  '/linux/i'              =>  'Linux',
  '/ubuntu/i'             =>  'Ubuntu',
  '/iphone/i'             =>  'iPhone OS',
  '/ipod/i'               =>  'iPod OS',
  '/ipad/i'               =>  'iPad OS',
  '/android/i'            =>  'Android',
  '/blackberry/i'         =>  'BlackBerry',
  '/webos/i'              =>  'Mobile'
);

foreach ($os_array as $regex => $value) {
  if (preg_match($regex, $user_agent)) {
    $os_platform = $value;
  }
}

// Mendapatkan alamat IP
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $ip_address = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
  $ip_address = $_SERVER['REMOTE_ADDR'];
}

// Mendapatkan informasi browser
$browser = $_SERVER['HTTP_USER_AGENT'];

// Mengecek apakah alamat IP sudah ada dalam database dengan tanggal yang sama
$resultQueryPengunjung = mysqli_query($conn, "SELECT * FROM pengunjung WHERE ip_address='$ip_address' AND visited_at='$date'");

if (mysqli_num_rows($resultQueryPengunjung) <= 0) {
  // apabila ip blm ada
  $queryTambahPengunjung = "INSERT INTO pengunjung VALUES (NULL, '$ip_address', '$user_agent', '$os_platform', '$browser', '$date')";
  mysqli_query($conn, $queryTambahPengunjung);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?php echo $baseUrl; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>assets/custom.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>assets/aos/aos.css" rel="stylesheet">
    <script src="<?php echo $baseUrl; ?>assets/ckeditor/ckeditor.js"></script>

    <!-- FONTAWESOME 5 -->
    <script src="https://kit.fontawesome.com/40b468ca5e.js" crossorigin="anonymous"></script>

    <title>Dinas Pendidikan P4OP</title>
  </head>
  <body>