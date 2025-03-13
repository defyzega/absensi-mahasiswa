<?php
require_once 'config.php';

// Query hanya mengambil data absensi hari ini
$query = "SELECT a.id, a.nim, m.nama, a.masuk, a.keluar 
          FROM absensi a 
          JOIN mahasiswa m ON a.nim = m.nim 
          WHERE DATE(a.masuk) = CURDATE() 
          ORDER BY a.masuk DESC";
$result = $conn->query($query);

$no = 1;
$output = "";

// Jika ada data, tampilkan tabel
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr>
                        <td>{$no}</td>
                        <td>{$row['nim']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['masuk']}</td>
                        <td>" . ($row['keluar'] ?? '-') . "</td>
                    </tr>";
        $no++;
    }
} else {
    // Jika tidak ada data, tampilkan pesan
    $output = "<tr><td colspan='5' class='text-center'><b>MA'AF BELUM ADA DATA</b></td></tr>";
}

echo $output;
?>
