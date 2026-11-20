
<?php

// Memeriksa apakah pengguna sudah login

if (!isset($_SESSION['pengguna'])) {

    redirect(
        'login.php',
        'warning',
        'Silakan login terlebih dahulu.'
    );
}

?>
