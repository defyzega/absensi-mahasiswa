<?php
// config.php
$host = 'localhost';
$user = 'root'; // Sesuaikan dengan username MySQL Anda
$pass = ''; // Sesuaikan jika ada password MySQL
$db   = 'absensi_perpus';

// Buat koneksi menggunakan MySQLi
$conn = new mysqli($host, $user, $pass, $db);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set timezone ke Jakarta
date_default_timezone_set('Asia/Jakarta');
?>
