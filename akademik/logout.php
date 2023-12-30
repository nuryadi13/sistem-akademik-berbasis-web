<?php
session_start();

// Hapus semua data sesi
session_unset();
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: index.php");
exit();
?>
