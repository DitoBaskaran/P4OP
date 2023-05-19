<div class="container my-4">
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h5><i class="fa fa-question-circle" aria-hidden="true"></i> Halaman Data Pengaduan</h5>
            <nav aria-label="breadcrumb" class="ms-4 ps-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Data Pengaduan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kelola Data Pengaduan</li>
                </ol>
            </nav>
        </div>
    </div>
    <?php

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
            <div class="flex-grow-1 bd-highlight"></div>
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
                    <th>NIK</th>
                    <th>Nama Pengadu</th>
                    <th>No. Whatsapp Pengadu</th>
                    <th>Jumlah Pengaduan</th>
                    <th>Tanggal Pengaduan</th>
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
                    
                    $data = mysqli_query($conn, "SELECT *, GROUP_CONCAT(pesan SEPARATOR '~') AS isi_pesan FROM pengaduan GROUP BY nik ORDER BY tgl_pengaduan DESC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
    
                    $queryPengaduan = mysqli_query($conn, "SELECT *, GROUP_CONCAT(pesan SEPARATOR '~') AS isi_pesan FROM pengaduan GROUP BY nik ORDER BY tgl_pengaduan DESC LIMIT $halaman_awal, $batas");
                    $totalData = mysqli_num_rows($queryPengaduan);

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
                    while ($dataPengaduan = mysqli_fetch_array($queryPengaduan)) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no++; ?>.</td>
                        <td><?php echo $dataPengaduan['nik']; ?></td>
                        <td><?php echo $dataPengaduan['nama']; ?></td>
                        <td><?php echo $dataPengaduan['no_wa']; ?></td>
                        <td>
                            <?php 
                            echo(count(explode('~', $dataPengaduan['isi_pesan'])));                            
                            ?>
                        </td>
                        <td><?php echo $dataPengaduan['tgl_pengaduan']; ?></td>
                        <td class="text-center">
                            <a href="?page=hapus-pengaduan&id_pengaduan=<?php echo $dataPengaduan['id_pengaduan']; ?>" onclick="return confirm('Yakin ingin hapus data ini?');" class="btn btn-danger btn-sm me-1"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a href="?page=detail-pengaduan&nik=<?php echo $dataPengaduan['nik']; ?>" class="btn btn-dark btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
                <a class="page-link" <?php if($halaman > 1){ echo "href='?page=data-pengaduan&halaman=$Previous'"; } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php 
            for($x=1;$x<=$total_halaman;$x++){
                ?> 
                <li class="page-item <?php if($x == $_GET['halaman'] || $x == 1 && $_GET['halaman'] == ''){ echo 'active'; } ?>"><a class="page-link" href="?page=data-pengaduan&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php
            }
            ?>	
            <li class="page-item">
                <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?page=data-pengaduan&halaman=$next'"; } ?> aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>