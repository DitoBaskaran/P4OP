<div class="container my-4">
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h5><i class="fa fa-newspaper-o" aria-hidden="true"></i> Halaman Data Berita</h5>
            <nav aria-label="breadcrumb" class="ms-4 ps-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kelola Data Berita</li>
                </ol>
            </nav>
        </div>
    </div>
    <?php
    
    if($_POST['tambah-berita']){
        $postAuthor = $_SESSION['data_session']['id_user'];
        $postJudul = mysqli_escape_string($conn, $_POST['judul_berita']);
        $postKonten = mysqli_escape_string($conn, $_POST['konten']);

        $ekstensi_diperbolehkan	= array('jpg','jpeg', 'png');
        $postThumbnail = $_FILES['thumbnail']['name'];
        $x = explode('.', $postThumbnail);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['thumbnail']['size'];
        $file_tmp = $_FILES['thumbnail']['tmp_name'];
        
        $postThumbnail = 'THUMBNAIL-'.time().'.'.$ekstensi;
        $tanggalUpload = date('Y-m-d');

        $queryCekData = mysqli_query($conn, "SELECT * FROM berita WHERE judul_berita='$postJudul'") or die(mysqli_error($conn));

        if (empty($postJudul) || empty($postThumbnail) || empty($postKonten)) {
            $msgType = 'error';
            $msgText = "Gagal : Form tidak boleh kosong.";
        } elseif(mysqli_num_rows($queryCekData) >= 1) {
            $msgType = 'error';
            $msgText = "Gagal : Judul berita sudah ada.";
        } elseif(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 5044070){			
                move_uploaded_file($file_tmp, 'pages/berita/thumbnail/'.$postThumbnail);
                $query = mysqli_query($conn, "INSERT INTO berita VALUES(NULL, '$postJudul', '$postKonten', '$postThumbnail', '$postAuthor', '$tanggalUpload')") or die(mysqli_error($conn));
                if($query == TRUE){
                    $msgType = 'success';
                    $msgText = "Berhasil : Data berita berhasil diunggah.";
                }else{
                    $msgType = 'error';
                    $msgText = "Gagal : Data berita gagal diunggah.";
                }
            }else{
                $msgType = 'error';
                $msgText = "Gagal : Ukuran thumbnail lebih dari 5MB.";
            }
        } else {
            $msgType = 'error';
            $msgText = "Gagal : Ekstensi yang di izinkan JPG, JPEG, atau PNG.";
        }
    } elseif (isset($_POST['simpan'])) {
        $idUser = $_SESSION['data_session']['id_user'];
        $postIdBerita = mysqli_escape_string($conn, $_POST['id_berita']); 

        $querySelect = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita='$postIdBerita'") or die(mysqli_error($conn));
        $detailData = mysqli_fetch_array($querySelect);

        $postJudulBerita = mysqli_escape_string($conn, $_POST['judul_berita']); 
        $postKonten = mysqli_escape_string($conn, $_POST['konten']); 

        $ekstensi_diperbolehkan	= array('png','jpg', 'jpeg');
        $postThumbnail = $_FILES['thumbnail']['name'];
        $x = explode('.', $postThumbnail);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['thumbnail']['size'];
        $file_tmp = $_FILES['thumbnail']['tmp_name'];
        
        $postThumbnail = 'THUMBNAIL-'.time().'.'.$ekstensi;
        $tanggalUpload = date('Y-m-d');

        $queryCekData = mysqli_query($conn, "SELECT * FROM berita WHERE judul_berita='$postJudulBerita'") or die(mysqli_error($conn));

        if (empty($postJudulBerita) || empty($postThumbnail) || empty($postIdBerita) || empty($postKonten)) {
            $msgType = 'error';
            $msgText = "Gagal : Form tidak boleh kosong.";
        } elseif(mysqli_num_rows($queryCekData) >= 1) {
            $msgType = 'error';
            $msgText = "Gagal : Judul berita sudah ada.";
        } elseif(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 5044070){			
                $query = mysqli_query($conn, "UPDATE berita SET judul_berita='$postJudulBerita', konten='$postKonten', thumbnail='$postThumbnail', author='$idUser', created_at='$tanggalUpload' WHERE id_berita='$postIdBerita'") or die(mysqli_error($conn));
                if($query == TRUE){
                    move_uploaded_file($file_tmp, 'pages/berita/thumbnail/'.$postThumbnail);
                    $files = glob('pages/berita/thumbnail/'.$detailData['thumbnail']);
                    foreach ($files as $file) {
                        if (is_file($file))
                        unlink($file); // hapus file
                    }

                    $msgType = 'success';
                    $msgText = "Berhasil : Data berita berhasil diunggah.";
                }else{
                    $msgType = 'error';
                    $msgText = "Gagal : Data berita gagal diunggah.";
                }
            }else{
                $msgType = 'error';
                $msgText = "Gagal : Ukuran file lebih dari 5MB.";
            }
        } else {
            $msgType = 'error';
            $msgText = "Gagal : Ekstensi yang di izinkan PNG, JPG, atau JPEG.";
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
                <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPanduan"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</a>
            </div>
            <div class="bd-highlight me-2">
                <input type="text" name="keyword" placeholder="Masukkan judul..." class="form-control form-control-sm" style="min-width: 250px;">
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
                    <th>Judul Berita</th>
                    <th>Waktu Terbit</th>
                    <th>Penerbit</th>
                    <th>Thumbnail</th>
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
                    
                    $data = mysqli_query($conn, "SELECT * FROM berita INNER JOIN users ON berita.author=users.id_user WHERE berita.judul_berita LIKE '%$postKeyword%' ORDER BY berita.id_berita DESC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
     
                    $queryBerita = mysqli_query($conn, "SELECT * FROM berita INNER JOIN users ON berita.author=users.id_user WHERE berita.judul_berita LIKE '%$postKeyword%' ORDER BY berita.id_berita DESC LIMIT $halaman_awal, $batas");
                    $totalData = mysqli_num_rows($queryBerita);
    
                    $no = $halaman_awal+1;
                    $menampilkanJumlahData = $halaman_awal+1;
                    $menampilkanUntukJumlahData = $halaman_awal+$totalData;

                } else {
                    
                    $batas = 10;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
    
                    $previous = $halaman - 1;
                    $next = $halaman + 1;
                    
                    $data = mysqli_query($conn, "SELECT * FROM berita INNER JOIN users ON berita.author=users.id_user ORDER BY berita.id_berita DESC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
    
                    $queryBerita = mysqli_query($conn, "SELECT * FROM berita INNER JOIN users ON berita.author=users.id_user ORDER BY berita.id_berita DESC LIMIT $halaman_awal, $batas");
                    $totalData = mysqli_num_rows($queryBerita);

                    $no = $halaman_awal+1;
                    $menampilkanJumlahData = $halaman_awal+1;
                    $menampilkanUntukJumlahData = $halaman_awal+$totalData;
                }

                if($totalData <= 0) {
                    $menampilkanJumlahData = 0;
                    $menampilkanUntukJumlahData = $halaman_awal+$totalData;
                    ?>
                    <tr>
                        <td colspan="7" class="text-center bg-danger text-white">Data tidak ditemukan.</td>
                    </tr>
                    <?php
                } elseif($totalData >= 0) {
                    while ($dataBerita = mysqli_fetch_array($queryBerita)) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no++; ?>.</td>
                        <td><?php echo $dataBerita['judul_berita']; ?></td>
                        <td>
                        <?php
                                        
                            $pecahTanggal = explode('-', $dataBerita['created_at']);
                            $hari = $pecahTanggal[2];
                            $tahun = $pecahTanggal[0];
                            if ($pecahTanggal[1] == '01') {
                                $bulan = 'Januari';
                            } elseif ($pecahTanggal[1] == '02') {
                                $bulan = 'Februari';
                            } elseif ($pecahTanggal[1] == '03') {
                                $bulan = 'Maret';
                            } elseif ($pecahTanggal[1] == '04') {
                                $bulan = 'April';
                            } elseif ($pecahTanggal[1] == '05') {
                                $bulan = 'Mei';
                            } elseif ($pecahTanggal[1] == '06') {
                                $bulan = 'Juni';
                            } elseif ($pecahTanggal[1] == '07') {
                                $bulan = 'Juli';
                            } elseif ($pecahTanggal[1] == '08') {
                                $bulan = 'Agustus';
                            } elseif ($pecahTanggal[1] == '09') {
                                $bulan = 'September';
                            } elseif ($pecahTanggal[1] == '10') {
                                $bulan = 'Oktober';
                            } elseif ($pecahTanggal[1] == '11') {
                                $bulan = 'November';
                            } elseif ($pecahTanggal[1] == '12') {
                                $bulan = 'Desember';
                            } 

                            echo $hari . ' ' . $bulan . ' ' . $tahun . ' WIB';
                            
                            
                            ?>
                        </td>
                        <td><?php echo $dataBerita['nama_lengkap']; ?></td>
                        <td class="text-center">
                            <img src="<?php echo $baseUrl.'admin/pages/berita/thumbnail/'.$dataBerita['thumbnail']; ?>" alt="Thumbnail" class="img img-responsive" width="100px">
                        </td>
                        <td class="text-center">
                            <a href="?page=edit-berita&id_berita=<?php echo $dataBerita['id_berita']; ?>" class="btn btn-warning btn-sm me-1"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="?page=hapus-berita&id_berita=<?php echo $dataBerita['id_berita']; ?>" onclick="return confirm('Yakin ingin hapus data ini?');" class="btn btn-danger btn-sm me-1"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a href="<?php echo $baseUrl.'?page=baca-berita&judul='.$dataBerita['judul_berita']; ?>" target="_blank" class="btn btn-dark btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
                <a class="page-link" <?php if($halaman > 1){ echo "href='?page=data-berita&halaman=$Previous'"; } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php 
            for($x=1;$x<=$total_halaman;$x++){
                ?> 
                <li class="page-item <?php if($x == $_GET['halaman'] || $x == 1 && $_GET['halaman'] == ''){ echo 'active'; } ?>"><a class="page-link" href="?page=data-berita&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php
            }
            ?>	
            <li class="page-item">
                <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?page=data-berita&halaman=$next'"; } ?> aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTambahPanduan" tabindex="-1" aria-labelledby="modalTambahBerita" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahBerita">Tambah Data Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="POST">
                    <div class="mb-3">
                        <label for="judul_berita">Judul Berita</label>
                        <input type="text" name="judul_berita" id="judul_berita" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                        <span class="text-danger small">*File JPG, JPEG atau PNG 360x360 (Maksimal 5MB)</span>
                    </div>
                    <div class="mb-3">
                        <label for="form-ckeditor">Konten Berita</label>
                        <textarea name="konten" id="form-ckeditor"></textarea>
                    </div>
                    <input type="hidden" id="auhtor" class="form-control" name="author" value="<?php echo $_SESSION['data_session']['id_user'] ?>" readonly>
                    <hr>
                    <div class="float-end">
                        <input type="reset" class="btn btn-danger" value="Ulangi">
                        <input type="submit" name="tambah-berita" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>