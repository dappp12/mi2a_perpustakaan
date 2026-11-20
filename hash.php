<?php
// File percobaan: hapus setelah selesai dipakai
$password = 'admin123';
// 1. Membuat hash dari password
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Password : $password <br>";
echo "Hash : $hash <br>";
echo "Panjang : " . strlen($hash) . " karakter <br><br>";
// 2. Memeriksa password dengan hash
echo "Cek 'admin123' : ";
var_dump(password_verify('admin123', $hash));
echo "<br>Cek 'salah' : ";
var_dump(password_verify('salah', $hash));
