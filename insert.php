<link rel="stylesheet" href="style.css">

<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp   = $_POST['telp'];
    $email  = $_POST['email'];
    $jk     = $_POST['jk'];

    $sql = "INSERT INTO peserta (nama, alamat, telp, email, jk) VALUES ('$nama', '$alamat', '$telp', '$email', '$jk')";

    if (mysqli_query($conn, $sql)) {
        header("Location: peserta.php"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<div class="center">
    <h1>Tambah Peserta Baru</h1>
    
    <form action="" method="POST"">
        <p>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama" required>
        </p>
        <p>
            <label>Alamat:</label><br>
            <textarea name="alamat" required></textarea>
        </p>
        <p>
            <label>No. Telepon:</label><br>
            <input type="text" name="telp" required>
        </p>
        <p>
            <label>Email:</label><br>
            <input type="email" name="email" required>
        </p>
        <p>
            <label>Jenis Kelamin:</label><br>
            <select name="jk" required>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
            </select>
        </p>
        <p>
            <button type="submit" name="submit" class="button button-add">Simpan Data</button>
            <a href="peserta.php" class="button button-warning">Batal</a>
        </p>
    </form>
</div>