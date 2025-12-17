<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header('Location: peserta.php');
    exit();
}

$id = $_GET['id'];

$sql_get = "SELECT * FROM peserta WHERE id_peserta = '$id'";
$query_get = mysqli_query($conn, $sql_get);
$data = mysqli_fetch_assoc($query_get);

$query_kelas = mysqli_query($conn, "SELECT * FROM kelas");
$query_tingkat = mysqli_query($conn, "SELECT * FROM tingkat_kelas");

if (mysqli_num_rows($query_get) < 1) {
    die("Data tidak ditemukan");
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];
    $jk = $_POST['jk'];

    $id_kelas = $_POST['id_kelas'];
    $id_tingkat = $_POST['id_tingkat_kelas'];

    $sql_update = "UPDATE peserta SET nama='$nama', alamat='$alamat', telp='$telp', email='$email', jk='$jk', id_kelas='$id_kelas', id_tingkat_kelas='$id_tingkat' WHERE id_peserta=$id";

    if (mysqli_query($conn, $sql_update)) {
        header('Location: peserta.php');
        exit();
    } else {
        echo "Gagal menyimpan perubahan";
    }
}
?>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h1>Edit Data Peserta</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap:</label>
                    <input class="form-control" type="text" name="nama" value="<?php echo $data['nama'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Kelas:</label>
                    <select class="form-select" name="id_kelas" required>
                        <?php while ($k = mysqli_fetch_assoc($query_kelas)) { ?>
                            <option value="<?= $k['id_kelas'] ?>" <?= ($data['id_kelas'] == $k['id_kelas']) ? 'selected' : '' ?>>
                                <?= $k['nama_kelas'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Tingkat:</label>
                    <select class="form-select" name="id_tingkat_kelas" required>
                        <?php while ($t = mysqli_fetch_assoc($query_tingkat)) { ?>
                            <option value="<?= $t['id_tingkat_kelas'] ?>"
                                <?= ($data['id_tingkat_kelas'] == $t['id_tingkat_kelas']) ? 'selected' : '' ?>>
                                <?= $t['tingkat_kelas'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat:</label>
                    <textarea class="form-control" name="alamat" required><?php echo $data['alamat'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. Telepon:</label>
                    <input class="form-control" type="text" name="telp" value="<?php echo $data['telp'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input class="form-control" type="email" name="email" value="<?php echo $data['email'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">Jenis Kelamin:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" value="Pria" <?php echo ($data['jk'] == 'Pria') ? "checked" : "" ?> required>
                        <label class="form-check-label">Pria</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" value="Wanita" <?php echo ($data['jk'] == 'Wanita') ? "checked" : "" ?> required>
                        <label class="form-check-label">Wanita</label>
                    </div>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
                <a href="peserta.php" class="btn btn-warning">Batal</a>
            </form>
        </div>
    </div>
</div>