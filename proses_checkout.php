<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $tanggal_hari_ini = date('Y-m-d');

    // Cek apakah mahasiswa sudah check-out hari ini
    $query = "SELECT * FROM absensi WHERE nim = ? AND DATE(keluar) = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $nim, $tanggal_hari_ini);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika sudah check-out hari ini, tampilkan pesan error
        echo "<script>alert('MA\'AF ANDA SUDAH CHECK OUT HARI INI'); window.location.href='index.php';</script>";
        exit();
    }

    // Cek apakah mahasiswa sudah check-in sebelum check-out
    $query = "SELECT * FROM absensi WHERE nim = ? AND DATE(masuk) = ? AND keluar IS NULL";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $nim, $tanggal_hari_ini);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Jika belum check-in, tampilkan pesan error
        echo "<script>alert('ANDA BELUM MELAKUKAN CHECK-IN HARI INI!'); window.location.href='index.php';</script>";
        exit();
    }

    // Jika belum check-out, lakukan update data untuk menambahkan waktu keluar
    $update = "UPDATE absensi SET keluar = NOW() WHERE nim = ? AND DATE(masuk) = ? AND keluar IS NULL";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ss", $nim, $tanggal_hari_ini);

    if ($stmt->execute()) {
        echo "<script>alert('Check-out berhasil!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal check-out. Silakan coba lagi.'); window.location.href='index.php';</script>";
    }
}
?>
