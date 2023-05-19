<div class="container py-5">
    <h2 class="fw-bold">BERITA PALING TERBARU</h2>
    <hr style="height: 2px; border: 2px solid blue; opacity: 1; width: 32%; margin-top: -5px;">
    <?php
    
    $queryBeritaTerbaru = mysqli_query($conn, "SELECT * FROM berita ORDER BY id_berita DESC LIMIT 1") or die(mysqli_error($conn));
    $detailDataTerbaru = mysqli_fetch_array($queryBeritaTerbaru);

    ?>
    <div class="row">
        <div class="col-md-5 mb-3 my-auto">
            <img class="rounded ms-5" src="<?php echo $baseUrl; ?>admin/pages/berita/thumbnail/<?php echo $detailDataTerbaru['thumbnail']; ?>" width="70%" alt="">
        </div>
        <div class="col-md-7 my-auto">
            <a href="?page=baca-berita&judul=<?php echo strtolower($detailDataTerbaru['judul_berita']); ?>" class="text-decoration-none text-dark anchor-effect">
                <h5 class="text-uppercase fw-bold"><?php echo $detailDataTerbaru['judul_berita']; ?></h5>
                <span class="text-muted small">
                    <i class="fa fa-clock-o" aria-hidden="true"></i> 
                    <?php
                                        
                        $pecahTanggal = explode('-', $detailDataTerbaru['created_at']);
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
                <p style="text-align: justify;">
                    <?php echo substr($detailDataTerbaru['konten'], 0, 400).'...'; ?>
                </p>
                <a href="?page=baca-berita&judul=<?php echo strtolower($detailDataTerbaru['judul_berita']); ?>" class="btn btn-orange text-white float-end">Selengkapnya</a> 
            </a>
        </div>
    </div>

    <h3 class="mt-5">BERITA TERBARU LAINNYA</h3>
    <hr style="height: 2px; border: 2px solid blue; opacity: 1; width: 32%; margin-top: -5px;">
    <div class="row">
        <div class="col-md-4 mb-5" data-aos="fade-up">
            <a href="" class="text-decoration-none text-dark anchor-effect">
                <div>
                    <div class="card shadow">
                        <img src="<?php echo $baseUrl; ?>assets/images/360x360.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">NCT DREAM Tumbuh Bersama Glitch Mode</h5>
                            <span class="card-subtitle mb-2 text-muted small"><i class="fa fa-clock-o" aria-hidden="true"></i> 22 Desember 2022 | 13:20 WIB</span>
                            <p class="card-text" style="text-align: justify;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            b5
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-5" data-aos="fade-up">
            <a href="" class="text-decoration-none text-dark anchor-effect">
                <div>
                    <div class="card shadow">
                        <img src="<?php echo $baseUrl; ?>assets/images/360x360.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">NCT DREAM Tumbuh Bersama Glitch Mode</h5>
                            <span class="card-subtitle mb-2 text-muted small"><i class="fa fa-clock-o" aria-hidden="true"></i> 22 Desember 2022 | 13:20 WIB</span>
                            <p class="card-text" style="text-align: justify;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            b5
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-5" data-aos="fade-up">
            <a href="" class="text-decoration-none text-dark anchor-effect">
                <div>
                    <div class="card shadow">
                        <img src="<?php echo $baseUrl; ?>assets/images/360x360.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">NCT DREAM Tumbuh Bersama Glitch Mode</h5>
                            <span class="card-subtitle mb-2 text-muted small"><i class="fa fa-clock-o" aria-hidden="true"></i> 22 Desember 2022 | 13:20 WIB</span>
                            <p class="card-text" style="text-align: justify;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            b5
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-5" data-aos="fade-up">
            <a href="" class="text-decoration-none text-dark anchor-effect">
                <div>
                    <div class="card shadow">
                        <img src="<?php echo $baseUrl; ?>assets/images/360x360.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">NCT DREAM Tumbuh Bersama Glitch Mode</h5>
                            <span class="card-subtitle mb-2 text-muted small"><i class="fa fa-clock-o" aria-hidden="true"></i> 22 Desember 2022 | 13:20 WIB</span>
                            <p class="card-text" style="text-align: justify;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            b5
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-5" data-aos="fade-up">
            <a href="" class="text-decoration-none text-dark anchor-effect">
                <div>
                    <div class="card shadow">
                        <img src="<?php echo $baseUrl; ?>assets/images/360x360.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">NCT DREAM Tumbuh Bersama Glitch Mode</h5>
                            <span class="card-subtitle mb-2 text-muted small"><i class="fa fa-clock-o" aria-hidden="true"></i> 22 Desember 2022 | 13:20 WIB</span>
                            <p class="card-text" style="text-align: justify;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            b5
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-5" data-aos="fade-up">
            <a href="" class="text-decoration-none text-dark anchor-effect">
                <div>
                    <div class="card shadow">
                        <img src="<?php echo $baseUrl; ?>assets/images/360x360.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">NCT DREAM Tumbuh Bersama Glitch Mode</h5>
                            <span class="card-subtitle mb-2 text-muted small"><i class="fa fa-clock-o" aria-hidden="true"></i> 22 Desember 2022 | 13:20 WIB</span>
                            <p class="card-text" style="text-align: justify;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            b5
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>