<?php
$id_panduan = mysqli_escape_string($conn, $_GET['id_panduan']);
$querySelect = mysqli_query($conn, "SELECT * FROM data_panduan WHERE id_panduan='$id_panduan'") or die(mysqli_error($conn));

$jumlahData = mysqli_num_rows($querySelect);

if($jumlahData <= 0) {
    header('location: index.php?page=data-panduan&msg=not-found');
} else {
   $detailData = mysqli_fetch_array($querySelect); 
}

?>

<div class="container my-4">
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h5><i class="fa fa-edit" aria-hidden="true"></i> Halaman Edit Panduan</h5>
            <nav aria-label="breadcrumb" class="ms-4 ps-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item" aria-current="page">Kelola Data Panduan</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data Panduan</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-orange text-white fw-bold">
            Form Edit Panduan
        </div>
        <div class="card-body">
            <form action="index.php?page=data-panduan" enctype="multipart/form-data" method="POST">
                <div class="mb-3">
                    <input type="hidden" name="id_panduan" value="<?php echo $id_panduan; ?>" class="form-control">
                    <label for="judul_panduan">Judul Panduan</label>
                    <input type="text" name="judul_panduan" value="<?php echo $detailData['judul']; ?>" id="judul_panduan" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="file_panduan">File Panduan</label> <span class="text-danger small">*File PDF, Word dan Excel (Maksimal 5MB)</span>
                    <input type="file" name="file_panduan" id="file_panduan" class="form-control">
                    <a href="<?php echo $baseUrl . 'admin/dokumen_panduan/' . $detailData['nama_file']; ?>"><?php echo $baseUrl . 'admin/dokumen_panduan/' . $detailData['nama_file']; ?></a>
                </div>
                <hr>
                <div class="float-end">
                    <input type="reset" class="btn btn-danger" value="Ulangi">
                    <input type="submit" name="edit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>