<link rel="stylesheet" href="style.css">

<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM peserta WHERE nomor = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo '<div class="center">';
        echo '<h1>Data Berhasil Dihapus</h1>';
        echo '<br>';
        echo '<a href="peserta.php" class="button">Kembali ke Daftar Peserta</a>';
        echo '</div>';
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
} else {
    echo "Data tidak ditemukan.";
}
?>