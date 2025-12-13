<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header('Location: peserta.php');
    exit();
}

$id = $_GET['id'];

$sql_get = "SELECT * FROM peserta WHERE nomor = '$id'";
$query_get = mysqli_query($conn, $sql_get);
$data = mysqli_fetch_assoc($query_get);

if (mysqli_num_rows($query_get) < 1) {
    die("Data tidak ditemukan");
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];
    $jk = $_POST['jk'];

    $sql_update = "UPDATE peserta SET nama='$nama', alamat='$alamat', telp='$telp', email='$email', jk='$jk' WHERE nomor=$id";

    if (mysqli_query($conn, $sql_update)) {
        header('Location: peserta.php');
        exit();
    } else {
        echo "Gagal menyimpan perubahan";
    }
}
?>

<div class="position-absolute top-0 start-50 translate-middle-x">
    <h1>Edit Data Peserta</h1>

    <div class="row g-3 align-items-center">
        <form action="" method="POST"">
        <p>
            <label class=" form-label">Nama Lengkap:</label><br>
            <input input class="form-control" type=" text" name="nama" value="<?php echo $data['nama'] ?>" required>
            </p>
            <p>
                <label class="form-label">Alamat:</label><br>
                <textarea input class="form-control" name="alamat" required><?php echo $data['alamat'] ?></textarea>
            </p>
            <p>
                <label class="form-label">No. Telepon:</label><br>
                <input input class="form-control" type="text" name="telp" value="<?php echo $data['telp'] ?>" required>
            </p>
            <p>
                <label class="form-label">Email:</label><br>
                <input input class="form-control" type="email" name="email" value="<?php echo $data['email'] ?>"
                    required>
            </p>
            <p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jk" id="jk_pria" value="Pria" <?php echo ($data['jk'] == 'Pria') ? "checked" : "" ?> required>
                <label class="form-check-label" for="jk_pria">
                    Pria
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jk"  id="jk_wanita" value="Wanita" <?php echo ($data['jk'] == 'Wanita') ? "checked" : "" ?> required>
                <label class="form-check-label" for="jk_wanita">
                    Wanita
                </label>
            </div>
            </p>
            <p>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
                <a href="peserta.php" class="btn btn-warning">Batal</a>
            </p>
        </form>
    </div>
</div>