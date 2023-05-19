<?php
$getId = mysqli_escape_string($conn, $_GET['id']);
$queryData = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$getId'") or die(mysqli_error($conn));

if (mysqli_num_rows($queryData) < 1)
{
    header('location: index.php?page=data-user&msg=not-found');
}

$detailData = mysqli_fetch_array($queryData);
?>
<div class="container my-4">
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h5><i class="fa fa-edit" aria-hidden="true"></i> Halaman Data User</h5>
            <nav aria-label="breadcrumb" class="ms-4 ps-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Data User</a></li>
                    <li class="breadcrumb-item" aria-current="page">Kelola Data User</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data User</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-primary text-white">
            Edit Data Pengguna
        </div>
        <div class="card-body">
            <form action="index.php?page=data-user" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id_user" value="<?= $detailData['id_user']; ?>">
                <div class="mb-3">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?php echo $detailData['nama_lengkap']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $detailData['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="no_telp">No. Telepon</label>
                    <input type="text" name="no_telp" id="no_telp"value="<?php echo $detailData['no_telp']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $detailData['username']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="konfirm_password">Konfirmasi Password</label>
                    <input type="password" name="konfirm_password" id="konfirm_password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="status">Status</label><br>
                    <input class="form-check-input" type="radio" name="status" value="On" id="status" <?php if($detailData['status'] == 'On') { echo 'checked';} ?>>
                    <label class="form-check-label" for="status1">
                        Aktif
                    </label>
                    <br>
                    <input class="form-check-input" type="radio" name="status" value="Off" id="status" <?php if($detailData['status'] == 'Off') { echo 'checked';} ?>>
                    <label class="form-check-label" for="status1">
                        Tidak Aktif
                    </label>
                </div>
                <hr>
                <div class="float-end">
                    <input type="reset" class="btn btn-danger" value="Ulangi">
                    <input type="submit" name="edit_data" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>