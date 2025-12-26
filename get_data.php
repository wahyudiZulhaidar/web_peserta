<?php
require_once 'config.php';

$sql = "SELECT kursus.id_kursus, anggota.nama, anggota.notel, anggota.jk, tingkat_kelas.tingkat_kelas, kursus.status_kursus 
        FROM kursus
        JOIN anggota ON kursus.id_anggota = anggota.id_anggota
        JOIN tingkat_kelas ON kursus.id_tingkat_kelas = tingkat_kelas.id_tingkat_kelas
        ORDER BY kursus.id_kursus ASC";
$query = mysqli_query($conn, $sql);

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