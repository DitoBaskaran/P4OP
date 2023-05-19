<?php
session_start();

include '../mainconfig.php';
include '../inc/header.php';

if(isset($_SESSION['data_session'])) {
    header('location: index.php');
} else {

?>

<div class="container mb-5 " style="margin-top: 10%;">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?php

            if (isset($_POST['masuk'])) {
                $postUsername = mysqli_real_escape_string($conn, $_POST['username']);  
                $postPassword = mysqli_real_escape_string($conn, $_POST['password']);

                $postPassword = md5($postPassword);

                $queryUsers = mysqli_query($conn, "SELECT * FROM users WHERE username='$postUsername'") or die(mysqli_error($conn));
                $dataUsers = mysqli_fetch_array($queryUsers);

                if(empty($postUsername) || empty($postPassword)) {
                    $msgType = 'error';
                    $msgText = 'Inputan tidak boleh ada yang kosong.';
                } elseif(mysqli_num_rows($queryUsers) <= 0) {
                    $msgType = 'error';
                    $msgText = 'Username tidak terdaftar.';
                } elseif ($postPassword != $dataUsers['password']) {
                    $msgType = 'error';
                    $msgText = 'Username / Password Salah.';
                } elseif($dataUsers['status'] == 'On') {
                    $_SESSION['data_session'] = $dataUsers;
                    header('location: index.php');
                } else {
                    $msgType = 'error';
                    $msgText = 'Akun Anda belum aktif.';
                }

            }

            ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center text-uppercase">Halaman Masuk Admin</h5>
                    <hr>
                    <?php
                    
                    if ($msgType == 'error') {
                        ?>
                        <div class="alert alert-danger">
                            <?php echo $msgText; ?>
                        </div>
                        <?php
                    }
                    
                    ?>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
                        </div>  
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                        </div>  
                        <div class="text-center d-grid gap-2">
                            <input type="submit" class="btn btn-dark btn-block" name="masuk" value="Masuk">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<?php
}
?>