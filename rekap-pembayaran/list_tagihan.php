<?php
require 'includes/db.php';
require 'includes/auth.php';

// Pastikan pengguna sudah login
if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

// Ambil daftar tagihan yang belum lunas dan belum dikonfirmasi
$stmtBelumLunas = $pdo->query("SELECT t.id, s.nama_santri, s.telepon, t.total_tagihan, t.tanggal_jatuh_tempo, t.tipe, t.bulan, t.status
                               FROM tagihan t
                               JOIN santri s ON t.santri_id = s.id
                               WHERE t.is_confirmed = FALSE");

// Ambil daftar tagihan yang sudah lunas
$stmtLunas = $pdo->query("SELECT t.id, s.nama_santri, s.telepon, t.total_tagihan, t.tanggal_jatuh_tempo, t.tipe, t.bulan, t.status
                          FROM tagihan t
                          JOIN santri s ON t.santri_id = s.id
                          WHERE t.is_confirmed = TRUE");

$tagihansBelumLunas = $stmtBelumLunas->fetchAll(PDO::FETCH_ASSOC);
$tagihansLunas = $stmtLunas->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Santri</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Mengimpor TailwindCSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Mengimpor Font Awesome -->
    <style>
        /* Gaya untuk sidebar */
        .sidebar {
            background-color: #333;
            /* Warna abu-abu gelap */
            display: flex;
            flex-direction: column;
            height: 100vh;
            /* Tinggi penuh */
            position: fixed;
            top: 50px;
            /* Sesuaikan dengan tinggi navbar */
            left: 0;
            width: 16rem;
            /* Lebar sidebar */
        }

        .sidebar-link {
            color: #ddd;
            /* Warna abu-abu terang */
        }

        .sidebar-link:hover {
            color: #fff;
            /* Warna putih saat hover */
        }

        .content-box {
            background-color: #fff;
            /* Latar belakang putih */
            border: 1px solid #ddd;
            /* Border abu-abu terang */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Bayangan halus */
        }

        .navbar {
            background-color: #4a5568;
            /* Warna abu-abu gelap */
            color: #fff;
            /* Teks putih */
            height: 50px;
            /* Tinggi navbar */
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .logout-button {
            border: none;
            /* Menghilangkan warna latar belakang */
            color: #fff;
            /* Teks putih */
        }

        .navbar-icon {
            color: #fff;
            margin-left: 1rem;
            cursor: pointer;
        }

        .navbar-icon:hover {
            color: #ddd;
            /* Warna abu-abu terang saat hover */
        }

        .sidebar-profile-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .footer-sidebar {
            margin-top: auto;
            /* Mengatur footer agar berada di bawah */
            padding: 1rem;
        }
        
        /* Modern Table Styling */
        .table-container {
            overflow-x: auto; /* Allow horizontal scroll if table is too wide */
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
        }

        .modern-table th,
        .modern-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0; /* Light gray border */
        }

        .modern-table th {
            background-color: #2d3748; /* Dark gray background for header */
            color: #edf2f7; /* Light gray text */
            font-weight: bold;
        }

        .modern-table tr:hover {
            background-color: #f7fafc; /* Light gray on hover */
        }

        .modern-table td {
            color: #2d3748; /* Dark gray text */
        }

        .modern-table thead th {
            position: sticky;
            top: 0;
            z-index: 1; /* Keep header sticky */
        }
    </style>
</head>

<body class="flex flex-col h-screen">
    <!-- Navbar -->
    <div class="navbar w-full p-2 fixed top-0 left-0 flex items-center justify-between z-10">
        <div class="text-lg font-semibold">APP - PEMBAYARAN PCN</div>
        <div class="flex items-center">
            <!-- Ikon Notifikasi -->
            <i class="fas fa-bell navbar-icon"></i>
            <!-- Ikon Pengaturan -->
            <i class="fas fa-cog navbar-icon"></i>
            <!-- Gambar Profil -->
            <img src="img/image.png" alt="Gambar Profil" class="profile-img ml-4">
            <!-- Tombol Logout (Tampil di layar besar) -->
            <a href="logout.php" class="logout-button px-4 py-2 rounded  items-center ml-4 hidden md:flex"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
        </div>
    </div>

    <div class="flex flex-1 mt-12"> <!-- Menyesuaikan margin-top untuk navbar yang lebih rendah -->
        <!-- Sidebar -->
        <div class="sidebar p-4">
            <!-- Bagian Profil -->
            <div class="flex items-center text-white mb-8">
                <img src="img/image.png" alt="Gambar Profil" class="sidebar-profile-img mr-4">
                <div>
                    <div class="text-lg font-semibold mb-2">Admin</div>
                    <p class="text-sm mb-2">admin@cemerlang.com</p>
                    <a href="profile.php" class="text-teal-300 underline text-sm">Lihat Profil</a>
                </div>
            </div>
            <!-- Tautan Sidebar -->
            <nav>
                <ul>
                    <li><a href="index.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="list_santri.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-users"></i> Daftar Santri</a></li>
                    <li><a href="list_tagihan.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-file-invoice"></i> Daftar Tagihan</a></li>
                    <li><a href="list_pembayaran.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-money-bill-wave"></i> Daftar Pembayaran</a></li>
                    <li><a href="add_santri.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-user-plus"></i> Tambah Santri</a></li>
                    <li><a href="add_tagihan.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-plus-circle"></i> Buat Tagihan</a></li>
                    <li><a href="konfirmasi_tagihan.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-check-circle"></i> Konfirmasi</a></li>

                </ul>
            </nav>
            <!-- Footer dengan Ikon Pengaturan -->
            <div class="footer-sidebar flex items-center justify-between text-white">
                <!-- Ikon Pengaturan -->
                <i class="fas fa-cog navbar-icon"></i>
                <!-- Tombol Logout (Tampil di layar kecil) -->
                <a href="logout.php" class="logout-button px-4 py-2 rounded flex items-center md:hidden"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
            </div>
        </div>

        <div class="ml-64 flex-1 p-6">
            <!-- Tombol Logout pada layar kecil -->
            <div class="md:hidden flex justify-end mb-4">
                <a href="logout.php" class="logout-button px-4 py-2 rounded flex items-center"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
            </div>

            <!-- Konten Halaman -->
            <h1 class="text-2xl font-semibold mb-6">Daftar Santri</h1>

            <!-- Kartu Informasi -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6 w-full">
                <!-- Add Tagihan Button -->
                <a href="add_tagihan.php" class="bg-teal-600 text-white px-4 py-2 rounded flex items-center mb-6 hover:bg-teal-700 transition-colors">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah Tagihan
                </a>
                
                <h1 class="text-xl font-bold mb-4">Daftar Tagihan</h1>
                
                <!-- Tabel Tagihan Belum Lunas -->
                <h2 class="text-lg font-semibold mb-4">Tagihan Belum Lunas</h2>
                <?php if (empty($tagihansBelumLunas)): ?>
                    <p class="text-red-500 mb-4">Tidak ada tagihan yang belum lunas.</p>
                <?php else: ?>
                    <div class="table-container">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nama Santri</th>
                                    <th>ID</th>
                                    <th>Nomor HP</th>
                                    <th>Total Tagihan</th>
                                    <th>Tipe</th>
                                    <th>Bulan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tagihansBelumLunas as $index => $tagihan): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($tagihan['nama_santri'] ?? 'Data Tidak Tersedia') ?></td>
                                        <td><?= htmlspecialchars($tagihan['id'] ?? 'Data Tidak Tersedia') ?></td>
                                        <td><?= htmlspecialchars($tagihan['telepon'] ?? 'Data Tidak Tersedia') ?></td>
                                        <td><?= htmlspecialchars($tagihan['total_tagihan']) ?></td>
                                        <td><?= htmlspecialchars($tagihan['tipe'] ?? 'Data Tidak Tersedia') ?></td>
                                        <td><?= htmlspecialchars($tagihan['bulan'] ?? 'Data Tidak Tersedia') ?></td>
                                        <td><?= htmlspecialchars($tagihan['status'] ?? 'Belum Lunas') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                
                <!-- Tabel Tagihan Lunas -->
                <h2 class="text-lg font-semibold mb-4">Tagihan Lunas</h2>
                <?php if (empty($tagihansLunas)): ?>
                    <p class="text-red-500">Tidak ada tagihan yang lunas.</p>
                <?php else: ?>
                    <div class="table-container">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nama Santri</th>
                                    <th>ID</th>
                                    <th>Nomor HP</th>
                                    <th>Total Tagihan</th>
                                    <th>Tipe</th>
                                    <th>Bulan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tagihansLunas as $index => $tagihan): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($tagihan['nama_santri'] ?? 'Data Tidak Tersedia') ?></td>
                                        <td><?= htmlspecialchars($tagihan['id'] ?? 'Data Tidak Tersedia') ?></td>
                                        <td><?= htmlspecialchars($tagihan['telepon'] ?? 'Data Tidak Tersedia') ?></td>
                                        <td><?= htmlspecialchars($tagihan['total_tagihan']) ?></td>
                                        <td><?= htmlspecialchars($tagihan['tipe'] ?? 'Data Tidak Tersedia') ?></td>
                                        <td><?= htmlspecialchars($tagihan['bulan'] ?? 'Data Tidak Tersedia') ?></td>
                                        <td><?= htmlspecialchars($tagihan['status'] ?? 'Lunas') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
