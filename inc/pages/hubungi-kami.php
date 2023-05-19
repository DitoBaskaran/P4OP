<div class="beranda-berita">
    <div class="content-beranda-berita">
        <div class="container py-5">
            <h4 class="fw-bold text-white text-uppercase text-center">HALAMAN PENGADUAN</h4>
            <div class="row py-5">
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Formulir Pengaduan</h5>
                            <hr>
                            <?php
                            
                            if(isset($_POST['kirim'])) {
                                $postNamaLengkap = mysqli_escape_string($conn, $_POST['nama_lengkap']);
                                $postNik = mysqli_escape_string($conn, $_POST['nik']);
                                $postNoWa = mysqli_escape_string($conn, $_POST['no_wa']);
                                $postPesan = mysqli_escape_string($conn, $_POST['pesan']);

                                if (empty($postNamaLengkap) || empty($postNik) || empty($postNoWa) || empty($postPesan)) {
                                    $msgType = 'error';
                                    $msgText = 'Gagal : Inputan masing ada yang kosong.';
                                    // Lakukan tindakan selanjutnya jika input kosong
                                } else {
                                    $ambilSatuAngka = substr($postNoWa, 0, 1);
                                    if($ambilSatuAngka == '0') {
                                        $hapusAngkaNol = substr($postNoWa, 1);
                                        $postNoWa = '62'.$hapusAngkaNol;
                                    }
                                    // Lakukan tindakan selanjutnya jika input tidak kosong
                                    $queryInsertPengaduan = mysqli_query($conn, "INSERT INTO pengaduan VALUES(NULL, '$postNik', '$postNamaLengkap', '$postNoWa', '$postPesan', '$date')") or die(mysqli_error($conn));
                                    if($queryInsertPengaduan == TRUE) {
                                        $msgType = 'success';
                                        $msgText = 'Berhasil : Pesan pengaduan berhasil dikirim.';
                                    } else {
                                        $msgType = 'error';
                                        $msgText = 'Gagal : Pesan pengaduan gagal dikirim.';
                                    }
                                }

                            }
                            
                            if($msgType == 'error') {
                                ?>
                                <div class="alert alert-danger">
                                    <?php echo $msgText; ?>
                                </div>
                                <?php
                            } elseif($msgType == 'success') {
                                ?>
                                <div class="alert alert-success">
                                    <?php echo $msgText; ?>
                                </div>
                                <?php
                            }

                            ?>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap">
                                </div>
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK Anda</label>
                                    <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK">
                                </div>
                                <div class="mb-3">
                                    <label for="no_wa" class="form-label">Nomor Whatsapp</label>
                                    <input type="text" class="form-control" id="no_wa" name="no_wa" placeholder="Masukkan Nomor Whatsapp">
                                </div>
                                <div class="mb-3">
                                    <label for="pesan" class="form-label">Pesan Pengaduan</label>
                                    <textarea name="pesan" class="form-control" id="pesan" cols="30" rows="5"></textarea>
                                </div>
                                <div class="float-end">
                                    <input type="reset" class="btn btn-danger" value="Ulangi">
                                    <input type="submit" name="kirim" class="btn btn-primary" value="Kirim Pengaduan">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-auto mx-auto">
                    <ul class="mx-auto my-auto " style="list-style-type: none; font-size: 20px;">
                        <li class="mb-3">
                            <i class="fa fa-instagram text-white"></i>
                            <span class="text-white">@upt.p4op</span>
                        </li>
                        <li class="mb-3">
                            <i class="fa fa-whatsapp text-white"></i>
                            <span class="text-white">(+62) 895-2576-7869</span>
                        </li>
                        <li class="mb-3">
                            <i class="fa fa-map-marker text-white"></i>
                            <span class="text-white">Jl. Jatinegara Timur IV No.55, Rawabunga, Jatinegara (Samping SMA Negeri 54 Jakarta) Jakarta Timur</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>