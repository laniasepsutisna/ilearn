![ilearn-logo](https://github.com/alfredcrosby/ilearn/blob/master/logo.png?raw=true)
# iLearn

**CATATAN :** Aplikasi ini belum siap untuk *production* mohon dipertimbangkan jika akan digunakan.

iLearn merupakan sistem pembelajaran online menggunakan Laravel. Fitur yang terdapat di software ini antara lain:

- Membagikan pengumuman ke guru atau siswa.
- Manajemen kelas
- Membuat, mengerjakan dan mengumpulkan tugas.
- Membuat, membagikan dan membaca materi ke tiap kelas.
- Membuat, membagikan dan menjawab quiz pilihan ganda.
- Diskusi di tiap kelas.

## Instalation
1. Clone repository ini dengan menjalankan perintah pada terminal 
```git clone https://github.com/alfrcr/ilearn.git```
2. Masuk ke folder ilearn dengan perintah `cd ilearn`
3. Jalankan composer
```composer install``
4. Copy dan paste file `.env.example` lalu ubah menjadi `.env`
5. Atur sesuaikan konfigurasi database anda.
6. Jalankan migrasi untuk membuat table
```php artisan migrate --seed```
7. Selesai

## Screenshot
1. Halaman admin.
![ilearn-ss-admin](https://raw.githubusercontent.com/alfrcr/ilearn/master/ss-1.png)
2. Halaman guru.
![ilearn-ss-teacher-dashboard](https://raw.githubusercontent.com/alfrcr/ilearn/master/ss-2.png)
3. Halaman kelas.
![ilearn-ss-classroom](https://raw.githubusercontent.com/alfrcr/ilearn/master/ss-3.png)
4. Halaman share materi.
![ilearn-ss-share-course](https://raw.githubusercontent.com/alfrcr/ilearn/master/ss-4.png)
5. Halaman home mobile.
![ilearn-ss-mobile](https://raw.githubusercontent.com/alfrcr/ilearn/master/ss-5.png)

## Credential
Admin:
```html
username: admin
password: secret
```

Guru:
```html
username: timoti
password: secret
```

Siswa:
```html
username: reynold
password: secret
```

## Troubleshooting
Silakan buat [issue](https://github.com/alfredcrosby/ilearn/issues) baru.

## License

iLearn berlisensi [GPL-3](https://github.com/alfredcrosby/ilearn/blob/master/LICENSE).

