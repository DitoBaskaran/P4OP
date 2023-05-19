<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/images/carousel_1.jpg" class="d-block w-100 img-carousel" alt="...">
            <div class="carousel-caption my-auto">
                <img src="assets/images/logo_dki_jakarta.png" class="mb-3" width="79" height="90" alt="">
                <h1>Dinas Pendidikan P4OP</h1>
                <p class="small"> Website Pusat Pelayanan Pendanaan Personal dan Operasional Pendidikan.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/images/carousel_1.jpg" class="d-block w-100 img-carousel" alt="...">
            <div class="carousel-caption">
                <img src="assets/images/logo_dki_jakarta.png" class="mb-3" width="79" height="90" alt="">
                <h1>Dinas Pendidikan P4OP</h1>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/images/carousel_1.jpg" class="d-block w-100 img-carousel" alt="...">
            <div class="carousel-caption">
                <img src="assets/images/logo_dki_jakarta.png" class="mb-3" width="79" height="90" alt="">
                <h1>Dinas Pendidikan P4OP</h1>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
    </div>
</div>

<div class="container my-5 container-beranda-about">
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card my-auto shadow" data-aos="zoom-in">
                <div class="card-body" style="min-height: 274px;">
                    <div class="row mt-4">
                        <div class="col-md-4 text-center ">
                            <img src="assets/images/p4op_400x400.jpg" class="img-fluid" width="80%" alt="">
                        </div>
                        <div class="col-md-8 ">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took... </p>
                            <a href="" class="fw-italic float-end btn btn-orange btn-sm me-4"><em>Selengkapnya</em></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow" data-aos="zoom-in">
                <div class="card-header bg-primary">
                    <span class="text-uppercase text-white fw-bold">Pedoman</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="80%">Judul</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $queryPanduan = mysqli_query($conn, "SELECT * FROM data_panduan ORDER BY id_panduan DESC LIMIT 3") or die(mysqli_error($conn));
                                while ($dataPanduan = mysqli_fetch_array($queryPanduan)) {
                                ?>
                                <tr>
                                    <td width="80%"><?php echo $dataPanduan['judul'] ?></td>
                                    <td class="text-center"><a href="<?php echo $baseUrl.'admin/dokumen_panduan/'.$dataPanduan['nama_file'] ?>" class="btn btn-orange btn-sm small" download><i class="fa fa-download" aria-hidden="true"></i></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="beranda-berita my-5">
    <div class="content-beranda-berita">
        <div class="container py-5">
            <h4 class="fw-bold text-white text-uppercase mb-4">Informasi & Berita</h4>
            <hr style="height: 2px; border: 2px solid white; opacity: 1; width: 20%; margin-top: -15px;">
            <div class="row">
                <?php
                $queryBerita = mysqli_query($conn, "SELECT * FROM berita ORDER BY id_berita DESC LIMIT 4") or die(mysqli_error($onn));

                while ($dataBerita = mysqli_fetch_array($queryBerita)) {
                ?>
                <div class="col-md-3 mb-3">
                    <a href="" class="text-decoration-none text-dark anchor-effect">
                        <div class="anchor-card-berita">
                            <div class="card card-berita border-0 shadow-lg" data-aos="zoom-in">
                                <img src="<?php echo $baseUrl.'admin/pages/berita/thumbnail/'.$dataBerita['thumbnail']; ?>" class="card-img-top"alt="...">
                                <div class="card-body card-body-berita">
                                    <p class="card-title fw-bold text-uppercase small"><?php echo $dataBerita['judul_berita']; ?></h6>
                                    <p class="text-muted time">
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

                                        echo '<i class="fa fa-calendar-o" aria-hidden="true"></i> ' . $hari . ' ' . $bulan . ' ' . $tahun . ' WIB';
                                        
                                        
                                        ?>
                                    </p>
                                    <a href="#" class="btn bg-orange text-white btn-sm float-end mt-2">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
