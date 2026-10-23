
<?php
require_once __DIR__ . '/koneksi.php';

// TAMBAH DATA ANGGOTA
if (isset($_POST['submit'])) {

    $nim = trim($_POST['nim'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $no_hp = trim($_POST['no_hp'] ?? '');

    // Periksa apakah NIM sudah terdaftar
    $cek = $koneksi->prepare(
        "SELECT id_anggota FROM anggota WHERE nim = ?"
    );

    $cek->bind_param("s", $nim);
    $cek->execute();

    if ($cek->get_result()->num_rows > 0) {
        redirect(
            'form_anggota.php',
            'warning',
            'NIM sudah terdaftar!'
        );
    }

    // Simpan data anggota
    $stmt = $koneksi->prepare(
        "INSERT INTO anggota (nim, nama, email, no_hp)
         VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssss",
        $nim,
        $nama,
        $email,
        $no_hp
    );

    if ($stmt->execute()) {
        redirect(
            'anggota.php',
            'success',
            'Data anggota berhasil ditambahkan!'
        );
    } else {
        redirect(
            'form_anggota.php',
            'danger',
            'Gagal menambahkan data anggota!'
        );
    }
}


// EDIT DATA ANGGOTA
if (isset($_POST['update'])) {

    $id = (int) ($_POST['id_anggota'] ?? 0);
    $nim = trim($_POST['nim'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $no_hp = trim($_POST['no_hp'] ?? '');

    $stmt = $koneksi->prepare(
        "UPDATE anggota
         SET nim = ?, nama = ?, email = ?, no_hp = ?
         WHERE id_anggota = ?"
    );

    $stmt->bind_param(
        "ssssi",
        $nim,
        $nama,
        $email,
        $no_hp,
        $id
    );

    if ($stmt->execute()) {
        redirect(
            'anggota.php',
            'success',
            'Data anggota berhasil diperbarui!'
        );
    } else {
        redirect(
            'edit_anggota.php?id=' . $id,
            'danger',
            'Gagal memperbarui data anggota!'
        );
    }
}


// Jika tidak ada aksi
redirect(
    'anggota.php',
    'warning',
    'Tidak ada aksi yang dipilih!'
);
