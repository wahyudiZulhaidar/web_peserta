<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<?php
require_once 'config.php';

$sql = "SELECT * FROM peserta";

$query = mysqli_query($conn, $sql);

if (!$query) {
    die('SQL Error: ' . mysqli_error($conn));
}

echo '
<div class="text-center mt-3">
<h1>Nama Peserta</h1>
</div>

<a href="insert.php?id=" class="btn btn-primary"> Tambah Data Baru </a><br><br>

<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
    <tbody>
</div>';

while ($row = mysqli_fetch_array($query)) {
    echo '<tr>
            <td>' . $row['nama'] . '</td>
            <td>' . $row['alamat'] . '</td>
            <td>' . $row['telp'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['jk'] . '</td>
            <td>
                <a href="edit.php?id=' . $row['id_peserta'] . '" class="btn btn-warning"> Edit </a>
                <a href="delete.php?id=' . $row['id_peserta'] . '" class="btn btn-danger"> Hapus </a>
            </td>
        </tr>';
}
