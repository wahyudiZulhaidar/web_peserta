<link rel="stylesheet" href="style.css">

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
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp   = $_POST['telp'];
    $email  = $_POST['email'];
    $jk     = $_POST['jk'];

    $sql_update = "UPDATE peserta SET nama='$nama', alamat='$alamat', telp='$telp', email='$email', jk='$jk' WHERE nomor=$id";

    if (mysqli_query($conn, $sql_update)) {
        header('Location: peserta.php');
        exit();
    } else {
        echo "Gagal menyimpan perubahan";
    }
}
?>

<div class="center">
    <h1>Edit Data Peserta</h1>

    <form action="" method="POST"">
        <p>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama" value="<?php echo $data['nama'] ?>" required>
        </p>
        <p>
            <label>Alamat:</label><br>
            <textarea name="alamat" required><?php echo $data['alamat'] ?></textarea>
        </p>
        <p>
            <label>No. Telepon:</label><br>
            <input type="text" name="telp" value="<?php echo $data['telp'] ?>" required>
        </p>
        <p>
            <label>Email:</label><br>
            <input type="email" name="email" value="<?php echo $data['email'] ?>" required>
        </p>
        <p>
            <label>Jenis Kelamin:</label><br>
            <select name="jk" required>
                <option value="Pria" <?php echo ($data['jk'] == 'Pria') ? "selected" : "" ?>>Pria</option>
                <option value="Wanita" <?php echo ($data['jk'] == 'Wanita') ? "selected" : "" ?>>Wanita</option>
            </select>
        </p>
        <p>
            <button type="submit" name="simpan" class="button button-add">Simpan Perubahan</button>
            <a href="peserta.php" class="button button-warning">Batal</a>
        </p>
    </form>
</div>