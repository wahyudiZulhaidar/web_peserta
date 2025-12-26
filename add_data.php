<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_anggota = $_POST['id_anggota'];
    $id_tingkat_kelas = $_POST['id_tingkat_kelas'];

    $sql = "INSERT INTO kursus (id_anggota, id_tingkat_kelas) VALUES ('$id_anggota', '$id_tingkat_kelas')";

    if (mysqli_query($conn, $sql)) {
        if (isset($_POST['ajax']) && $_POST['ajax'] == '1') {
            echo 'success';
        } else {
            header('Location: index.php');
            exit();
        }
    } else {
        echo "Kesalahan: " . mysqli_error($conn);
    }
}