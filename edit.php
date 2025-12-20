<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];

$sql = mysqli_query($conn, "SELECT * FROM kursus WHERE id_kursus = $id");
$data = mysqli_fetch_array($sql);

$query_anggota = mysqli_query($conn, "SELECT * FROM anggota");
$query_tingkat_kelas = mysqli_query($conn, "SELECT * FROM tingkat_kelas");

if (isset($_POST['submit'])) {
    $nama = $_POST['id_anggota'];
    $tingkat_kelas = $_POST['id_tingkat_kelas'];

    $sql_update = "UPDATE kursus 
            SET id_anggota = '$nama', id_tingkat_kelas= '$tingkat_kelas' 
            WHERE kursus.id_kursus = $id";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
    }
}
?>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h1>Edit Kelas Peserta</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Pilih Anggota:</label>
                    <select class="form-select" name="id_anggota" required>
                        <?php
                        while ($row_anggota = mysqli_fetch_assoc($query_anggota)) {
                            $selected = ($row_anggota['id_anggota'] == $data['id_anggota']) ? 'selected' : '';
                            ?>
                            <option value="<?= $row_anggota['id_anggota'] ?>" <?= $selected ?>>
                                <?= $row_anggota['nama'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Tingkat:</label>
                    <select class="form-select" name="id_tingkat_kelas" required>
                        <?php
                        while ($row_tingkat_kelas = mysqli_fetch_assoc($query_tingkat_kelas)) {
                            $selected = ($row_tingkat_kelas['id_tingkat_kelas'] == $data['id_tingkat_kelas']) ? 'selected' : '';
                            ?>
                            <option value="<?= $row_tingkat_kelas['id_tingkat_kelas'] ?>" <?= $selected ?>>
                                <?= $row_tingkat_kelas['tingkat_kelas'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Simpan Data</button>
                <a href="index.php" class="btn btn-danger">Batal</a>
            </form>
        </div>
    </div>
</div>