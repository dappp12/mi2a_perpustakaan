
<?php
require 'koneksi.php';
require 'auth.php';

$judul_halaman = 'Beranda';
$menu_aktif = 'beranda';

require 'layout/header.php';

// Menghitung jumlah judul buku
$total_judul = $koneksi->query(
    "SELECT COUNT(*) AS total FROM buku"
)->fetch_assoc()['total'];

// Menghitung total stok buku
$total_stok = $koneksi->query(
    "SELECT COALESCE(SUM(stok), 0) AS total FROM buku"
)->fetch_assoc()['total'];

// Menghitung jumlah anggota
$total_anggota = $koneksi->query(
    "SELECT COUNT(*) AS total FROM anggota"
)->fetch_assoc()['total'];
?>

<h1 class="mb-1">Selamat Datang</h1>

<p class="text-muted mb-4">
    Sistem Informasi Perpustakaan
</p>

<div class="row">

    <!-- Kartu jumlah buku -->
    <div class="col-md-4 mb-3">
        <div class="card text-bg-primary h-100">

            <div class="card-body">
                <h6 class="card-title">Judul Buku</h6>

                <p class="display-5 mb-0">
                    <?= $total_judul ?>
                </p>
            </div>

            <a href="buku.php"
                class="card-footer text-white text-decoration-none">
                Lihat data buku &raquo;
            </a>

        </div>
    </div>

    <!-- Kartu total stok -->
    <div class="col-md-4 mb-3">
        <div class="card text-bg-success h-100">

            <div class="card-body">
                <h6 class="card-title">Total Stok Buku</h6>

                <p class="display-5 mb-0">
                    <?= $total_stok ?>
                </p>
            </div>

            <a href="buku.php"
                class="card-footer text-white text-decoration-none">
                Lihat data buku &raquo;
            </a>

        </div>
    </div>

    <!-- Kartu anggota -->
    <div class="col-md-4 mb-3">
        <div class="card text-bg-warning h-100">

            <div class="card-body">
                <h6 class="card-title">Anggota</h6>

                <p class="display-5 mb-0">
                    <?= $total_anggota ?>
                </p>
            </div>

            <a href="anggota.php"
                class="card-footer text-dark text-decoration-none">
                Lihat data anggota &raquo;
            </a>

        </div>
    </div>

</div>

<?php require 'layout/footer.php'; ?>
