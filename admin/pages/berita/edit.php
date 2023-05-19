<?php
$id_berita = mysqli_escape_string($conn, $_GET['id_berita']);
$querySelect = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita='$id_berita'") or die(mysqli_error($conn));

$jumlahData = mysqli_num_rows($querySelect);

if($jumlahData <= 0) {
    header('location: index.php?page=data-berita&msg=not-found');
} else {
   $detailData = mysqli_fetch_array($querySelect); 
}

?>

<div class="container my-4">
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h5><i class="fa fa-edit" aria-hidden="true"></i> Halaman Edit Berita</h5>
            <nav aria-label="breadcrumb" class="ms-4 ps-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item" aria-current="page">Kelola Data Berita</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data Berita</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-orange text-white fw-bold">
            Form Edit Berita
        </div>
        <div class="card-body">
            <form action="index.php?page=data-berita" enctype="multipart/form-data" method="POST">
                <div class="mb-3">
                    <input type="hidden" name="id_berita" value="<?php echo $id_berita; ?>" class="form-control">
                    <label for="judul_berita">Judul Panduan</label>
                    <input type="text" name="judul_berita" value="<?php echo $detailData['judul_berita']; ?>" id="judul_panduan" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                    <span class="text-danger small">*File JPG, JPEG atau PNG 360x360 (Maksimal 5MB)</span>
                </div>
                <div class="mb-3">
                    <label for="form-ckeditor">Konten Berita</label>
                    <textarea name="konten" id="form-ckeditor">
                        <?php echo $detailData['konten']; ?>
                    </textarea>
                </div>
                <input type="hidden" id="auhtor" class="form-control" name="author" value="<?php echo $_SESSION['data_session']['id_user'] ?>" readonly>
                <hr>
                <input type="submit" name="simpan" class="btn btn-primary float-end" value="Simpan">
            </form>
        </div>
    </div>
</div>