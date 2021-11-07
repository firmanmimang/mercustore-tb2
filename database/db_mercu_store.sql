-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jun 2021 pada 20.39
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mercu_store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `berat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `id_kategori`, `harga`, `deskripsi`, `gambar`, `berat`) VALUES
(11, 'MSI GF63 Thin 10SCSR ', 11, 16499000, 'MSI GF63 10SCSR-9S7-16R412-677ID BLACK\r\n\r\nSpesifikasi:\r\n- Processor Onboard : Intel® Core™ i7-10750H Processor (12M Cache, up to 5.00 GHz)\r\n- Memori Standar : 8 GB DDR4 2666Mhz\r\n- Tipe Grafis : NVIDIA GeForce® GTX 1650Ti Max Q, 4GB GDDR6\r\n- Ukuran Layar : 15.6inch FHD (1920*1080), IPS-Level 144Hz Thin Bezel\r\n- Storage : 512GB NVMe SSD\r\n- Chipset : Intel HM470\r\n- Keyboard : Single Red Keyboard\r\n- Kamera : HD type (30fps@720p)\r\n- Wireless Network : Intel Wi-Fi 6 AX201(2*2 ax) + BlueTooth 5.1\r\n\r\n- Interfaces :\r\n1x RJ45\r\n1x (4K @ 30Hz) HDMI\r\n1x Type-C USB3.2 Gen1\r\n3x Type-A USB3.2 Gen1\r\n1x M.2 SSD Combo slot (NVMe PCIe Gen3 / SATA)\r\n1x 2.5&quot; SATA HDD\r\n\r\n- Sistem Operasi : Windows 10 Home\r\n- Batteray : 3-Cell\r\n- Dimension : 359 x 254 x 21.7 mm\r\n- Berat : 1,86Kg\r\n- Adapter : 120W adapter\r\n- FREE AIR GAMING BACKPACK\r\n- Garansi Resmi MSI INDONESIA 2 TAHUN\r\n\r\nMereka yang memiliki kemampuan beradaptasi terhadap perubahan adalah yang bertahan dan\r\nberkembang. Tentukan Dragon Spirit-mu dan berevolusi dengan Laptop Gaming MSI terbaru yang\r\ndilengkapi dengan prosesor Intel® Core™ i7 Generasi ke-10 (Comet Lake H) &amp; kartu grafis GeForce® GTX terbaru yang dirancang untuk para gamer. Mari menuju ke Generasi Baru.\r\n', 'msi1.jpg', 6000),
(12, 'ASUS X441', 11, 2850000, 'Kondisi: Baru\r\nBerat: 4.000 Gram\r\nKategori: Laptop Consumer\r\nEtalase: Laptop &amp; Aksesoris\r\nRam 4gb\r\nHDD 500gb\r\nLayar 14&quot;\r\nDVD RW\r\nWAPCAM\r\nHDMI\r\nLine\r\nWiFi\r\nEx Display Garansi 1 Tahun Distributor\r\n\r\nKelengkapan :\r\n- Dus\r\n- Charger\r\n- Tas / Mouse ( selama stock masih ada )\r\n- Buku Garans\r\n\r\nBudayakan membaca sebelum membeli.\r\nUntuk unit yang kita jual semuanya ex display kondisi fisik like new 95-99%\r\nMembeli berarti setuju.\r\nTidak bisa cancel order.\r\nJika ada kendala bisa hubungi admin by live chat.\r\nTidak perlu panik.\r\nGARANSI tukar unit kita berikan selama 1 minggu.\r\nDi atas 1 minggu kita bantu servis.\r\nDan pastinya kita akan mencarikan solusi terbaik untuk customer.\r\nCUSTOMER FIRST , SERVICE FIRST.\r\nUTAMAKAN CUSTOMER,UTAMAKAN PELAYANAN.', 'asus1.jpg', 4000),
(13, 'ASUS TUF GAMING F15 FX506LH', 11, 12540000, 'ASUS TUF GAMING F15 FX506LH TERDIRI DARI 2 WARNA :\r\nFX506LH-I565B6T : FORTRESS GRAY\r\nFX506LH-I565B6B : BONFIRE BLACK\r\n\r\nSpek:\r\n- Processor 10th Generation Intel® Core™ i5-10300H Processor (2.50 GHz, up to 4.50 GHz with Turbo Boost, 4 Cores, 8 Thread)\r\n- Operating System Windows 10 Home\r\n- Memory 8 GB DDR4 3200MHZ ( UPTO 32GB )\r\n- Storage 512GB M.2 NVMe™ PCIe® 3.0 SSD\r\n- Graphic nVidia GTX1650 with 4GB DDR6, VRAM\r\n- Display 15.6inch (16:9) FHD (1920x1080) 144Hz Anti-Glare IPS-level Panel 45% NTSC\r\n- Keyboard Chiclet keyboard with isolated numpad key [ Backlight RGB ]\r\n- WebCam HD camera (Front)\r\nNetworking :\r\n-Wi-Fi : Integrated Wi-Fi 6 (802.11 ax (2x2))\r\n-Bluetooth : Bluetooth® 5.0 The Version of BT may change as OS upgrades\r\nInterface :\r\n1 x COMBO audio jack\r\n2 x Type-A USB 3.2 (Gen 1)\r\n1 x Type-C USB 3.2 (Gen 2) with display supportDP1.4\r\n1 x Type-A USB2.0\r\n1 x RJ45 LAN jack for LAN insert\r\n1 x HDMI, HDMI support 2.0b\r\n1 x AC adapter plug\r\nAudio :\r\n-Built-in 2 W Stereo Speakers with Array Microphone\r\n-DTS:X® Ultra\r\n-Supports Windows 10 Cortana with Voice\r\nBATTERY: 48 Wh lithium-polymer battery Battery\r\n- WINDOWS 10 ORIGINAL\r\n- FREE ASUS TUF BAG\r\n\r\nGARANSI ASUS INDONESIA 2 TAHUN RESMI\r\n\r\nKELENGKAPAN :\r\n- BNIB,\r\n- Charger,\r\n- Kartu Garansi,\r\n- Buku petunjuk,\r\n- Tas ASUS', 'asus2.jpg', 5000),
(14, 'Lenovo Legion', 11, 13938000, 'PRODUK INI SUDAH TERMASUK\r\n-Lenovo Legion Backpack\r\n\r\n\r\nSPEK UNIT\r\n- CPU :Intel Core i7-10750H Processor\r\n- GPU : NVIDIA GeForce GTX 1650 Ti 4GB GDDR6\r\n- Display : 15.6&quot; FHD (1920x1080) IPS 300nits Anti-glare, 120Hz, 100% sRGB, Dolby Vision\r\n- RAM : 8GB\r\n- Storage : 512GB NVMe SSD\r\n- OS : Win 10 Home\r\n\r\ngaransi distributor 1 tahun bantu claim\r\ngaransi tukar baru 3x24 jam\r\n', 'lenovo1.jpg', 7000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gambar`
--

