<div class="container my-4">
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h5><i class="fa fa-question-circle" aria-hidden="true"></i> Halaman Data User</h5>
            <nav aria-label="breadcrumb" class="ms-4 ps-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Data User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kelola Data User</li>
                </ol>
            </nav>
        </div>
    </div>
    <?php
    
    if (isset($_POST['tambah_data'])) {
        
        $postNama = mysqli_escape_string($conn, $_POST['nama_lengkap']);
        $postEmail = mysqli_escape_string($conn, $_POST['email']);
        $postNoTelp = mysqli_escape_string($conn, $_POST['no_telp']);
        $postUsername = mysqli_escape_string($conn, $_POST['username']);
        $postPassword = mysqli_escape_string($conn, md5($_POST['password']));
        $postKonfirmPassword = mysqli_escape_string($conn, md5($_POST['konfirm_password']));

        $queryUsername = mysqli_query($conn, "SELECT * FROM users WHERE username='$postUsername'") or die(mysqli_error($conn));
        $queryEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$postEmail'") or die(mysqli_error($conn));
        $queryNoTelp = mysqli_query($conn, "SELECT * FROM users WHERE no_telp='$postNoTelp'") or die(mysqli_error($conn));

        if(empty($postNama) || empty($postEmail) || empty($postNoTelp) || empty($postUsername) || empty($postPassword) || empty($postKonfirmPassword))
        {
            $msgType = 'error';
            $msgText = 'Form masih ada yang kosong.';
        } elseif ($postPassword != $postKonfirmPassword) 
        {
            $msgType = 'error';
            $msgText = 'Konfirmasi password tidak sama.';
        } elseif (mysqli_num_rows($queryUsername) > 0)
        {
            $msgType = 'error';
            $msgText = 'Username sudah terdaftar.';
        } elseif(mysqli_num_rows($queryEmail) > 0)
        {
            $msgType = 'error';
            $msgText = 'Email sudah terdaftar.';
        } elseif(mysqli_num_rows($queryNoTelp) > 0)
        {
            $msgType = 'error';
            $msgText = 'Nomor telepon sudah terdaftar.';
        } else
        {
            $queryInsertUser = mysqli_query($conn, "INSERT INTO users VALUES('', '$postEmail', '$postNoTelp', '$postNama', '$postUsername', '$postPassword', 'On', 'Admin')") or die(mysqli_error($conn));
            if($queryInsertUser == TRUE)
            {
                $msgType = 'success';
                $msgText = 'Berhasil tambah data.';
            } else
            {
                $msgType = 'error';
                $msgText = 'Gagal tambah data.';
            }
        }
    } elseif(isset($_POST['edit_data']))
    {

        $postIdUser = mysqli_escape_string($conn, $_POST['id_user']);

        $postNama = mysqli_escape_string($conn, $_POST['nama_lengkap']);
        $postEmail = mysqli_escape_string($conn, $_POST['email']);
        $postNoTelp = mysqli_escape_string($conn, $_POST['no_telp']);
        $postUsername = mysqli_escape_string($conn, $_POST['username']);
        $postPassword = mysqli_escape_string($conn, md5($_POST['password']));
        $postKonfirmPassword = mysqli_escape_string($conn, md5($_POST['konfirm_password']));
        $postStatus = mysqli_escape_string($conn, $_POST['status']);
        
        $queryUsername = mysqli_query($conn, "SELECT * FROM users WHERE username='$postUsername' AND id_user NOT IN($postIdUser)") or die(mysqli_error($conn));
        $queryEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$postEmail' AND id_user NOT IN($postIdUser)") or die(mysqli_error($conn));
        $queryNoTelp = mysqli_query($conn, "SELECT * FROM users WHERE no_telp='$postNoTelp' AND id_user NOT IN($postIdUser)") or die(mysqli_error($conn));

        if(empty($postNama) || empty($postEmail) || empty($postNoTelp) || empty($postUsername))
        {
            $msgType = 'error';
            $msgText = 'Form masih ada yang kosong.';
        } elseif ($postPassword != $postKonfirmPassword) 
        {
            $msgType = 'error';
            $msgText = 'Konfirmasi password tidak sama.';
        } elseif (mysqli_num_rows($queryUsername) > 0)
        {
            $msgType = 'error';
            $msgText = 'Username sudah terdaftar.';
        } elseif(mysqli_num_rows($queryEmail) > 0)
        {
            $msgType = 'error';
            $msgText = 'Email sudah terdaftar.';
        } elseif(mysqli_num_rows($queryNoTelp) > 0)
        {
            $msgType = 'error';
            $msgText = 'Nomor telepon sudah terdaftar.';
        } elseif(empty($postPassword) && empty($postKonfirmPassword))
        {
            $queryUpdate = mysqli_query($conn, "UPDATE users SET email='$postEmail', no_telp='$postNoTelp', nama_lengkap='$postNama', username='$postUsername',  status='$postStatus'WHERE id_user='$postIdUser'") or die(mysqli_error($conn));
            if($queryUpdate == TRUE)
            {
                $msgType = 'success';
                $msgText = 'Berhasil ubah data.';
            } else
            {
                $msgType = 'error';
                $msgText = 'Gagal ubah data.';
            }
        }  else
        {
            $queryUpdate = mysqli_query($conn, "UPDATE users SET email='$postEmail', no_telp='$postNoTelp', nama_lengkap='$postNama', username='$postUsername', status='$postStatus', password='$postPassword' WHERE id_user='$postIdUser'") or die(mysqli_error($conn));
            if($queryUpdate == TRUE)
            {
                $msgType = 'success';
                $msgText = 'Berhasil ubah data.';
            } else
            {
                $msgType = 'error';
                $msgText = 'Gagal ubah data.';
            }
        }
    }

    if ($msgType == 'error' || $_GET['msg'] == 'not-found') {
        ?>
        <div class="alert alert-danger">
            <?php 
            if ($_GET['msg'] == 'not-found') {
                echo 'Data tidak ditemukan.';
            } else {
                echo $msgText;
            }
            ?>
        </div>
        <?php
    } elseif($msgType == 'success' || $_GET['msg'] == 'hapus') {
        ?>
        <div class="alert alert-success">
            <?php
                if($_GET['msg'] == 'hapus') {
                    echo "Data berhasil dihapus.";
                } else {
                    echo $msgText;
                }
            ?>
        </div>
        <?php
    }
    
    ?>
    <form action="" method="POST">
        <div class="d-flex bd-highlight">
            <div class="flex-grow-1 bd-highlight">
                <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahUser"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</a>
            </div>
            <div class="bd-highlight me-2">
                <input type="text" name="keyword" placeholder="Masukkan NIK..." class="form-control form-control-sm" style="min-width: 250px;">
            </div>
            <div class="bd-highlight">
                <button type="submit" name="cari" class="btn btn-dark btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
    <div class="table table-responsive mt-3">
        <table class="table table-hover table-bordered small" width="100%">
            <thead class="bg-orange text-white">
                <tr class="text-center">
                    <th>#</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if (isset($_POST['cari'])) {
                    $postKeyword = mysqli_escape_string($conn, $_POST['keyword']);

                    $batas = 10;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
     
                    $previous = $halaman - 1;
                    $next = $halaman + 1;
                    
                    $data = mysqli_query($conn, "SELECT *, GROUP_CONCAT(pesan SEPARATOR '~') AS isi_pesan FROM pengaduan WHERE nik LIKE '%$postKeyword%' GROUP BY nik ORDER BY tgl_pengaduan DESC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
     
                    $queryPengaduan = mysqli_query($conn, "SELECT *, GROUP_CONCAT(pesan SEPARATOR '~') AS isi_pesan FROM pengaduan WHERE nik LIKE '%$postKeyword%' GROUP BY nik ORDER BY tgl_pengaduan DESC LIMIT $halaman_awal, $batas");
                    $totalData = mysqli_num_rows($queryPengaduan);
    
                    $no = $halaman_awal+1;
                    $menampilkanJumlahData = $halaman_awal+1;
                    $menampilkanUntukJumlahData = $halaman_awal+$totalData;

                } else {
                    
                    $batas = 10;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
    
                    $previous = $halaman - 1;
                    $next = $halaman + 1;
                    
                    $data = mysqli_query($conn, "SELECT * FROM users ORDER BY nama_lengkap DESC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
    
                    $queryUsers = mysqli_query($conn, "SELECT * FROM users WHERE  level NOT IN('Super Admin') ORDER BY nama_lengkap DESC LIMIT $halaman_awal, $batas");
                    $totalData = mysqli_num_rows($queryUsers);

                    $no = $halaman_awal+1;
                    $menampilkanJumlahData = $halaman_awal+1;
                    $menampilkanUntukJumlahData = $halaman_awal+$totalData;
                }

                if($totalData <= 0) {
                    $menampilkanJumlahData = 0;
                    $menampilkanUntukJumlahData = $halaman_awal+$totalData;
                    ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data.</td>
                    </tr>
                    <?php
                } elseif($totalData >= 0) {
                    while ($dataUsers = mysqli_fetch_array($queryUsers)) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no++; ?>.</td>
                        <td><?php echo $dataUsers['nama_lengkap']; ?></td>
                        <td><?php echo $dataUsers['username']; ?></td>
                        <td><?php echo $dataUsers['email']; ?></td>
                        <td>
                            <?php 
                            echo $dataUsers['no_telp'];
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                            
                            if($dataUsers['status'] == 'On') {
                                echo '<i class="fa fa-check text-success"></i>';
                            } elseif($dataUsers['status'] == 'Off') {
                                echo '<i class="fa fa-close text-danger"></i>';
                            }
                            
                            ?>
                        </td>
                        <td class="text-center">
                            <a href="?page=edit-pengguna&id=<?php echo $dataUsers['id_user']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="?page=hapus-pengguna&id_user=<?php echo $dataUsers['id_user']; ?>" onclick="return confirm('Yakin ingin hapus data ini?');" class="btn btn-danger btn-sm me-1"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <?php } }?>
            </tbody>
        </table>
    </div>
    <p class="text-center small">
        <?php echo 'Menampilkan ' .$menampilkanJumlahData. ' untuk ' . $menampilkanUntukJumlahData . ' dari ' . $totalData; ?> data
    </p>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if($halaman > 1){ echo "href='?page=data-panduan&halaman=$Previous'"; } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php 
            for($x=1;$x<=$total_halaman;$x++){
                ?> 
                <li class="page-item <?php if($x == $_GET['halaman'] || $x == 1 && $_GET['halaman'] == ''){ echo 'active'; } ?>"><a class="page-link" href="?page=data-panduan&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php
            }
            ?>	
            <li class="page-item">
                <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?page=data-panduan&halaman=$next'"; } ?> aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="POST">
                    <div class="mb-3">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp">No. Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="konfirm_password">Konfirmasi Password</label>
                        <input type="password" name="konfirm_password" id="konfirm_password" class="form-control" required>
                    </div>
                    <hr>
                    <div class="float-end">
                        <input type="reset" class="btn btn-danger" value="Ulangi">
                        <input type="submit" name="tambah_data" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>