<?php
require 'koneksi.php';
// 1. Kosongkan semua data session, lalu hancurkan session-nya
$_SESSION = [];
session_destroy();
// 2. Mulai session baru (kosong) agar pesan logout dapat disimpan
session_start();
redirect('login.php', 'success', 'Anda berhasil logout.');
