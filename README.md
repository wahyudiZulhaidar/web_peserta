# Cara Download Kode
Nanti simpan di folder `htdocs`
![Gambar XAMPP](https://i.ibb.co.com/7sSQ1Fw/image.png)

1. Pilih tombol `Code` warna *benda itu* hijau
2. Download ZIP
3. Ekstrak 

# Persiapan Project

## 1. Konfigurasi Server Lokal XAMPP
Aktifkan `Apache` dan `MySQL` di XAMPP

![Gambar XAMPP](https://i.ibb.co.com/JjKvD93g/Cuplikan-layar-2025-12-12-094914.png)

## 2. Konfigurasi Project File
Taruh folder project dalam folder `htdocs` di direktori lokasi instalasi XAMPP, biasanya ada di

```bash
C:\xampp\htdocs
```


## 3. Database
Struktur tabel `anggota`
| Nama Kolom    | Tipe Data | Nilai           | Aturan                          |
| :--------     | :-------  | :-----          | :--                             |
| `id_anggota`  | `int`     | `11`            | `AUTO_INCREMENT`, `NOT_NULL`    |
| `nama`        | `varchar` | `255`           | `NOT_NULL`                      |   
| `alamat`      | `text`    |                 | `NOT_NULL`                      |
| `notel`       | `varchar` | `255`           | `NOT_NULL`                      |
| `email`       | `varchar` | `255`           | `NOT_NULL`                      |
| `jk`          | `enum`    | `Pria` `Wanita` | `NOT_NULL`                      |

`kursus`
| Nama Kolom            | Tipe Data | Nilai                 | Aturan                        |
| :--------             | :-------  | :--                   | :--                           |
| `id_kursus`           | `int`     | `11`                  | `AUTO_INCREMENT`, `NOT_NULL`  |
| `id_anggota`          | `int`     | `11`                  | `FOREIGN_KEY`' `NOT_NULL`     |
| `id_tingkat_kelas`    | `int`     | `11`                  | `FOREIGN_KEY`' `NOT_NULL`     |
| `status_kursus`       | `enum`    | `Aktif` `Tidak Aktif` | `Default: Aktif`, `NOT_NULL`  |

`tingkat_kelas`

| Nama Kolom            | Tipe Data | Nilai | Aturan                        |
| :--------             | :-------  | :--   | :--                           |
| `id_tingkat_kelas`    | `int`     | `11`  | `AUTO_INCREMENT`, `NOT_NULL`  |
| `tingkat_kelas`       | `varchar` | `255` | `NOT_NULL`                    |

`absensi`
| Nama Kolom            | Tipe Data | Nilai                 | Aturan                        |
| :--------             | :-------  | :--                   | :--                           |
| `id_absensi`          | `int`     | `11`                  | `AUTO_INCREMENT`, `NOT_NULL`  |
| `id_kursus`           | `int`     | `11`                  | `FOREIGN_KEY`, `NOT_NULL`     |
| `pertemuan`           | `int`     |                       | `NOT_NULL`                    |
| `status_pertemuan`    | `enum`    | `Hadir` `Tidak Hadir` | `NOT_NULL`, `Default: Hadir`  |

![ERD](https://i.ibb.co.com/Z6ZjHjK5/ERD.png)

### Pembuatan Database

#### Metode 1 - Menggunakan phpMyAdmin (Rekomendasi Pemula)
Buka phpMyAdmin di web browser

```bash
http://localhost/phpmyadmin
```
Ikuti tutorial dari sini

[Artikel](https://www.hostinger.com/id/tutorial/cara-membuat-database-mysql-phpmyadmin-xampp) atau [Video Youtube](https://youtu.be/_oPaKdmauLw)

#### Metode 2 - Kueri (Windows)
Ganti `nama_database` dan `nama_tabel` sesuai preferensi. Langkah 1 dan 2 bisa di skip dengan menggunakan kueri SQL langsung di phpMyAdmin, ada di tab `SQL`

1. Buka Terminal dan arahkan ke direktori ini

```bash
C:\xampp\mysql\bin
```

atau langsung masukkan perintah

```bash
cd C:\xampp\mysql\bin
```

> Bisa lansung pencet `Shell` di XAMPP Control Panel

2. Masukkan perintah

```bash
mysql -u root -p
```

jika tidak bisa

```bash
./mysql -u root -p
```

Enter untuk melanjutkan di bagian password (biarkan kosong)

3. Kueri pembuatan Database

```bash
CREATE DATABASE nama_database;
```
[Dokumentasi](https://www.w3schools.com/mysql/mysql_create_db.asp)

4. Pilih Database

```bash
USE nama_database;
```

5. Kueri pembuatan tabel

```bash
CREATE TABLE `peserta` ( `nomor` int(11) NOT NULL AUTO_INCREMENT, `nama` varchar(255) NOT NULL, `alamat` text NOT NULL, `telp` varchar(255) NOT NULL, `email` varchar(255) NOT NULL, `jk` enum('Pria','Wanita') NOT NULL, PRIMARY KEY (`nomor`));
```
[Dokumentasi](https://www.w3schools.com/mysql/mysql_create_table.asp)

6. Contoh Kueri isi data
```bash
INSERT INTO `peserta` (`nama`, `alamat`, `telp`, `email`, `jk`) VALUES ('Muh. Zulhaidar Wahyudi', 'Kota Makassar', '082123456789', 'zulhaidarwahyudi@gmail.com', 'Pria');
```
[Dokumentasi](https://www.w3schools.com/mysql/mysql_insert.asp)

7. Contoh Kueri ubah data, sesuaikan nomor dengan data yang akan di ubah
```bash
UPDATE peserta SET nama = 'Nama Baru Disini', alamat = 'Alamat Baru Disini', telp = '081234567890', email = 'emailbaru@gmail.com', jk = 'Wanita' WHERE nomor = 1;
```
[Dokumentasi](https://www.w3schools.com/mysql/mysql_update.asp)

8. Contoh Kueri hapus data, sesuaikan nomor dengan data yang akan dihapus
```bash
DELETE FROM peserta WHERE nomor = 1;
```
[Dokumentasi](https://www.w3schools.com/mysql/mysql_delete.asp)

9. Contoh kueri tampilkan seluruh data
```bash
SELECT * FROM peserta
```
[Dokumentasi](https://www.w3schools.com/mysql/mysql_select.asp)

## 4. Konfigurasi

Pada file `config.php` atur nama database pada kode

```bash
$db_name = 'nama_database';
```
# Bootstrap

[Website](https://getbootstrap.com)

[Dokumentasi](https://getbootstrap.com/docs/5.3/getting-started/introduction)

## Referensi Belajar
<https://www.malasngoding.com/tutorial/bootstrap>

<https://youtube.com/playlist?list=PL4cUxeGkcC9joIM91nLzd_qaH_AimmdAR&si>