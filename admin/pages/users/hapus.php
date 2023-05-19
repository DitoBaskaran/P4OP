<?php 
$id_user = $_GET['id_user'];
$queryData = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'") or die(mysqli_error($conn));
$detailData = mysqli_fetch_array($queryData);

mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'")or die(mysqli_error($conn));
 
header("location:index.php?page=data-user&msg=hapus");
?>