# Technical Test - Backend Developer Sekawan Media
Membuat web applikasi untuk monitoring pemesanan kendaraan
## Requirement Soal
a.	Terdapat 2 user (admin dan pihak yang menyetujui)
b.	Admin dapat menginputkan pemesanan kendaraan dan menentukan driver serta pihak yang menyetujui pemesanan
c.	Persetujuan dilakukan berjenjang minimal 2 level
d.	Pihak yang menyetujui dapat melakukan persetujuan melalui aplikasi
e.	Terdapat dashboard yang menampilkan grafik pemakaian kendaraan
f.	Terdapat laporan periodik pemesanan kendaraan yang dapat di export (Excel)
g.	Buat file readme yang berisi daftar username-password, database version, php version, framework dan panduan penggunaan aplikasi.

# Web Application
Aplikasi ini dibangun menggunakan:
    - Framework         : Laravel 10.14.1
    - PHP Version       : 8.1.17
    - Composer Version  : 2.4.4
    - Database          : MySQL (MariaDB 10.4.28)
    - Environment       : local
    - URL               : localhost

## Panduan Penggunaan
1. Login menggunakan username dan password pada url/user/login.
2. Semua user admin dapat menambahkan pemesanan namun tidak dapat menyetujui pemesanan.
3. Semua user approver dapat menyetujui pemesanan namun tidak dapat menambahkan pemesanan.
4. Ketika user admin menambahkan pemesanan, pastikan semua field telah diisi dan tanggal mulai pemesanan tidak melebihi tanggal akhir pemesanan.
5. Kedua user dapat melihat daftar pemesanan terbaru dan daftar kendaraan.
6. Daftar pemesanan dapat di-export dalam bentuk csv maupun xlsx.
7. Beberapa proses yang terjadi akan dicatat dalam process.log.
8. Diharapkan untuk melakukan logout pada bagian kanan atas layar setelah menggunakan aplikasi.

# User terdaftar
1.  username    : admin
    password    : password
    role        : admin grade 1
2.  username    : approver
    password    : password
    role        : approver grade 4


Aplikasi ini dibuat oleh Imam Rafiif Arrazaan