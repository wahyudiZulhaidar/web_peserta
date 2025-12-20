<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<?php
require_once 'config.php';

$sql = "SELECT id_kursus, nama, notel, jk, tingkat_kelas, status_kursus FROM kursus
        JOIN anggota ON kursus.id_anggota = anggota.id_anggota
        JOIN tingkat_kelas ON kursus.id_tingkat_kelas = tingkat_kelas.id_tingkat_kelas;";

$query = mysqli_query($conn, $sql);

if (!$query) {
    die('SQL Error: ' . mysqli_error($conn));
}
?>

<div class="container mt-4">
    <div class="text-center mb-4">
        <h1>Nama Peserta</h1>
    </div>

    <a href="insert.php" class="btn btn-primary mb-3"> Tambah Data Baru </a>
    <a href="tambahAnggota.php" class="btn btn-primary mb-3"> Tambah Anggota Baru </a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Nomor Telepon</th>
                <th>Jenis Kelamin</th>
                <th>Tingkat Kelas</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($query)) {
                echo '<tr>
                        <td>' . $row['nama'] . '</td>
                        <td>' . $row['notel'] . '</td>
                        <td>' . $row['jk'] . '</td>    
                        <td>' . $row['tingkat_kelas'] . '</td>
                        <td>' . $row['status_kursus'] . '</td> 
                        <td>
                            <a href="edit.php?id=' . $row['id_kursus'] . '" class="btn btn-warning btn-sm"> Edit </a>
                            <a href="delete.php?id=' . $row['id_kursus'] . '" class="btn btn-danger btn-sm"> Hapus </a>
                        </td>
                    </tr>';
            }
            ?>
        </tbody>
    </table>
</div>