<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $koneksi->query("DELETE FROM buku WHERE id_buku='$id'");

    if ($query) {
        header("Location: buku.php");
        echo "Berhasil Menghapus Data!";
    } else {
        header("Location: buku.php");
        echo "Gagal Menghapus Data";
    }
}
