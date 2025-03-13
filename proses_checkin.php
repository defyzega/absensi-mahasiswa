<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $tanggal_hari_ini = date('Y-m-d');

    // Cek apakah mahasiswa sudah check-in hari ini
    $query = "SELECT * FROM absensi WHERE nim = ? AND DATE(masuk) = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $nim, $tanggal_hari_ini);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika sudah check-in hari ini, tampilkan pesan error
        echo "<script>alert('MA\'AF ANDA SUDAH CHECK IN HARI INI'); window.location.href='index.php';</script>";
        exit();
    }

    // Jika belum check-in, lakukan penyimpanan data
    $insert = "INSERT INTO absensi (nim, masuk) VALUES (?, NOW())";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("s", $nim);

    if ($stmt->execute()) {
        echo "<script>alert('Check-in berhasil!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal check-in. Silakan coba lagi.'); window.location.href='index.php';</script>";
    }
}
?>
