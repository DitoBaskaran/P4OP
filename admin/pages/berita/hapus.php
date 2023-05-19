<?php 
$id_berita = $_GET['id_berita'];
$queryData = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita='$id_berita'") or die(mysqli_error($conn));
$detailData = mysqli_fetch_array($queryData);

$files = glob('pages/berita/thumbnail/'.$detailData['thumbnail']);
foreach ($files as $file) {
    if (is_file($file))
    unlink($file); // hapus file
}

mysqli_query($conn, "DELETE FROM berita WHERE id_berita='$id_berita'")or die(mysqli_error($conn));
 
header("location:index.php?page=data-berita&msg=hapus");
?>