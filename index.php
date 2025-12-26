<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->

<?php
require_once 'config.php';
?>
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1>Data Kelas Peserta</h1>
    </div>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
            <button class="nav-link" id="nav-form-tab" data-bs-toggle="tab" data-bs-target="#nav-form" type="button"
                role="tab" aria-controls="nav-form" aria-selected="false">Tambah Data</button>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
            tabindex="0">
            <div class="sec-js">
                <div class="container mt-4">
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
        </div>
        <div class="tab-pane fade" id="nav-form" role="tabpanel" aria-labelledby="nav-form-tab" tabindex="0">
            <div id="form-container" class="container mt-4"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        
        
        //Tampilkan form
        $("#nav-form-tab").click(function (e) {
            e.preventDefault();
            $("#form-container").load("insert.php", function () {
                $("#form-container").find("h1").addClass("h3 text-center mb-4");

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

        // Submit data
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