<?php
require 'koneksi.php';

// Jika file ini dibuka langsung tanpa mengirim form
if (!isset($_POST['login'])) {
    header('Location: login.php');
    exit;
}
$email = trim($_POST['email']);
$password = $_POST['password'];
// 1. Cari pengguna berdasarkan email (prepared statement)
$stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
// 2. Cocokkan password yang diketik dengan hash di database
if ($user && password_verify($password, $user['password'])) {
    // Login berhasil: ganti ID session, lalu simpan data pengguna
    session_regenerate_id(true);
    $_SESSION['pengguna'] = [
        'id' => $user['id_pengguna'],
        'nama' => $user['nama'],
        'email' => $user['email'],
        'level' => $user['level']
    ];
    $nama = htmlspecialchars($user['nama']);
    redirect('index.php', 'success', "Selamat datang, $nama!");
}
// 3. Login gagal: pesan sengaja dibuat sama untuk email salah maupun password salah
redirect('login.php', 'danger', 'Email atau password salah.');
