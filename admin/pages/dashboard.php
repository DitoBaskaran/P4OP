<div class="container my-5">
    <h6><i class="fa fa-home" aria-hidden="true"></i> Halaman Beranda</h6>
    <nav aria-label="breadcrumb" class="ms-4 ps-1">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Halaman Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Beranda</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body bg-orange text-white">
                    <div class="row">
                        <div class="col-6 my-auto mx-auto">
                            <i class="fa fa-newspaper-o h3"></i>
                        </div>
                        <div class="col-6 text-end">
                            <h4>
                                <?php
                                $queryBerita = mysqli_query($conn, "SELECT * FROM berita") or die(mysqli_error($conn));
                                echo mysqli_num_rows($queryBerita);
                                ?>
                            </h4>
                            <h6>Data Berita</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body bg-orange text-white">
                    <div class="row">
                        <div class="col-6 my-auto mx-auto">
                            <i class="fa fa-users h3"></i>
                        </div>
                        <div class="col-6 text-end">
                            <h4>
                                <?php
                                $queryUsers = mysqli_query($conn, "SELECT * FROM users") or die(mysqli_error($conn));
                                echo mysqli_num_rows($queryUsers);
                                ?>
                            </h4>
                            <h6>Data Users</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body bg-orange text-white">
                    <div class="row">
                        <div class="col-6 my-auto mx-auto">
                            <i class="fa fa-paperclip h3"></i>
                        </div>
                        <div class="col-6 text-end">
                            <h4>
                                <?php
                                $queryPanduan = mysqli_query($conn, "SELECT * FROM data_panduan") or die(mysqli_error($conn));
                                echo mysqli_num_rows($queryPanduan);
                                ?>
                            </h4>
                            <h6>Panduan</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body bg-orange text-white">
                    <div class="row">
                        <div class="col-6 my-auto mx-auto">
                            <i class="fa fa-question h3" aria-hidden="true"></i>
                        </div>
                        <div class="col-6 text-end">
                            <h4>
                                <?php
                                $queryPengaduan = mysqli_query($conn, "SELECT * FROM pengaduan") or die(mysqli_error($conn));
                                echo mysqli_num_rows($queryPengaduan);
                                ?>
                            </h4>
                            <h6>Pengaduan</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
