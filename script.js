function showForm(action) {
    document.getElementById('form-container').style.display = 'block';
    document.getElementById('action').value = action;
    document.getElementById('absensi-form').setAttribute('action', action === 'checkin' ? 'proses_checkin.php' : 'proses_checkout.php');

    let instruction = document.getElementById('instruction-text');
    instruction.innerHTML = action === 'checkin' ? 
        "Check In" : 
        "Check Out";
    instruction.style.display = 'block';
}

function hideInstruction() {
    let nimInput = document.getElementById('nim');
    let instruction = document.getElementById('instruction-text');

    if (nimInput.value.length > 0) {
        instruction.style.display = 'none';
    } else {
        instruction.style.display = 'block';
    }
}

function loadAbsensi() {
    fetch('get_absensi.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('absensi-container').style.display = 'block';
            document.getElementById('absensi-table-body').innerHTML = data;
        })
        .catch(error => console.error('Gagal mengambil data:', error));
}

function updateDateTime() {
    const now = new Date();
    const hariIndo = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    const bulanIndo = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    const hari = hariIndo[now.getDay()];
    const tanggal = now.getDate();
    const bulan = bulanIndo[now.getMonth()];
    const tahun = now.getFullYear();
    const jam = now.getHours().toString().padStart(2, '0');
    const menit = now.getMinutes().toString().padStart(2, '0');
    const detik = now.getSeconds().toString().padStart(2, '0');

    document.getElementById('datetime').innerHTML = `${hari}, ${tanggal} ${bulan} ${tahun} - ${jam}:${menit}:${detik}`;
}

setInterval(updateDateTime, 1000);
updateDateTime();
