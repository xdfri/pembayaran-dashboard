<?php
require 'includes/db.php';
require 'includes/auth.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_santri'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    $stmt = $pdo->prepare("INSERT INTO santri (nama_santri, alamat, telepon, email, tanggal_lahir) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nama, $alamat, $telepon, $email, $tanggal_lahir]);

    header('Location: list_santri.php');
    exit();
}
?>




<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Santri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Gaya untuk sidebar */
        .sidebar {
            background-color: #333;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            top: 50px;
            left: 0;
            width: 16rem;
        }

        .sidebar-link {
            color: #ddd;
        }

        .sidebar-link:hover {
            color: #fff;
        }

        .content-box {
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            background-color: #4a5568;
            color: #fff;
            height: 50px;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .logout-button {
            border: none;
            color: #fff;
        }

        .navbar-icon {
            color: #fff;
            margin-left: 1rem;
            cursor: pointer;
        }

        .navbar-icon:hover {
            color: #ddd;
        }

        .sidebar-profile-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .footer-sidebar {
            margin-top: auto;
            padding: 1rem;
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

    <div class="flex flex-1 mt-12">
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
            <h1 class="text-2xl font-semibold mb-6 text-center">Tambah Santri</h1>
            <hr class="py-4">

            <!-- Konten Utama-->
            <div class="container max-w-2xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
                <form action="add_santri.php" method="post" class="flex flex-wrap -mx-3 mb-6">
                    <!-- Kolom Kiri -->
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <div>
                            <label for="nama_santri" class="block text-gray-700 text-sm font-medium mb-2">Nama</label>
                            <input type="text" id="nama_santri" name="nama_santri" class="border border-gray-300 rounded-lg px-4 py-2 w-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="alamat" class="block text-gray-700 text-sm font-medium mb-2">Alamat</label>
                            <textarea id="alamat" name="alamat" class="border border-gray-300 rounded-lg px-4 py-2 w-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                    </div>
                    <!-- Kolom Kanan -->
                    <div class="w-full md:w-1/2 px-3">
                        <div>
                            <label for="telepon" class="block text-gray-700 text-sm font-medium mb-2">Telepon</label>
                            <input type="text" id="telepon" name="telepon" class="border border-gray-300 rounded-lg px-4 py-2 w-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                            <input type="email" id="email" name="email" class="border border-gray-300 rounded-lg px-4 py-2 w-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-gray-700 text-sm font-medium mb-2">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="border border-gray-300 rounded-lg px-4 py-2 w-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="w-full flex justify-center mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
