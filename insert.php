<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<?php
require_once 'config.php';

$query_anggota = mysqli_query($conn, "SELECT * FROM anggota");
$query_tingkat = mysqli_query($conn, "SELECT * FROM tingkat_kelas");
?>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h1>Tambah Kelas Peserta</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="form-tambah-data" action="add_data.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Pilih Anggota:</label>
                    <select class="form-select" name="id_anggota" required>
                        <option value="">-- Pilih Anggota --</option>
                        <?php while ($row = mysqli_fetch_assoc($query_anggota)) { ?>
                            <option value="<?= $row['id_anggota'] ?>"><?= $row['nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Tingkat:</label>
                    <select class="form-select" name="id_tingkat_kelas" required>
                        <option value="">-- Pilih Tingkat Kelas --</option>
                        <?php while ($row = mysqli_fetch_assoc($query_tingkat)) { ?>
                            <option value="<?= $row['id_tingkat_kelas'] ?>"><?= $row['tingkat_kelas'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Data</button>
                <a href="index.php" class="btn btn-danger">Batal</a>
            </form>
        </div>
    </div>
</div>