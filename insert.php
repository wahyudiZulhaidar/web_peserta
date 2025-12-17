<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];
    $jk = $_POST['jk'];

    $sql = "INSERT INTO peserta (nama, alamat, telp, email, jk) VALUES ('$nama', '$alamat', '$telp', '$email', '$jk')";

    if (mysqli_query($conn, $sql)) {
        header("Location: peserta.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<div class="position-absolute top-0 start-50 translate-middle-x">

    <div class="text-center mt-3">
        <h1>Tambah Peserta Baru</h1><br>
    </div>
    
    <div class="row g-3 align-items-center">
        <form action="" method="POST">
            <p>
                <label class="form-label">Nama Lengkap:</label><br>
                <input class="form-control" type="text" name="nama" required>
            </p>
            <p>
                <label class="form-label">Alamat:</label><br>
                <textarea class="form-control" name="alamat" required></textarea>
            </p>
            <p>
                <label class="form-label">No. Telepon:</label><br>
                <input class="form-control" type="text" name="telp" required>
            </p>
            <p>
                <label class="form-label col-sm-2 col-form-label">Email:</label><br>
                <input class="form-control" type="email" name="email" required>
            </p>
            <p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jk" value="Pria" required>
                <label class="form-check-label" for="jk_pria">
                    Pria
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jk" value="Wanita" required>
                <label class="form-check-label" for="jk_wanita">
                    Wanita
                </label>
            </div>
            </p>
            <p>
                <button type="submit" name="submit" class="btn btn-primary">Simpan Data</button>
                <a href="peserta.php" class="btn btn-danger">Batal</a>
            </p>
        </form>
    </div>
</div>