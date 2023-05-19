<?php

$judul_berita = mysqli_escape_string($conn, $_GET['judul']);
$queryDetailBerita = mysqli_query($conn, "SELECT * FROM berita WHERE judul_berita='$judul_berita'") or die(mysqli_error($conn));
$detailBerita = mysqli_fetch_array($queryDetailBerita);

?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 mb-3">
            <h4 class="text-uppercase fw-bold"><?php echo $detailBerita['judul_berita']; ?></h4>
            <span class="text-muted small">
                <i class="fa fa-clock-o" aria-hidden="true"></i> 
                <?php
                                    
                    $pecahTanggal = explode('-', $detailBerita['created_at']);
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
            </span>
            <div class="mx-auto my-4">
                <center>
                    <img class="rounded mx-auto text-center justify-content-center img-fluid" src="<?php echo $baseUrl.'admin/pages/berita/thumbnail/'.$detailBerita['thumbnail']; ?>" alt="">
                </center>
            </div>
            <?php echo $detailBerita['konten']; ?>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header bg-orange">
                    <span class="fw-bold text-white">BERITA LAINNYA</span>
                </div>
                <div class="card-body pb-4" style="margin-top: -20px !important;">
                
                    <?php
                    
                    $queryBeritaLainnya = mysqli_query($conn, "SELECT * FROM berita WHERE judul_berita NOT IN('$judul_berita') LIMIT 5") or die(mysqli_error($conn));
                    while($detailBeritaLainnya = mysqli_fetch_array($queryBeritaLainnya)) {
                    
                    ?>
                    <a href="?page=baca-berita&judul=<?php echo strtolower($detailBeritaLainnya['judul_berita']); ?>" class="box-konten ps-3 small text-decoration-none text-dark anchor-effect">
                        <div class="row g-0">
                            <div class="col-2 my-auto">
                                <center>
                                    <img src="<?php echo $baseUrl.'admin/pages/berita/thumbnail/'.$detailBeritaLainnya['thumbnail']; ?>" class="img-fluid rounded" alt="...">
                                </center>
                            </div>
                            <div class="col-10 ps-2">
                                <h6><?php echo $detailBeritaLainnya['judul_berita']; ?></h6>
                                <span class="text-muted small">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                    <?php
                                                        
                                        $pecahTanggal = explode('-', $detailBeritaLainnya['created_at']);
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
                                </span>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-dark">
                    <span class="fw-bold text-white">BERITA REKOMENDASI</span>
                </div>
                <div class="card-body pb-4" style="margin-top: -20px !important;">
                    <?php
                    $queryBeritaRekomendasi = mysqli_query($conn, "SELECT * FROM berita WHERE judul_berita NOT IN('$judul_berita', '$ambilBeritaLainnya[judul_berita]') ORDER BY RAND() LIMIT 5") or die(mysqli_error($conn));
                    while ($detailBeritaRekomendasi = mysqli_fetch_array($queryBeritaRekomendasi)) {
                    
                    ?>
                    <a href="?page=baca-berita&judul=<?php echo strtolower($detailBeritaRekomendasi['judul_berita']); ?>" class="box-konten ps-3 small text-decoration-none text-dark anchor-effect">
                        <div class="row g-0">
                            <div class="col-2 my-auto">
                                <center>
                                    <img src="<?php echo $baseUrl.'admin/pages/berita/thumbnail/'.$detailBeritaRekomendasi['thumbnail']; ?>" class="img-fluid rounded" alt="...">
                                </center>
                            </div>
                            <div class="col-10 ps-2">
                                <h6><?php echo $detailBeritaRekomendasi['judul_berita']; ?></h6>
                                <span class="text-muted small">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                    <?php
                                                        
                                        $pecahTanggal = explode('-', $detailBeritaRekomendasi['created_at']);
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
                                </span>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>