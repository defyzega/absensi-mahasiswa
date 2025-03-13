<?php
// export_pdf.php
require_once 'config.php';
require_once __DIR__ . '/vendor/tecnickcom/tcpdf/tcpdf.php';

// Buat objek PDF
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Perpustakaan Agustinus');
$pdf->SetTitle('Laporan Absensi Mahasiswa');
$pdf->setPrintHeader(false); // Matikan header default
$pdf->SetMargins(10, 10, 10); // Atur margin setelah header dihapus
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 8);
$pdf->AddPage();

// Tambahkan gambar kop surat (header)
$pdf->Image('headerkop.png', 10, 2, 250, 31.5, 'PNG'); // Sesuaikan ukuran dan posisi

// Pindah ke bawah gambar header
$pdf->Ln(18);

// Array nama hari dalam bahasa Indonesia (hanya Senin-Jumat)
$hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

// Ambil data absensi selama 7 hari terakhir (hanya Senin-Jumat)
$query = "SELECT m.nama, a.masuk, a.keluar FROM absensi a 
          JOIN mahasiswa m ON a.nim = m.nim 
          WHERE DATE(a.masuk) >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
          AND DAYOFWEEK(a.masuk) BETWEEN 2 AND 6 
          ORDER BY a.masuk";
$result = $conn->query($query);

// Susun data berdasarkan nama dan hari
$absensi = [];
while ($row = $result->fetch_assoc()) {
    $nama = $row['nama'];
    $hari_masuk = date('N', strtotime($row['masuk'])) - 1;
    $hari_keluar = $row['keluar'] ? date('N', strtotime($row['keluar'])) - 1 : null;

    if ($hari_masuk >= 5 || ($hari_keluar !== null && $hari_keluar >= 5)) {
        continue;
    }

    if (!isset($absensi[$nama])) {
        $absensi[$nama] = [
            'hari' => array_fill(0, 5, ['masuk' => '-', 'keluar' => '-'])
        ];
    }

    $absensi[$nama]['hari'][$hari_masuk]['masuk'] = date('H:i', strtotime($row['masuk']));
    if ($hari_keluar !== null) {
        $absensi[$nama]['hari'][$hari_keluar]['keluar'] = date('H:i', strtotime($row['keluar']));
    }
}

// Buat tabel header
$html = '<h2 align="center">Laporan Kunjungan Mahasiswa Skripsi dan Tesis</h2>
<h3 align="center">Perpustakaan Agustinus</h3>
<h4 align="center">Semester Genap Tahun Ajaran 2024/2025</h4>
<table border="1" cellpadding="5">
<tr>
    <th rowspan="2" width="3%" align="center" valign="middle"><b>No</b></th>
    <th rowspan="2" width="15%" align="center" valign="middle"><b>Nama</b></th>';

$lebar_hari = 16.4; // Setiap hari punya 2 kolom (Masuk + Keluar)
foreach ($hari_indonesia as $hari) {
    $html .= '<th colspan="2" width="'.$lebar_hari.'%" align="center" valign="middle"><b>' . strtoupper($hari) . '</b></th>';
}
$html .= '</tr><tr>';

foreach ($hari_indonesia as $hari) {
    $html .= '<th width="8.2%" align="center" valign="middle"><b>Masuk</b></th>
              <th width="8.2%" align="center" valign="middle"><b>Keluar</b></th>';
}
$html .= '</tr>';

// Isi tabel dengan data absensi
$no = 1;
foreach ($absensi as $nama => $data) {
    $html .= '<tr>
        <td width="3%" align="center">' . $no++ . '</td>
        <td width="15%">' . htmlspecialchars($nama) . '</td>';

    foreach ($data['hari'] as $hari) {
        $html .= '<td width="8.2%">' . htmlspecialchars($hari['masuk']) . '</td>
                  <td width="8.2%">' . htmlspecialchars($hari['keluar']) . '</td>';
    }

    $html .= '</tr>';
}
$html .= '</table>';

// Tulis ke PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Tambahkan gambar footer
$pdf->SetY(-30); // Posisikan ke bagian bawah halaman
$pdf->Image('footerkop.png', 10, 191, 280, 9, 'PNG'); // Sesuaikan ukuran dan posisi

// Tutup koneksi database
$conn->close();

// Output PDF ke browser
$pdf->Output('Laporan_Absensi.pdf', 'D');
?>
