-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2023 pada 17.09
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'X (Sepuluh)'),
(2, 'XI (Sebelas)'),
(7, 'XII (Dua Belas)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `mata_pelajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `mata_pelajaran`) VALUES
(1, 'Pemrograman Web'),
(3, 'Basis Data'),
(4, 'Pemrograman Berorientasi Objek'),
(6, 'Matematika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` bigint(20) NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `nis` varchar(50) NOT NULL,
  `id_ujian` bigint(20) NOT NULL,
  `benar` int(11) NOT NULL,
  `salah` int(11) NOT NULL,
  `kosong` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `predikat` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `tgl_selesai`, `nis`, `id_ujian`, `benar`, `salah`, `kosong`, `nilai`, `predikat`) VALUES
(1, '2023-08-12 20:50:52', '09773', 1, 4, 0, 0, 100, 'A'),
(2, '2023-08-12 20:52:57', '23456', 1, 3, 1, 0, 75, 'C'),
(3, '2023-08-12 21:12:20', '34567', 1, 3, 1, 0, 75, 'C'),
(4, '2023-08-13 10:17:42', '12345', 2, 3, 0, 0, 100, 'A'),
(5, '2023-08-13 10:18:21', '12345', 3, 2, 0, 0, 100, 'A'),
(6, '2023-08-13 10:21:36', '56732', 2, 3, 0, 0, 100, 'A'),
(7, '2023-08-13 10:21:52', '56732', 3, 2, 0, 0, 100, 'A'),
(8, '2023-08-13 10:23:15', '76893', 2, 2, 1, 0, 67, 'D'),
(9, '2023-08-13 10:23:35', '76893', 3, 1, 1, 0, 50, 'E'),
(10, '2023-08-13 10:25:38', '09773', 4, 4, 1, 0, 80, 'B'),
(11, '2023-08-13 10:26:26', '09773', 5, 4, 0, 0, 100, 'A'),
(12, '2023-08-13 10:27:18', '23456', 4, 2, 2, 1, 40, 'E'),
(13, '2023-08-13 10:28:08', '23456', 5, 4, 0, 0, 100, 'A'),
(14, '2023-08-13 10:29:40', '34567', 4, 4, 1, 0, 80, 'B'),
(16, '2023-08-13 22:03:41', '12345', 6, 2, 0, 0, 100, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengerjaan`
--

CREATE TABLE `pengerjaan` (
  `no_pengerjaan` bigint(20) NOT NULL,
  `tgl_pengerjaan` date NOT NULL,
  `nis` varchar(50) NOT NULL,
  `id_ujian` bigint(20) NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `password` text NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `email`, `id_kelas`, `password`, `status`) VALUES
('09773', 'Aestu Witular', 'aestuwitular91@gmail.com', 2, '9f10bc9f0a6db6aba3d00064de707045', '1'),
('12345', 'Jalar Mardika', 'jalarmardika@gmail.com', 1, 'f0783370ce4988a97dcb63a977eb6747', '1'),
('23456', 'Hendra Setiawan', 'hendrasetiawan45@gmail.com', 2, 'a04cca766a885687e33bc6b114230ee9', '1'),
('34567', 'Ahmad Suryani', 'suryaniahmad@gmail.com', 2, '5347ed5eac4f941049b2a937582847ff', '1'),
('56732', 'Muhammad Surya Mukti', 'muhammadsuryomukti@gmail.com', 1, '9870707091e577de88930ce558347125', '1'),
('76893', 'Putri Permata Sari', 'permataputri125@gmail.com', 1, '4093fed663717c843bea100d17fb67c8', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` bigint(20) NOT NULL,
  `id_ujian` bigint(20) NOT NULL,
  `soal` text NOT NULL,
  `gambar_soal` text NOT NULL,
  `pilihan_a` text NOT NULL,
  `pilihan_b` text NOT NULL,
  `pilihan_c` text NOT NULL,
  `pilihan_d` text NOT NULL,
  `pilihan_e` text NOT NULL,
  `gambar_a` text NOT NULL,
  `gambar_b` text NOT NULL,
  `gambar_c` text NOT NULL,
  `gambar_d` text NOT NULL,
  `gambar_e` text NOT NULL,
  `kunci` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id_soal`, `id_ujian`, `soal`, `gambar_soal`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `pilihan_e`, `gambar_a`, `gambar_b`, `gambar_c`, `gambar_d`, `gambar_e`, `kunci`) VALUES
(1, 1, '1 + 1 =', '', '1', '0', '2', '11', '10', '', '', '', '', '', 'C'),
(2, 1, '1 x 1 =', '', '2', '1', '0', '11', 'Semua Benar', '', '', '', '', '', 'B'),
(3, 1, '100 x 0 =', '', '1000', '100', '10', '0', '1', '', '', '', '', '', 'D'),
(4, 1, 'Yang termasuk bilangan ganjil, kecuali', '', '1', '3', '99', '2', '7', '', '', '', '', '', 'D'),
(5, 3, 'Siapa pencipta bahasa pemrograman PHP ?', '', 'Tim berners lee', 'Brendan Eich', 'Rasmus Ledorf', 'Bill Gates', 'Jef bezos', '', '', '', '', '', 'C'),
(6, 3, 'Berikut adalah teknologi pengembangan website untuk frontend developer, kecuali', '', 'HTML', 'CSS', 'Javascript', 'JQuery', 'PHP', '', '', '', '', '', 'E'),
(7, 2, 'Yang termasuk DBMS adalah', '', 'Java', 'Mysql', 'PHP', 'Python', 'Kotlin', '', '', '', '', '', 'B'),
(8, 2, 'Perhatikan query mysql berikut :&nbsp;<br />\r\n<strong>&quot;SELECT * FROM siswa&quot;</strong><br />\r\napa fungsi dari query diatas ?', '', 'Menambahkan data baru ke tabel siswa&nbsp;', 'Mengupdate data siswa', 'Menghapus Data siswa', 'Menampilkan siswa berdasarkan id', 'Menampilkan seluruh data siswa', '', '', '', '', '', 'E'),
(9, 2, 'Berikut yg termasuk database NoSQL yaitu', '', 'MongoDB', 'MySQL', 'SQL Server', 'Java', 'SQLlite', '', '', '', '', '', 'A'),
(10, 4, 'Apa kepanjangan dari DBMS ?', '', 'Database manipulation system', 'Data management system', 'Database management system&nbsp;', 'Database migration system', 'Data manipulation system', '', '', '', '', '', 'C'),
(11, 4, 'Suatu sistem yang dirancang untuk menyimpan, mengatur dan mengelola kumpulan data secara terstruktur disebut', '', 'Bahasa pemrograman', 'Web browser', 'Web server', 'Text editor', 'Database', '', '', '', '', '', 'E'),
(12, 4, 'Salah satu tipe data yg cocok untuk menyimpan data berupa angka yaitu ...', '', 'Varchar', 'Integer', 'Date', 'Text', 'Timestamp', '', '', '', '', '', 'B'),
(13, 4, 'Sebuah nilai dalam bentuk basis data yg bisa digunakan untuk identifikasi suatu baris dalam tabel disebut&nbsp;', '', 'Primary key', 'foreign key', 'unique', 'null', 'field', '', '', '', '', '', 'A'),
(14, 4, 'Perintah untuk membuat database yaitu ...', '', 'CREATE DATABASES', 'CREATE TABLE', 'CREATE DB', 'CREATE DATABASE', 'CREATE DATABASE TABLE', '', '', '', '', '', 'D'),
(15, 5, 'Siapa nama orang di atas ?', '1691895595clint-patterson-dYEuFB8KQJk-unsplash.jpg', 'Brendan eich', 'Taylor otwell', 'Rasmus ledorf', 'Bill gates', 'Elon musk', '', '', '', '', '', 'B'),
(16, 5, 'Berikut yang termasuk web browser, kecuali', '', 'Google chrome', 'Microsoft Edge', 'Javascript', 'Opera', 'Mozilla Firefox', '', '', '', '', '', 'C'),
(17, 5, 'Pada bahasa pemrograman PHP, fungsi echo adalah', '', 'Menampilkan output ke layar', 'Menyisipkan file', 'Redirec ke halaman lain', 'Convert number to string', 'Menghapus session', '', '', '', '', '', 'A'),
(18, 5, 'Kode dibawah akan menghasilkan output berupa', '1691896129ilya-pavlov-OqtafYT5kTw-unsplash.jpg', '', '', '', '', '', '1691896258markus-spiske-hvSr_CVecVI-unsplash.jpg', '1691896129james-harrison-vpOeXr5wmR4-unsplash.jpg', '1691896129pakata-goh-EJMTKCZ00I0-unsplash.jpg', '1691896129markus-spiske-iar-afB0QQw-unsplash.jpg', '1691896129altumcode-XMFZqrGyV-Q-unsplash.jpg', 'E'),
(19, 6, 'OOP merupakan singkatan dari ...', '', 'Object oriented programming', 'Oriented object programming', 'Object oriented paradigma', 'Oriented object paradigma', 'Object oracle programming', '', '', '', '', '', 'A'),
(20, 6, 'Sebuah blueprint atau cetakan untuk membuat sebuah objek disebut ..', '', 'Object', 'Inheritence', 'Encaptulation', 'Class', 'Abstraction', '', '', '', '', '', 'D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` bigint(20) NOT NULL,
  `tgl_dibuat` datetime NOT NULL,
  `jenis_ujian` varchar(100) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `jml_soal` int(11) NOT NULL,
  `waktu` int(11) NOT NULL,
  `status` varchar(8) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `tgl_dibuat`, `jenis_ujian`, `id_mapel`, `id_kelas`, `jml_soal`, `waktu`, `status`, `id_user`) VALUES
(1, '2023-08-12 20:45:10', 'Penilaian Akhir Semester II 2022/2023', 6, 1, 4, 2, '1', 1),
(2, '2023-08-12 21:26:37', 'Penilaian Tengah Semester I 2023/2024', 3, 1, 3, 1, '1', 1),
(3, '2023-08-12 21:27:05', 'Penilaian Tengah Semester I 2023/2024', 1, 1, 2, 2, '1', 1),
(4, '2023-08-12 21:27:27', 'Penilaian Tengah Semester I 2023/2024', 3, 2, 5, 3, '1', 1),
(5, '2023-08-12 21:27:59', 'Penilaian Tengah Semester I 2023/2024', 1, 2, 4, 5, '1', 1),
(6, '2023-08-13 10:50:09', 'Penilaian Tengah Semester I 2023/2024', 4, 1, 2, 5, '1', 2),
(7, '2023-08-13 10:50:24', 'Penilaian Tengah Semester I 2023/2024', 4, 2, 0, 5, '0', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `email`, `nama`, `password`, `level`) VALUES
(1, 'admin@gmail.com', 'Administrator', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(2, 'agus@gmail.com', 'Agus Hamdani', 'fdf169558242ee051cca1479770ebac3', 'Petugas'),
(4, 'haryadi@gmail.com', 'Haryadi', 'c46335eb267e2e1cde5b017acb4cd799', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `fk_ujian_nilai` (`id_ujian`),
  ADD KEY `fk_siswa_nilai` (`nis`);

--
-- Indeks untuk tabel `pengerjaan`
--
ALTER TABLE `pengerjaan`
  ADD PRIMARY KEY (`no_pengerjaan`),
  ADD KEY `fk_siswa_pengerjaan` (`nis`),
  ADD KEY `fk_ujian_pengerjaan` (`id_ujian`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `fk_kelas_siswa` (`id_kelas`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `fk_ujian_soal` (`id_ujian`);

--
-- Indeks untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `fk_kelas_ujian` (`id_kelas`),
  ADD KEY `fk_mapel_ujian` (`id_mapel`),
  ADD KEY `fk_user_ujian` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `fk_siswa_nilai` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`),
  ADD CONSTRAINT `fk_ujian_nilai` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`);

--
-- Ketidakleluasaan untuk tabel `pengerjaan`
--
ALTER TABLE `pengerjaan`
  ADD CONSTRAINT `fk_siswa_pengerjaan` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`),
  ADD CONSTRAINT `fk_ujian_pengerjaan` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`);

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_kelas_siswa` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Ketidakleluasaan untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `fk_ujian_soal` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`);

--
-- Ketidakleluasaan untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `fk_kelas_ujian` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `fk_mapel_ujian` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  ADD CONSTRAINT `fk_user_ujian` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
