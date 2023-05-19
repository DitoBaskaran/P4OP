<div class="container my-4">
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h5><i class="fa fa-file" aria-hidden="true"></i> Halaman Data Panduan</h5>
            <nav aria-label="breadcrumb" class="ms-3 ps-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kelola Data Panduan</li>
                </ol>
            </nav>
        </div>
    </div>
    <?php
    
    if($_POST['submit']){
        $idUser = $_SESSION['data_session']['id_user'];
        $postJudul = mysqli_escape_string($conn, $_POST['judul_panduan']);

        $ekstensi_diperbolehkan	= array('pdf','docx', 'xlsx');
        $postFile = $_FILES['file_panduan']['name'];
        $x = explode('.', $postFile);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['file_panduan']['size'];
        $file_tmp = $_FILES['file_panduan']['tmp_name'];
        
        $postFile = 'DOC-'.time().$postFile;
        $tanggalUpload = date('Y-m-d h:m:s');

        $queryCekData = mysqli_query($conn, "SELECT * FROM data_panduan WHERE judul='$postJudul'") or die(mysqli_error($conn));

        if (empty($postJudul) || empty($postFile)) {
            $msgType = 'error';
            $msgText = "Gagal : Form tidak boleh kosong.";
        } elseif(mysqli_num_rows($queryCekData) >= 1) {
            $msgType = 'error';
            $msgText = "Gagal : Judul panduan sudah ada.";
        } elseif(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 5044070){			
                move_uploaded_file($file_tmp, 'dokumen_panduan/'.$postFile);
                $query = mysqli_query($conn, "INSERT INTO data_panduan VALUES(NULL, '$postJudul', '$postFile', '$tanggalUpload', '$idUser')") or die(mysqli_error($conn));
                if($query == TRUE){
                    $msgType = 'success';
                    $msgText = "Berhasil : Data dokumen berhasil diunggah.";
                }else{
                    $msgType = 'error';
                    $msgText = "Gagal : Data dokumen gagal diunggah.";
                }
            }else{
                $msgType = 'error';
                $msgText = "Gagal : Ukuran file lebih dari 5MB.";
            }
        } else {
            $msgType = 'error';
            $msgText = "Gagal : Ekstensi yang di izinkan PDF, DOCX, dan XLSX.";
        }
    } elseif (isset($_POST['edit'])) {
        $idUser = $_SESSION['data_session']['id_user'];
        $postIdPanduan = mysqli_escape_string($conn, $_POST['id_panduan']); 

        $querySelect = mysqli_query($conn, "SELECT * FROM data_panduan WHERE id_panduan='$postIdPanduan'") or die(mysqli_error($conn));
        $detailData = mysqli_fetch_array($querySelect);

        $postJudulPanduan = mysqli_escape_string($conn, $_POST['judul_panduan']); 

        $ekstensi_diperbolehkan	= array('pdf','docx', 'xlsx');
        $postFilePanduan = $_FILES['file_panduan']['name'];
        $x = explode('.', $postFilePanduan);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['file_panduan']['size'];
        $file_tmp = $_FILES['file_panduan']['tmp_name'];
        
        $postFilePanduan = 'DOC-'.time().$postFilePanduan;
        $tanggalUpload = date('Y-m-d h:m:s');

        $queryCekData = mysqli_query($conn, "SELECT * FROM data_panduan WHERE judul='$postJudulPanduan'") or die(mysqli_error($conn));

        if (empty($postJudulPanduan) || empty($postFilePanduan) || empty($postIdPanduan)) {
            $msgType = 'error';
            $msgText = "Gagal : Form tidak boleh kosong.";
        } elseif(mysqli_num_rows($queryCekData) >= 1) {
            $msgType = 'error';
            $msgText = "Gagal : Judul panduan sudah ada.";
        } elseif(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 5044070){			
                move_uploaded_file($file_tmp, 'dokumen_panduan/'.$postFilePanduan);
                $query = mysqli_query($conn, "UPDATE data_panduan SET judul='$postJudulPanduan', nama_file='$postFilePanduan', tanggal_upload='$tanggalUpload', id_user='$idUser' WHERE id_panduan='$postIdPanduan'") or die(mysqli_error($conn));
                if($query == TRUE){

                    $files = glob('dokumen_panduan/'.$detailData['nama_file']);
                    foreach ($files as $file) {
                        if (is_file($file))
                        unlink($file); // hapus file
                    }

                    $msgType = 'success';
                    $msgText = "Berhasil : Data dokumen berhasil diunggah.";
                }else{
                    $msgType = 'error';
                    $msgText = "Gagal : Data dokumen gagal diunggah.";
                }
            }else{
                $msgType = 'error';
                $msgText = "Gagal : Ukuran file lebih dari 5MB.";
            }
        } else {
            $msgType = 'error';
            $msgText = "Gagal : Ekstensi yang di izinkan PDF, DOCX, dan XLSX.";
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
                    <th>Judul Dokumen</th>
                    <th>Nama Dokumen</th>
                    <th>Waktu Upload</th>
                    <th>Pengelola</th>
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
                    
                    $data = mysqli_query($conn, "SELECT * FROM data_panduan INNER JOIN users ON data_panduan.id_user=users.id_user WHERE data_panduan.judul LIKE '%$postKeyword%' ORDER BY data_panduan.judul DESC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
     
                    $queryPanduan = mysqli_query($conn, "SELECT * FROM data_panduan INNER JOIN users ON data_panduan.id_user=users.id_user WHERE data_panduan.judul LIKE '%$postKeyword%' ORDER BY data_panduan.judul DESC LIMIT $halaman_awal, $batas");
                    $totalData = mysqli_num_rows($queryPanduan);
    
                    $no = $halaman_awal+1;
                    $menampilkanJumlahData = $halaman_awal+1;
                    $menampilkanUntukJumlahData = $halaman_awal+$totalData;

                } else {
                    
                    $batas = 10;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
    
                    $previous = $halaman - 1;
                    $next = $halaman + 1;
                    
                    $data = mysqli_query($conn, "SELECT * FROM data_panduan INNER JOIN users ON data_panduan.id_user=users.id_user ORDER BY data_panduan.judul DESC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
    
                    $queryPanduan = mysqli_query($conn, "SELECT * FROM data_panduan INNER JOIN users ON data_panduan.id_user=users.id_user ORDER BY data_panduan.judul DESC LIMIT $halaman_awal, $batas");
                    $totalData = mysqli_num_rows($queryPanduan);

                    $no = $halaman_awal+1;
                    $menampilkanJumlahData = $halaman_awal+1;
                    $menampilkanUntukJumlahData = $halaman_awal+$totalData;
                }

                if($totalData <= 0) {
                    $menampilkanJumlahData = 0;
                    $menampilkanUntukJumlahData = $halaman_awal+$totalData;
                    ?>
                    <tr>
                        <td colspan="6" class="text-center bg-danger text-white">Data tidak ditemukan.</td>
                    </tr>
                    <?php
                } elseif($totalData >= 0) {
                    while ($dataPanduan = mysqli_fetch_array($queryPanduan)) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no++; ?>.</td>
                        <td><?php echo $dataPanduan['judul']; ?></td>
                        <td><?php echo $dataPanduan['nama_file']; ?></td>
                        <td><?php echo $dataPanduan['tanggal_upload']; ?></td>
                        <td><?php echo $dataPanduan['nama_lengkap']; ?></td>
                        <td class="text-center">
                            <a href="?page=edit-panduan&id_panduan=<?php echo $dataPanduan['id_panduan']; ?>" class="btn btn-warning btn-sm me-1"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="?page=hapus-panduan&id_panduan=<?php echo $dataPanduan['id_panduan']; ?>" onclick="return confirm('Yakin ingin hapus data ini?');" class="btn btn-danger btn-sm me-1"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a href="<?php echo $baseUrl.'admin/dokumen_panduan/'.$dataPanduan['nama_file']; ?>" class="btn btn-dark btn-sm" download><i class="fa fa-download" aria-hidden="true"></i></a>
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
<div class="modal fade" id="modalTambahPanduan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Panduan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="POST">
                    <div class="mb-3">
                        <label for="judul_panduan">Judul Panduan</label>
                        <input type="text" name="judul_panduan" id="judul_panduan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="file_panduan">File Panduan</label>
                        <input type="file" name="file_panduan" id="file_panduan" class="form-control">
                        <span class="text-danger small">*File PDF, Word dan Excel (Maksimal 5MB)</span>
                    </div>
                    <hr>
                    <div class="float-end">
                        <input type="reset" class="btn btn-danger" value="Ulangi">
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>