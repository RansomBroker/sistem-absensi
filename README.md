1. buat database
2. import database unchek bagian "enable foreign key check"
3. rename connection.example.php menjadi connection.php
4. dah konfigurasi sesuai localhost
5. login default admin adalah

username : admin
password :123

#Catatan

untuk absensi pastikan enable kamera dan location

#Catatan 
file checker.php berisi file yang melakukan pengecekan keterlambatan mahasiswa, dengan mengecek kelas yg telah usai jika kelas usai dan data mahasiswa tidak terdapat di table presensi maka checker akan menambahkan mahasiswa bersangkutan kedalam absen dengan status alpha dan koordinat yg telah di tentukan dalam coding.

jika ingin merubah gambar default dari checker ubah file absensi/Alpha.png menjadi gambar yg diinginkan, lalu rename menjadi Alpha.png. atau ubah nama file di file chekcer.php line 83, begitu juga koordinat

