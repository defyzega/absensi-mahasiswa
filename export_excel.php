<?php
// export_excel.php
require_once 'config.php';
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Tambahkan judul laporan
$sheet->setCellValue('A1', 'Laporan Kunjungan Mahasiswa Skripsi dan Tesis');
$sheet->setCellValue('A2', 'Perpustakaan Agustinus');
$sheet->setCellValue('A3', 'Semester Genap Tahun Ajaran 2024/2025');
$sheet->mergeCells('A1:M1');
$sheet->mergeCells('A2:M2');
$sheet->mergeCells('A3:M3');
$sheet->getStyle('A1:A3')->getFont()->setBold(true);
$sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// Header kolom
$sheet->setCellValue('A5', 'No');
$sheet->setCellValue('B5', 'NIM');
$sheet->setCellValue('C5', 'Nama');

$hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
$col = 'D';
foreach ($hari_indonesia as $hari) {
    $sheet->setCellValue($col . '5', strtoupper($hari));
    $sheet->setCellValue($col . '6', 'Masuk');
    $col++;
    $sheet->setCellValue($col . '6', 'Keluar');
    $col++;
}

// Merge header
$sheet->mergeCells('A5:A6');
$sheet->mergeCells('B5:B6');
$sheet->mergeCells('C5:C6');
$col = 'D';
foreach ($hari_indonesia as $hari) {
    $sheet->mergeCells($col . '5:' . chr(ord($col) + 1) . '5');
    $col = chr(ord($col) + 2);
}

// Ambil data absensi selama 7 hari terakhir (hanya Senin-Jumat)
$query = "SELECT a.nim, m.nama, a.masuk, a.keluar FROM absensi a 
          JOIN mahasiswa m ON a.nim = m.nim 
          WHERE DATE(a.masuk) >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
          AND DAYOFWEEK(a.masuk) BETWEEN 2 AND 6 -- Hanya Senin (2) sampai Jumat (6)
          ORDER BY a.nim, a.masuk";
$result = $conn->query($query);

// Susun data berdasarkan NIM dan hari
$absensi = [];
while ($row = $result->fetch_assoc()) {
    $nim = $row['nim'];
    $nama = $row['nama'];
    $hari_masuk = date('N', strtotime($row['masuk'])) - 1; // 0=Senin, 6=Minggu
    $hari_keluar = $row['keluar'] ? date('N', strtotime($row['keluar'])) - 1 : null;

    if ($hari_masuk >= 5 || ($hari_keluar !== null && $hari_keluar >= 5)) {
        continue;
    }

    if (!isset($absensi[$nim])) {
        $absensi[$nim] = [
            'nama' => $nama,
            'hari' => array_fill(0, 5, ['masuk' => '-', 'keluar' => '-']) // Hanya Senin-Jumat
        ];
    }

    $absensi[$nim]['hari'][$hari_masuk]['masuk'] = date('H:i', strtotime($row['masuk']));
    if ($hari_keluar !== null) {
        $absensi[$nim]['hari'][$hari_keluar]['keluar'] = date('H:i', strtotime($row['keluar']));
    }
}

// Isi data
$rowNum = 7;
$no = 1;
foreach ($absensi as $nim => $data) {
    $sheet->setCellValue('A' . $rowNum, $no++);
    $sheet->setCellValue('B' . $rowNum, $nim);
    $sheet->setCellValue('C' . $rowNum, $data['nama']);

    $col = 'D';
    foreach ($data['hari'] as $hari) {
        $sheet->setCellValue($col . $rowNum, $hari['masuk']);
        $col++;
        $sheet->setCellValue($col . $rowNum, $hari['keluar']);
        $col++;
    }
    $rowNum++;
}

$writer = new Xlsx($spreadsheet);
$fileName = 'Laporan_Absensi.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
?>