<?php 
$id_panduan = $_GET['id_panduan'];
$queryData = mysqli_query($conn, "SELECT * FROM data_panduan WHERE id_panduan='$id_panduan'") or die(mysqli_error($conn));
$detailData = mysqli_fetch_array($queryData);

$files = glob('dokumen_panduan/'.$detailData['nama_file']);
foreach ($files as $file) {
    if (is_file($file))
    unlink($file); // hapus file
}

mysqli_query($conn, "DELETE FROM data_panduan WHERE id_panduan='$id_panduan'")or die(mysqli_error($conn));
 
header("location:index.php?page=data-panduan&msg=hapus");
?>