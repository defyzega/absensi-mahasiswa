<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="container mt-4">
    <img src="logo.png" alt="Logo" class="logo"> 

    <div class="header-container">
        <h2>STT REFORMED INJILI INTERNASIONAL</h2> 
        <h2>PERPUSTAKAAN AGUSTINUS</h2>
        <h3>ABSENSI MAHASISWA SKRIPSI DAN TESIS</h3>
    </div>

    <div class="datetime-container" id="datetime"></div>

    <?php include 'navbar.php'; ?>

    <div class="text-center mt-5">
        <button class="btn btn-success" onclick="showForm('checkin')">Check-in</button>
        <button class="btn btn-danger" onclick="showForm('checkout')">Check-out</button>
    </div>
    
    <?php include 'form_absensi.php'; ?>
    <?php include 'data_absensi.php'; ?>

    <footer>Perpustakaan Agustinus 2025</footer>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
