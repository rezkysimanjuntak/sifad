# Petunjuk Instalasi dan Penggunaan

## Note : Pada contoh Instalasi berikut menggunakan Xampp dan SQLYog.
1. Ekstrak sifad-master.zip pada folder htdocs Xampp. (Jika folder bernama sifad-master rename saja jadi sifad)
2. Ekstrak Data1.zip dan Data2.zip pada lokasi folder sifad.
3. Jika sudah buka cmd pada folder sifad kemudian masukkan command :
   - composer install
   - npm install
4. Kemudian buka SQLYog kemudian execute semua query yang terdapat pada sifaddb.sql
5. Tambahkan user database baru dengan :
   - username : admin
   - password : admin
   - host     : localhost
   (Dan pastikan user memiliki akses user Global Privileges "centang semua pilihan yang ada")
6. Lalu buka Xampp Control Panel kemudian Start Apache dan MySQL.
7. Langkah terakhir tinggal buka url dari sifad yaitu : http://localhost/sifad/public/
8. Pada saat muncul menu login masukkan username dan password default administrator :
   - Username : admin
   - Password : password
