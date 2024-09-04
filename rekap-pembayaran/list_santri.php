<?php
require 'includes/db.php'; // Memasukkan file koneksi database
require 'includes/auth.php'; // Memasukkan file untuk autentikasi

// Cek apakah pengguna sudah login, jika belum, redirect ke halaman login
if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

// Ambil jumlah santri, tagihan, dan pembayaran dari database
$santriCount = $pdo->query("SELECT COUNT(*) FROM santri")->fetchColumn();


// Ambil data santri untuk ditampilkan di tabel
$stmt = $pdo->query("SELECT * FROM santri");
$santris = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Ambil query pencarian dari parameter GET
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Buat query SQL untuk mencari data santri
$sql = "SELECT * FROM santri";
$params = [];

if ($search !== '') {
    $sql .= " WHERE nama_santri LIKE :search OR alamat LIKE :search OR telepon LIKE :search OR email LIKE :search";
    $params[':search'] = "%$search%";
}

// Eksekusi query
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$santris = $stmt->fetchAll();




?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Santri </title>
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
    <!-- Bar Pencarian dan Tombol Tambah Santri -->
    <div class="flex items-center justify-between mb-4">
        <!-- Form Pencarian -->
        <form action="list_santri.php" method="get" class="flex-1 mr-4">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari santri..."
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"  
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </form>

        <!-- Tombol Tambah Santri -->
        <a 
            href="add_santri.php" 
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300"
        >
            Tambah Santri
        </a>
    </div>

    <!-- Tabel Santri -->
    <div class="w-full">
        <table class="min-w-full max-w-7xl overflow-auto border-separate border-spacing-0 border border-gray-200 text-sm">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300 text-left text-gray-600">
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3">Telepon</th>
                    <th class="px-4 py-3">Tanggal Lahir</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($santris as $santri): ?>
                <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 transition duration-300 ">
                    <td class="px-4 py-1"><?php echo $i++  ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($santri['nama_santri']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($santri['alamat']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($santri['telepon']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($santri['tanggal_lahir']) ?></td>
                    <td class="px-4 py-3">
                        <a href="edit_santri.php?id=<?= $santri['id'] ?>" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 transition duration-300 mb-3">Edit</a>
                        <a href="delete_santri.php?id=<?= $santri['id'] ?>" onclick="confirmDelete(event)" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition duration-300">Hapus</a>                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



        </div>
    </div>

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah aksi default dari link
            const url = event.target.href; // Ambil URL dari atribut href

            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                window.location.href = url; // Arahkan ke URL jika dikonfirmasi
            }
        }
    </script>

</body>

</html>