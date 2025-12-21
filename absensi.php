<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
    $pertemuan_baru = $_POST['pertemuan_ke'];
    $data_absen = $_POST['absen'] ?? [];
    $values = [];

    $q_all_peserta = mysqli_query($conn, "SELECT kursus.id_kursus FROM kursus");

    while ($p = mysqli_fetch_assoc($q_all_peserta)) {
        $id_k = $p['id_kursus'];
        $status = isset($data_absen[$id_k]) ? 'Hadir' : 'Tidak Hadir';

        $values[] = "('$id_k', '$pertemuan_baru', '$status')";
    }

    if (!empty($values)) {
        $sql_batch = "INSERT INTO absensi (id_kursus, pertemuan, status_pertemuan) VALUES " . implode(',', $values);
        mysqli_query($conn, $sql_batch);
    }
}

$q_max = mysqli_query($conn, "SELECT MAX(pertemuan) as last_meet FROM absensi");
$row_max = mysqli_fetch_assoc($q_max);
$last_meet = $row_max['last_meet'] ?? 0;

$total_pertemuan_tampil = $last_meet + 1;

$data_map = [];
$q_absensi = mysqli_query($conn, "SELECT * FROM absensi");
while ($row = mysqli_fetch_assoc($q_absensi)) {
    $data_map[$row['id_kursus']][$row['pertemuan']] = $row['status_pertemuan'];
}

$sql_peserta = "SELECT kursus.id_kursus, anggota.nama, anggota.alamat 
                FROM kursus 
                JOIN anggota ON kursus.id_anggota = anggota.id_anggota 
                ORDER BY kursus.id_kursus ASC";
$query_peserta = mysqli_query($conn, $sql_peserta);
?>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h1>Absensi Peserta</h1>
    </div>

    <form action="" method="POST">
        <input type="hidden" name="pertemuan_ke" value="<?= $total_pertemuan_tampil ?>">

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2" class="align-middle">No.</th>
                        <th rowspan="2" class="align-middle">Nama</th>
                        <th rowspan="2" class="align-middle">Alamat</th>
                        <th colspan="<?= $total_pertemuan_tampil ?>">Kehadiran</th>
                    </tr>
                    <tr>
                        <?php for ($i = 1; $i <= $total_pertemuan_tampil; $i++): ?>
                            <th>Pertemuan <?= $i ?></th>
                        <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query_peserta)):
                        $id_k = $row['id_kursus'];
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>

                            <?php
                            for ($p = 1; $p <= $total_pertemuan_tampil; $p++):
                                ?>
                                <td class="text-center">
                                    <?php
                                    if (isset($data_map[$id_k][$p])) {
                                        $status = $data_map[$id_k][$p];
                                        $badge = ($status == 'Hadir') ? 'success' : 'danger';
                                        echo "<span class='badge bg-$badge'>$status</span>";
                                    } else {
                                        ?>
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" name="absen[<?= $id_k ?>]"
                                                value="Hadir">
                                            <label class="form-check-label">Hadir</label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-danger">Batal</a>

    </form>
</div>