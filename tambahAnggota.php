<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $notel = $_POST['notel'];
    $email = $_POST['email'];
    $jk = $_POST['jk'];

    $sql = "INSERT INTO anggota (nama, alamat, notel, email, jk) 
            VALUES ('$nama', '$alamat', '$notel', '$email', '$jk')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h1>Tambah Peserta Baru</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap:</label>
                    <input class="form-control" type="text" name="nama" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat:</label>
                    <textarea class="form-control" name="alamat" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. Telepon:</label>
                    <input class="form-control" type="text" name="notel" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input class="form-control" type="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">Jenis Kelamin:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" value="Pria" required>
                        <label class="form-check-label">Pria</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" value="Wanita" required>
                        <label class="form-check-label">Wanita</label>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Simpan Data</button>
                <a href="index.php" class="btn btn-danger">Batal</a>
            </form>
        </div>
    </div>
</div>