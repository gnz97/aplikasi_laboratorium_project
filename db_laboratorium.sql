-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql213.epizy.com
-- Waktu pembuatan: 22 Jun 2021 pada 06.18
-- Versi server: 5.6.48-88.0
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_28907342_db_laboratorium`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_antrian`
--

CREATE TABLE `tb_antrian` (
  `antrianID` int(11) NOT NULL,
  `antrianNO` varchar(10) DEFAULT NULL,
  `tgl_antrian` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_antrian_detail`
--

CREATE TABLE `tb_antrian_detail` (
  `detail_antrianID` int(11) NOT NULL,
  `detail_antrianNo` varchar(11) DEFAULT NULL,
  `detail_antrianStatus` varchar(255) DEFAULT NULL,
  `detail_antrainTgl` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_antrian_detail`
--

INSERT INTO `tb_antrian_detail` (`detail_antrianID`, `detail_antrianNo`, `detail_antrianStatus`, `detail_antrainTgl`) VALUES
(69, 'A001', 'terpanggil', '2021-06-19 10:19:21'),
(70, 'A001', 'terpanggil', '2021-06-21 09:50:42'),
(71, 'A001', 'terpanggil', '2021-06-22 05:52:01'),
(72, 'A001', 'terpanggil', '2021-06-22 05:52:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bidang_pemeriksaan`
--

CREATE TABLE `tb_bidang_pemeriksaan` (
  `bidangID` int(11) NOT NULL,
  `bidangNama` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bidang_pemeriksaan`
--

INSERT INTO `tb_bidang_pemeriksaan` (`bidangID`, `bidangNama`) VALUES
(1, 'HEMATOLOGI'),
(2, 'KIMIA KLINIK'),
(3, 'IMUNOLOGI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `dokterID` int(11) NOT NULL,
  `dokterNama` varchar(255) DEFAULT NULL,
  `dokterJk` varchar(255) DEFAULT NULL,
  `dokterTandaTangan` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dokter`
--

INSERT INTO `tb_dokter` (`dokterID`, `dokterNama`, `dokterJk`, `dokterTandaTangan`) VALUES
(14, 'Dr. Vincenzo Cassano', 'laki-laki', 'tandatangan-210621-ff455b6b4b.png'),
(19, 'Dr. Siti Maemunaah', 'perempuan', 'tandatangan-210618-86fc231798.png'),
(20, 'Dr Jamet', 'laki-laki', 'tandatangan-210618-debe29497e.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_param_pemeriksaan`
--

CREATE TABLE `tb_param_pemeriksaan` (
  `paramID` int(11) NOT NULL,
  `bidang_ID` int(11) NOT NULL,
  `satuan_ID` int(11) NOT NULL,
  `paramNama` varchar(100) NOT NULL,
  `paramStatus` varchar(50) NOT NULL,
  `paramNilaiRujukan` varchar(50) NOT NULL,
  `paramHarga` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_param_pemeriksaan`
--

INSERT INTO `tb_param_pemeriksaan` (`paramID`, `bidang_ID`, `satuan_ID`, `paramNama`, `paramStatus`, `paramNilaiRujukan`, `paramHarga`) VALUES
(1, 1, 3, 'Hemoglobin', 'laki-laki', '13-17', '8000'),
(2, 1, 3, 'Hemoglobin', 'perempuan', '12-15', '8000'),
(4, 1, 4, 'Eritrosit', 'laki-laki', '4,5-6,2', '17000'),
(5, 1, 5, 'Hematokrit', 'laki-laki', '40-54', '8000'),
(7, 1, 5, 'Hematokrit', 'perempuan', '35-47', '8000'),
(8, 1, 4, 'Eritrosit', 'perempuan', '4,0-5,5', '17000'),
(9, 1, 6, 'Leukosit', 'umum', '4-11', '17000'),
(10, 1, 6, 'Trombosit', 'umum', '150-400', '17000'),
(11, 1, 7, 'Masa Perdarahan', 'umum', '1-3', '10000'),
(12, 1, 7, 'Masa Pembekuan', 'umum', '5-15', '10000'),
(13, 2, 8, 'Gula Darah Puasa', 'umum', '75-115', '20000'),
(14, 2, 8, 'Gula Darah Sewaktu', 'umum', '&lt;200', '20000'),
(15, 2, 8, 'Kolesterol Total', 'umum', '&lt;200', '18000'),
(16, 2, 8, 'Kolesterol HDL', 'umum', '>45', '30000'),
(17, 2, 8, 'Kolesterol LDL', 'umum', '&lt;150', '30000'),
(18, 2, 8, 'Trigliserida', 'umum', '&lt;150', '20000'),
(19, 2, 8, 'Ureum', 'umum', '10-50', '20000'),
(20, 2, 8, 'Protein Total', 'umum', '6,6-8,7', '21500'),
(21, 2, 8, 'Albumin', 'umum', '3,8-5,1', '20000'),
(22, 2, 8, 'Bilirubin Total', 'umum', '0-1,1', '23000'),
(23, 2, 8, 'Bilirubin Direk', 'umum', '0-0,25', '23000'),
(24, 2, 8, 'Bilirubin Indirek', 'umum', '0-0,80', '23000'),
(25, 2, 13, 'Kreatinin', 'laki-laki', '0,6-1,1', '20000'),
(26, 2, 13, 'Kreatinin', 'perempuan', '0,5-0,9', '20000'),
(27, 2, 13, 'Asam Urat', 'laki-laki', '3,4-7,0', '23000'),
(28, 2, 13, 'Asam Urat', 'perempuan', '2,4-5,7', '23000'),
(29, 2, 13, 'SGOT', 'laki-laki', '&lt;37', '21500'),
(30, 2, 13, 'SGOT', 'perempuan', '&lt;31', '21500'),
(31, 2, 13, 'SGPT', 'laki-laki', '&lt;42', '21500'),
(32, 2, 13, 'SGPT', 'perempuan', '&lt;32', '21500'),
(33, 2, 9, 'Kalium', 'umum', '3,6-5,5', '30000'),
(34, 2, 9, 'Natrium', 'umum', '135-155', '30000'),
(35, 2, 9, 'Kalsium', 'umum', '8,1-10,4', '30000'),
(36, 2, 1, 'Sedimentasi Urine', 'umum', '', '23000'),
(37, 3, 1, 'IgG Toxoplasma', 'umum', 'Non Reaktif', '165000'),
(38, 3, 1, 'IgM Toxoplasma', 'umum', 'Non Reaktif', '165000'),
(39, 3, 1, 'IgG Rubella', 'umum', 'Non Reaktif', '193000'),
(40, 3, 1, 'IgM Rubella', 'umum', 'Non Reaktif', '210000'),
(41, 3, 1, 'IgG CMV ', 'umum', 'Non Reaktif', '195000'),
(42, 3, 1, 'IgM CMV', 'umum', 'Non Reaktif', '195000'),
(43, 3, 1, 'HbsAg', 'umum', 'Non Reaktif', '75000'),
(44, 3, 1, 'Anti Hbs', 'umum', 'Non Reaktif', '110000'),
(45, 3, 1, 'Anti HBs Titer', 'umum', 'Non Reaktif', '174000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_param_satuan`
--

CREATE TABLE `tb_param_satuan` (
  `satuanID` int(11) NOT NULL,
  `satuanNama` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_param_satuan`
--

INSERT INTO `tb_param_satuan` (`satuanID`, `satuanNama`) VALUES
(1, 'kosong'),
(3, 'gr/dl'),
(4, 'juta/mm3'),
(5, '%'),
(6, 'ribu/mm3'),
(7, 'menit'),
(8, 'mg/dl'),
(9, 'mmol/l'),
(13, 'ml/dl');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `pasienID` int(11) NOT NULL,
  `pasienNoRM` varchar(255) DEFAULT NULL,
  `pasienNoIdentitas` varchar(255) DEFAULT NULL,
  `pasienNamaLengkap` varchar(255) DEFAULT NULL,
  `pasienEmail` varchar(255) DEFAULT NULL,
  `pasienTempatLahir` varchar(255) DEFAULT NULL,
  `pasienTglLahir` date DEFAULT NULL,
  `pasienUmur` int(11) DEFAULT NULL,
  `pasienJK` varchar(255) DEFAULT NULL,
  `pasienStatus` varchar(255) DEFAULT NULL,
  `pasienAlamat` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pasien`
--

INSERT INTO `tb_pasien` (`pasienID`, `pasienNoRM`, `pasienNoIdentitas`, `pasienNamaLengkap`, `pasienEmail`, `pasienTempatLahir`, `pasienTglLahir`, `pasienUmur`, `pasienJK`, `pasienStatus`, `pasienAlamat`) VALUES
(18, '654321', '7207079610000000', 'Fifin Shabrinawati', 'larasnurshabrinawati16@gmail.com', 'Sleman', '1991-01-01', 30, 'perempuan', 'Umum', 'Sleman, Yogyakarta'),
(19, '654322', '630707851000000', 'Vino Saputra', 'risalardan@gmail.com', 'Bantul', '2000-02-20', 21, 'laki-laki', 'Umum', 'Bantul, Yogyakarta'),
(20, '654323', '5202399320000002', 'Cetta Elzira', 'celziraa@gmail.com', 'Salakan', '2006-06-20', 15, 'perempuan', 'Umum', 'Salakan'),
(21, '67854', '6666666', 'Luthfiana Ramadhani', 'Lramadhani', 'Semarang', '1998-10-14', 22, 'perempuan', 'AKSES', 'rumah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemeriksaan`
--

CREATE TABLE `tb_pemeriksaan` (
  `pemeriksaanID` int(11) NOT NULL,
  `pemeriksaan_pasienID` int(11) DEFAULT NULL,
  `pemeriksaanDokter` varchar(255) DEFAULT NULL,
  `pemeriksaanUnitPengirim` varchar(255) DEFAULT NULL,
  `pemeriksaanDokterPJ_ID` int(11) DEFAULT NULL,
  `pemeriksaan_PetugasID` int(11) DEFAULT NULL,
  `pemeriksaanStatus` varchar(255) DEFAULT NULL,
  `pemeriksaanKet` text,
  `tgl_pendaftaran` datetime DEFAULT NULL,
  `tgl_penerimaanSample` datetime DEFAULT NULL,
  `tgl_pemeriksaanSample` datetime DEFAULT NULL,
  `tgl_penerimaanHasil` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pemeriksaan`
--

INSERT INTO `tb_pemeriksaan` (`pemeriksaanID`, `pemeriksaan_pasienID`, `pemeriksaanDokter`, `pemeriksaanUnitPengirim`, `pemeriksaanDokterPJ_ID`, `pemeriksaan_PetugasID`, `pemeriksaanStatus`, `pemeriksaanKet`, `tgl_pendaftaran`, `tgl_penerimaanSample`, `tgl_pemeriksaanSample`, `tgl_penerimaanHasil`) VALUES
(86, 19, 'Dr Febrian', 'Yogyakarta', 14, 10, 'Selesai Pemeriksaan', 'Data Uji Coba 2', '2021-06-21 12:32:24', '2021-06-21 22:33:00', '2021-06-21 22:33:00', '2021-06-21 22:34:00'),
(84, 20, 'Dr. Khalfani', 'Klinik Artha Husada', 14, 10, 'Selesai Pemeriksaan', 'Pasien harus menjaga pola makan dengan teratur', '2021-06-21 11:02:54', '2021-06-21 09:47:00', '2021-06-21 09:56:00', '2021-06-21 10:28:00'),
(85, 18, 'Dr Fernado', 'Yogyakarata', 14, 22, 'Selesai Pemeriksaan', 'Data Uji Coba', '2021-06-21 12:04:51', '2021-06-21 22:06:00', '2021-06-21 22:06:00', '2021-06-21 22:06:00'),
(87, 21, 'Dr Jamet', 'Klinik Gading', 20, 10, 'Selesai Pemeriksaan', '-', '2021-06-21 23:51:32', '2021-06-22 10:08:00', '2021-06-22 10:11:00', '2021-06-22 10:18:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemeriksaan_detail`
--

CREATE TABLE `tb_pemeriksaan_detail` (
  `dPemeriksaanID` int(11) NOT NULL,
  `pemeriksaan_ID` int(11) DEFAULT NULL,
  `pemeriksaanParameter_ID` int(11) DEFAULT NULL,
  `dHasil` varchar(255) DEFAULT NULL,
  `dKeterangan` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pemeriksaan_detail`
--

INSERT INTO `tb_pemeriksaan_detail` (`dPemeriksaanID`, `pemeriksaan_ID`, `pemeriksaanParameter_ID`, `dHasil`, `dKeterangan`) VALUES
(216, 85, 2, '13', 'Normal'),
(215, 84, 12, '6', 'Normal'),
(214, 84, 11, '1,5', 'Normal'),
(213, 84, 10, '217', 'Normal'),
(217, 85, 7, '23', 'Normal'),
(218, 85, 12, '33', 'Normal'),
(219, 86, 1, '23', 'Normal'),
(220, 86, 4, '32', 'Normal'),
(221, 87, 2, '13', 'Normal'),
(222, 87, 8, '4,7', 'Normal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemeriksaan_interpretasi`
--

CREATE TABLE `tb_pemeriksaan_interpretasi` (
  `InterpretasiID` int(11) NOT NULL,
  `interpretasiPemeriksaan_ID` int(11) DEFAULT NULL,
  `Interpretasi` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pemeriksaan_interpretasi`
--

INSERT INTO `tb_pemeriksaan_interpretasi` (`InterpretasiID`, `interpretasiPemeriksaan_ID`, `Interpretasi`) VALUES
(47, 84, 'Jumlah trombosit pasien normal'),
(46, 84, 'Masa pembekuan dan masa perdarahan pasien normal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemeriksaan_sample`
--

CREATE TABLE `tb_pemeriksaan_sample` (
  `samplePemeriksaanID` int(11) NOT NULL,
  `pemeriksaanSample_ID` int(11) DEFAULT NULL,
  `sample_ID` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pemeriksaan_sample`
--

INSERT INTO `tb_pemeriksaan_sample` (`samplePemeriksaanID`, `pemeriksaanSample_ID`, `sample_ID`) VALUES
(80, 86, 1),
(79, 85, 1),
(78, 84, 1),
(81, 86, 5),
(82, 87, 1),
(83, 87, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemeriksaan_saran`
--

CREATE TABLE `tb_pemeriksaan_saran` (
  `SaranID` int(11) NOT NULL,
  `saranPemeriksaan_ID` int(11) DEFAULT NULL,
  `Saran` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `petugasID` int(11) NOT NULL,
  `petugasNama` varchar(255) DEFAULT NULL,
  `petugasUser` varchar(255) DEFAULT NULL,
  `petugasPass` varchar(255) DEFAULT NULL,
  `petugasTandaTangan` varchar(255) DEFAULT NULL,
  `petugasLevel` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_petugas`
--

INSERT INTO `tb_petugas` (`petugasID`, `petugasNama`, `petugasUser`, `petugasPass`, `petugasTandaTangan`, `petugasLevel`) VALUES
(1, 'admin1', 'admin', 'admin', '', '1'),
(10, 'petugas Laboratorium 1', 'laboratorium', 'laboratorium', 'tandatanganPetugas-210618-93af0d0d1a.png', '3'),
(11, 'petugas Pendaftran 1', 'petugaspendaftaran', 'petugaspendaftaran', 'DataKosong', '2'),
(19, 'Manager Mutu', 'managermutu123', 'managermutu123', NULL, '4'),
(22, 'Octoviani Clarestya', 'atlmclarestya', 'atlmclarestya', 'tandatanganPetugas-210621-f6c0f2539a.png', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sample`
--

CREATE TABLE `tb_sample` (
  `sampleID` int(11) NOT NULL,
  `sampleNama` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sample`
--

INSERT INTO `tb_sample` (`sampleID`, `sampleNama`) VALUES
(1, 'Darah'),
(4, 'Urine'),
(5, 'Serum'),
(6, 'Plasma');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_status_pemeriksaan`
--

CREATE TABLE `tb_status_pemeriksaan` (
  `statusPemeriksaanID` int(11) NOT NULL,
  `statusPemeriksaanNama` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_antrian`
--
ALTER TABLE `tb_antrian`
  ADD PRIMARY KEY (`antrianID`);

--
-- Indeks untuk tabel `tb_antrian_detail`
--
ALTER TABLE `tb_antrian_detail`
  ADD PRIMARY KEY (`detail_antrianID`);

--
-- Indeks untuk tabel `tb_bidang_pemeriksaan`
--
ALTER TABLE `tb_bidang_pemeriksaan`
  ADD PRIMARY KEY (`bidangID`);

--
-- Indeks untuk tabel `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`dokterID`);

--
-- Indeks untuk tabel `tb_param_pemeriksaan`
--
ALTER TABLE `tb_param_pemeriksaan`
  ADD PRIMARY KEY (`paramID`),
  ADD KEY `bidang_ID` (`bidang_ID`),
  ADD KEY `satuan_ID` (`satuan_ID`);

--
-- Indeks untuk tabel `tb_param_satuan`
--
ALTER TABLE `tb_param_satuan`
  ADD PRIMARY KEY (`satuanID`);

--
-- Indeks untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`pasienID`);

--
-- Indeks untuk tabel `tb_pemeriksaan`
--
ALTER TABLE `tb_pemeriksaan`
  ADD PRIMARY KEY (`pemeriksaanID`),
  ADD KEY `pemeriksaan_pasienID` (`pemeriksaan_pasienID`),
  ADD KEY `pemeriksaan_PetugasID` (`pemeriksaan_PetugasID`),
  ADD KEY `pemeriksaanDokterPJ_ID` (`pemeriksaanDokterPJ_ID`);

--
-- Indeks untuk tabel `tb_pemeriksaan_detail`
--
ALTER TABLE `tb_pemeriksaan_detail`
  ADD PRIMARY KEY (`dPemeriksaanID`),
  ADD KEY `pemeriksaan_ID` (`pemeriksaan_ID`),
  ADD KEY `pemeriksaanParameter_ID` (`pemeriksaanParameter_ID`);

--
-- Indeks untuk tabel `tb_pemeriksaan_interpretasi`
--
ALTER TABLE `tb_pemeriksaan_interpretasi`
  ADD PRIMARY KEY (`InterpretasiID`),
  ADD KEY `interpretasiPemeriksaan_ID` (`interpretasiPemeriksaan_ID`);

--
-- Indeks untuk tabel `tb_pemeriksaan_sample`
--
ALTER TABLE `tb_pemeriksaan_sample`
  ADD PRIMARY KEY (`samplePemeriksaanID`) USING BTREE,
  ADD KEY `pemeriksaanSample_ID` (`pemeriksaanSample_ID`),
  ADD KEY `sample_ID` (`sample_ID`);

--
-- Indeks untuk tabel `tb_pemeriksaan_saran`
--
ALTER TABLE `tb_pemeriksaan_saran`
  ADD PRIMARY KEY (`SaranID`) USING BTREE,
  ADD KEY `saranPemeriksaan_ID` (`saranPemeriksaan_ID`);

--
-- Indeks untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`petugasID`) USING BTREE;

--
-- Indeks untuk tabel `tb_sample`
--
ALTER TABLE `tb_sample`
  ADD PRIMARY KEY (`sampleID`);

--
-- Indeks untuk tabel `tb_status_pemeriksaan`
--
ALTER TABLE `tb_status_pemeriksaan`
  ADD PRIMARY KEY (`statusPemeriksaanID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_antrian`
--
ALTER TABLE `tb_antrian`
  MODIFY `antrianID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_antrian_detail`
--
ALTER TABLE `tb_antrian_detail`
  MODIFY `detail_antrianID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `tb_bidang_pemeriksaan`
--
ALTER TABLE `tb_bidang_pemeriksaan`
  MODIFY `bidangID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_dokter`
--
ALTER TABLE `tb_dokter`
  MODIFY `dokterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_param_pemeriksaan`
--
ALTER TABLE `tb_param_pemeriksaan`
  MODIFY `paramID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `tb_param_satuan`
--
ALTER TABLE `tb_param_satuan`
  MODIFY `satuanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  MODIFY `pasienID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_pemeriksaan`
--
ALTER TABLE `tb_pemeriksaan`
  MODIFY `pemeriksaanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT untuk tabel `tb_pemeriksaan_detail`
--
ALTER TABLE `tb_pemeriksaan_detail`
  MODIFY `dPemeriksaanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT untuk tabel `tb_pemeriksaan_interpretasi`
--
ALTER TABLE `tb_pemeriksaan_interpretasi`
  MODIFY `InterpretasiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `tb_pemeriksaan_sample`
--
ALTER TABLE `tb_pemeriksaan_sample`
  MODIFY `samplePemeriksaanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `tb_pemeriksaan_saran`
--
ALTER TABLE `tb_pemeriksaan_saran`
  MODIFY `SaranID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `petugasID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_sample`
--
ALTER TABLE `tb_sample`
  MODIFY `sampleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
