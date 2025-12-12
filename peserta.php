<link rel="stylesheet" href="style.css">

<?php
require_once 'config.php';

$sql = "SELECT * FROM peserta";

$query = mysqli_query($conn, $sql);

if(!$query) {
    die('SQL Error: ' . mysqli_error($conn));
}

echo '
<div class="center">
<h1>Nama Peserta</h1>
</div>

<a href="insert.php?id=" class="button button-add"> Tambah Data Baru </a>

<table border="1px solid black" ; cellpadding="10" ; cellspacing="0">
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
            <td>' . $row['telp'] .  '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['jk'] . '</td>
            <td>
                <a href="edit.php?id=' . $row['nomor'] . '" class="button button-warning"> Edit </a>
                <a href="delete.php?id=' . $row['nomor'] . '" class="button button-danger"> Hapus </a>
            </td>
        </tr>';
}