CREATE TABLE `tbl_gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_gambar`
--

INSERT INTO `tbl_gambar` (`id_gambar`, `id_barang`, `ket`, `gambar`) VALUES
(6, 11, 'ms1a', 'msi1a.jpg'),
(7, 11, 'msi1b', 'msi1b.jpg'),
(8, 11, 'msi1c', 'msi1c.jpg'),
(9, 11, 'msi1d', 'msi1d.jpg'),
(10, 12, 'asus1a', 'asus1a.jpg'),
(11, 12, 'asus1b', 'asus1b.jpg'),
(12, 12, 'asus1c', 'asus1c.jpg'),
(35, 13, 'asus2a', 'asus2a.jpg'),
(36, 13, 'asus2b', 'asus2b.jpg'),
(37, 13, 'asus2c', 'asus2c.jpg'),
(38, 13, 'asus2d', 'asus2d.jpg'),
(39, 14, 'lenovo1a', 'lenovo1a.jpg'),
(40, 14, 'lenovo1b', 'lenovo1b.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(4, 'Aksesoris'),
(8, 'Handphone'),
(11, 'Laptop');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `username_pelanggan` varchar(25) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan_token`
--

CREATE TABLE `tbl_pelanggan_token` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `token` varchar(256) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rekening`
--

CREATE TABLE `tbl_rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_rekening`
--

INSERT INTO `tbl_rekening` (`id_rekening`, `nama_bank`, `no_rek`, `atas_nama`) VALUES
(1, 'BRI', 'nomorbridummy1234', 'Mercu Store'),
(2, 'Mandiri', 'nomormandiri1234', 'Mercu Store');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rinci_transaksi`
--

CREATE TABLE `tbl_rinci_transaksi` (
  `no_order` varchar(25) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(1) NOT NULL,
  `nama_toko` varchar(255) DEFAULT NULL,
  `lokasi` varchar(55) DEFAULT NULL,
  `id_kota` int(5) NOT NULL,
  `alamat_toko` text DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `nama_toko`, `lokasi`, `id_kota`, `alamat_toko`, `no_telepon`) VALUES
(1, 'Mercu Store', 'Jakarta Barat', 151, 'Jalan Meruya Selatan, Meruya, Jakarta Selatan, DKI Jakarta', '08782407341');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `no_order` varchar(25) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `tgl_order` int(11) DEFAULT NULL,
  `nama_penerima` varchar(25) DEFAULT NULL,
  `tlp_penerima` varchar(15) DEFAULT NULL,
  `provinsi` varchar(25) DEFAULT NULL,
  `kota` varchar(25) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kode_pos` varchar(8) DEFAULT NULL,
  `ekspedisi` varchar(255) DEFAULT NULL,
  `paket` varchar(255) DEFAULT NULL,
  `estimasi` varchar(255) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `status_bayar` int(1) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `status_order` int(1) DEFAULT NULL,
  `no_resi` varchar(25) DEFAULT NULL,
  `tgl_kirim` int(11) DEFAULT NULL,
  `tgl_terima` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(25) DEFAULT NULL,
  `email_user` varchar(255) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level_user` int(1) DEFAULT NULL,
  `foto_user` text DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `email_user`, `username`, `password`, `level_user`, `foto_user`, `is_active`, `date_created`) VALUES
(1, 'Admin', 'athenaciki@gmail.com', 'admin', '$2y$10$bz5c1lKK3looQ9HuQYQCOedodPObtu5BWDZ4ffnTSfay0HozCYpP.', 1, 'mercustorelogopas.png', 1, 1622054715);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_token`
--

CREATE TABLE `tbl_user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `token` varchar(256) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user_token`
--

INSERT INTO `tbl_user_token` (`id`, `email`, `token`, `date_created`) VALUES
(18, 'athenaciki@gmail.com', 'eMKiBrip79fFaKFMMEL5gYzFACHkQpUGYTLCnVQbrgM=', 1623004647);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `tbl_gambar`
--
ALTER TABLE `tbl_gambar`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tbl_pelanggan_token`
--
ALTER TABLE `tbl_pelanggan_token`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_rekening`
--
ALTER TABLE `tbl_rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indeks untuk tabel `tbl_rinci_transaksi`
--
ALTER TABLE `tbl_rinci_transaksi`
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `no_order` (`no_order`);

--
-- Indeks untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`no_order`),
  ADD UNIQUE KEY `no_order` (`no_order`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tbl_user_token`
--
ALTER TABLE `tbl_user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_gambar`
--
ALTER TABLE `tbl_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_pelanggan_token`
--
ALTER TABLE `tbl_pelanggan_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_rekening`
--
ALTER TABLE `tbl_rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_token`
--
ALTER TABLE `tbl_user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD CONSTRAINT `tbl_barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `tbl_gambar`
--
ALTER TABLE `tbl_gambar`
  ADD CONSTRAINT `tbl_gambar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tbl_barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `tbl_rinci_transaksi`
--
ALTER TABLE `tbl_rinci_transaksi`
  ADD CONSTRAINT `tbl_rinci_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tbl_barang` (`id_barang`),
  ADD CONSTRAINT `tbl_rinci_transaksi_ibfk_2` FOREIGN KEY (`no_order`) REFERENCES `tbl_transaksi` (`no_order`);

--
-- Ketidakleluasaan untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD CONSTRAINT `tbl_transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `tbl_pelanggan` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
