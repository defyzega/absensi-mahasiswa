Berikut adalah format **README.md** yang lebih rapi dan mudah dicopy-paste:  

---

# Aplikasi Absensi Mahasiswa Skripsi & Tesis
Aplikasi ini digunakan untuk mencatat absensi mahasiswa yang sedang mengerjakan skripsi dan tesis.  
Data yang dikumpulkan meliputi **waktu masuk** dan **waktu keluar** mahasiswa.

## Persyaratan Sistem
Sebelum menginstal aplikasi ini, pastikan Anda telah menginstal [XAMPP](https://www.apachefriends.org/index.html) di komputer Anda.

## Konfigurasi
Setelah menginstal XAMPP, sesuaikan konfigurasi berikut agar aplikasi dapat berjalan dengan baik:

1. **Konfigurasi Apache**  
   Edit file berikut sesuai dengan kebutuhan:
   ```
   xampp/apache/conf/httpd.conf
   ```

2. **Konfigurasi MySQL**  
   Sesuaikan konfigurasi database di file berikut:
   ```
   xampp/mysql/bin/my.ini
   ```

3. **Konfigurasi PHP**  
   Pastikan pengaturan PHP sudah sesuai dengan kebutuhan aplikasi dengan mengedit file berikut:
   ```
   xampp/php/php.ini
   ```

## Cara Menggunakan
1. Jalankan **XAMPP Control Panel** dan aktifkan **Apache** serta **MySQL**.
2. Pastikan database telah dibuat dan dikonfigurasi sesuai kebutuhan.
3. Salin file aplikasi ke dalam folder `htdocs` XAMPP.
4. Akses aplikasi melalui browser dengan mengetikkan:
   ```
   http://localhost/nama-folder-aplikasi
   ```

## Lisensi
Aplikasi ini dikembangkan untuk keperluan pribadi dan akademik. Silakan gunakan serta modifikasi sesuai kebutuhan.
```
