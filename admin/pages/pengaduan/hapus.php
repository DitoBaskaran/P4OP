<?php 
$id_pengaduan = $_GET['id_pengaduan'];
$queryData = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan='$id_pengaduan'") or die(mysqli_error($conn));
$detailData = mysqli_fetch_array($queryData);

mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan='$id_pengaduan'")or die(mysqli_error($conn));
 
header("location:index.php?page=data-pengaduan&msg=hapus");
?>