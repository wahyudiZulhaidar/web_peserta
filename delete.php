<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM peserta WHERE id_peserta = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo '
        <div class="container mt-5"> <div class="text-center"> <h1 class="mb-4">Data Berhasil Dihapus</h1> <a href="peserta.php" class="btn btn-primary">Kembali ke Daftar Peserta</a>
            </div>
        </div>';

    } else {
        echo '<div class="container mt-5"><div class="alert alert-danger">Gagal menghapus data: ' . mysqli_error($conn) . '</div></div>';
    }
} else {
    echo '<div class="container mt-5"><div class="alert alert-warning">ID Data tidak ditemukan.</div></div>';
}
?>