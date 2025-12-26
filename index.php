<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->

<?php
require_once 'config.php';
?>

<div class="sec-php">
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h1>Data Peserta (Versi PHP)</h1>
        </div>

        <a href="insert.php" class="btn btn-primary mb-3">Tambah Data Baru</a>
        <a href="tambahAnggota.php" class="btn btn-primary mb-3"> Tambah Anggota Baru </a>
        <a href="absensi.php" class="btn btn-primary mb-3"> Absensi Peserta </a>

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
            <tbody id="tabel-body-php">
                <?php include 'get_data.php'; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="sec-js" style="display:none;">
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h1>Data Peserta (Versi JS)</h1>
        </div>

        <button id="btn-tambah-data" class="btn btn-primary mb-3">Tambah Data Baru</button>
        <a href="tambahAnggota.php" class="btn btn-primary mb-3"> Tambah Anggota Baru</a>
        <a href="absensi.php" class="btn btn-primary mb-3"> Absensi Peserta</a>

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
            <tbody id="tabel-body-js">
                <?php include 'get_data.php'; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container mt-3">
    <button id="btn-toggle-js" class="btn btn-secondary">Ubah Halaman Ke Javascript</button>
</div>

<div id="form-container" class="container mt-4"></div>

<script>
    $(document).ready(function () {

        //Ubah Versi
        $("#btn-toggle-js").click(function () {
            $(".sec-php").toggle();
            $(".sec-js").toggle();
            $("#form-container").empty();
            var textBtn = $(".sec-js").is(":visible") ? " Kembali ke PHP" : "Ubah Halaman Ke Javascript";
            $(this).text(textBtn);
        });

        //Tampilkan form
        $("#btn-tambah-data").click(function (e) {
            e.preventDefault();
            $("#form-container").load("insert.php", function () {
                $("#form-container").find("h1").closest("div").hide();

                var btnBatal = $("#form-container").find(".btn-danger");

                btnBatal.text("Selesai");
                btnBatal.attr("id", "btn-batal");
                btnBatal.removeClass("btn-danger").addClass("btn-success")

                $('html, body').animate({ scrollTop: $("#form-container").offset().top }, 500);
            });
        });

        // Batal tambah data
        $(document).on("click", "#btn-batal", function (e) {
            if ($("#form-container").is(":visible") && $(".sec-js").is(":visible")) {
                e.preventDefault();
                $("#form-container").empty();
                $('html, body').animate({ scrollTop: 0 }, 500);
            }
        });

        // Submit data versi JS
        $(document).on("submit", "#form-container form", function (e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var currentForm = $(this);

            formData += "&ajax=1";

            $.ajax({
                type: "POST",
                url: "add_data.php",
                data: formData,
                success: function (response) {
                    if (response.trim() == "success") {
                        $("#tabel-body-js").load("get_data.php");
                        $("#tabel-body-php").load("get_data.php");
                        $('html, body').animate({ scrollTop: 0 }, 500);

                        currentForm.trigger("reset");
                    } else {
                        alert("Gagal: " + response);
                    }
                }, error: function () {
                    alert("Kesalahan koneksi ke server.");
                }
            });
        });
    });
</script>