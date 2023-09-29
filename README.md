# Aplikasi Perhitungan Point Pelanggaran Siswa Dengan Metode Fuzzy Tsukamoto

Aplikasi ini dibuat untuk memprediksi suatu sanksi atau teguran kepada siswa yang melakukan pelanggaran dengan menghitung variabel input (Prestasi, Pelanggran) yang dimiliki siswa terhadap output (Tindakan) sehingga diharapkan mempermudah bagi guru BK untuk menentukan sanksi atau tindakan apa yang akan dilakukan terhadap siswa yang berbasis pengetahuan menggunakan metode Fuzzy Tsukamoto.

### Requirement

-   Terinstall Node JS https://nodejs.org/en/download
-   Terinstall GIT untuk menjalankan Command git https://git-scm.com/download/win
-   Composer versi up to 2.4 https://getcomposer.org/Composer-Setup.exe
-   PHP minimum versi 8.1
-   Anda bisa menggunakan tools dibawah ini: (Pilih salah satu)

*   XAMPP: https://www.apachefriends.org/download.html
*   LARAGON: https://laragon.org/download/index.html
*   WampServer: https://sourceforge.net/projects/wampserver/

### Instalasi

-   Clone projek ini dengan perintah berikut

```
https://github.com/hariaja/student-violation-apps.git
```

-   Buka terminal projek setelah meng-clone, kemudian jalankan perintah dibawah ini

```
composer install
```

```
cp .env.example .env
```

```
php artisan key:generate
```

```
npm install
```

```
npm run dev
```

-   Konfigurasi database (MySQL, PosgreSQL dll)
-   Hubungkan database (yang sudah dibuat) dengan projek
-   Kemudian jalankan perintah dibawah ini

```
php artisan migrate:fresh --seed
```

-   Jalankan serve dengan:

```
php artisan serve
```

-   Jika ketika menjalankan projek ada gambar yang tidak muncul, cukup jalankan perintah

```
php artisan storage:link
```

-   LARAVEL DOCUMENTATION: https://laravel.com/docs/10.x
