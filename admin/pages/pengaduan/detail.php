<?php

$getNik = mysqli_escape_string($conn, $_GET['nik']);
$queryCekNik = mysqli_query($conn, "SELECT *, GROUP_CONCAT(pesan SEPARATOR '~') AS isi_pesan FROM pengaduan WHERE nik='$getNik' GROUP BY nik ORDER BY tgl_pengaduan DESC") or die(mysqli_error($conn));
$dataPengaduan = mysqli_fetch_array($queryCekNik);

if(mysqli_num_rows($queryCekNik) <= 0) {
    header('location: index.php?page=data-pengaduan&msg=not-found');
}

?>
<div class="container my-4">
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h5><i class="fa fa-eye" aria-hidden="true"></i> Halaman Detail Pengaduan</h5>
            <nav aria-label="breadcrumb" class="ms-4 ps-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Data Pengaduan</a></li>
                    <li class="breadcrumb-item" aria-current="page">Kelola Data Pengaduan</li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Data #<?php echo $_GET['nik']; ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">Detail Pengaduan <b>#<?php echo $_GET['nik']; ?></b></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h6>NIK : </h6>
                    <p><?php echo $getNik; ?></p>
                    <h6>Nama Pengadu : </h6>
                    <p><?php echo $dataPengaduan['nama']; ?></p>
                    <h6>No. Whatsapp Pengadu : </h6>
                    <p>
                        <?php
                            $ambilSatuAngka = substr($dataPengaduan['no_wa'], 0, 1);
                            if($ambilSatuAngka == '0') {
                                $hapusAngkaNol = substr($dataPengaduan['no_wa'], 1);
                                $dataPengaduan['no_wa'] = '62'.$hapusAngkaNol;
                                echo $dataPengaduan['no_wa'];
                            } else {
                                $dataPengaduan['no_wa'] = $dataPengaduan['no_wa'];
                                echo '+'.$dataPengaduan['no_wa'];
                            }
                        ?>
                        </br>
                        <a href="https://wa.me/<?php echo $dataPengaduan['no_wa']; ?>" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-send-o" aria-hidden="true"></i> Balas Via Whatsapp</a>
                    </p>
                    <h6>Jumlah Pesan Pengaduan : </h6>
                    <p>
                        <?php 
                        echo(count(explode('~', $dataPengaduan['isi_pesan'])));                            
                        ?>
                    </p>
                    <hr>
                </div>
                <div class="col-md-8">
                    <h6>Isi Pesan</h6>
                    <?php
                    
                        $pecahPesan = explode('~', $dataPengaduan['isi_pesan']);
                        echo '<ol>';
                        foreach ($pecahPesan as $key ) {
                            echo '<li>'.$key.'</li>';
                        }
                        echo '</ol>';
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>