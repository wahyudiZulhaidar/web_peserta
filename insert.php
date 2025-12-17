<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<?php
require_once 'config.php';

$query_kelas = mysqli_query($conn, "SELECT * FROM kelas");
$query_tingkat = mysqli_query($conn, "SELECT * FROM tingkat_kelas");

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];
    $jk = $_POST['jk'];

    $id_kelas = $_POST['id_kelas'];
    $id_tingkat = $_POST['id_tingkat_kelas'];

    $sql = "INSERT INTO peserta (nama, alamat, telp, email, jk, id_kelas, id_tingkat_kelas) 
            VALUES ('$nama', '$alamat', '$telp', '$email', '$jk', '$id_kelas', '$id_tingkat')";

    if (mysqli_query($conn, $sql)) {
        header("Location: peserta.php");
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
                    <label class="form-label">Pilih Kelas:</label>
                    <select class="form-select" name="id_kelas" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php while ($row = mysqli_fetch_assoc($query_kelas)) { ?>
                            <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Tingkat:</label>
                    <select class="form-select" name="id_tingkat_kelas" required>
                        <option value="">-- Pilih Tingkat --</option>
                        <?php while ($row = mysqli_fetch_assoc($query_tingkat)) { ?>
                            <option value="<?= $row['id_tingkat_kelas'] ?>"><?= $row['tingkat_kelas'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat:</label>
                    <textarea class="form-control" name="alamat" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. Telepon:</label>
                    <input class="form-control" type="text" name="telp" required>
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
                <a href="peserta.php" class="btn btn-danger">Batal</a>
            </form>
        </div>
    </div>
</div>