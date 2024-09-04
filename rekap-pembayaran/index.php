<?php
require 'includes/db.php';
require 'includes/auth.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

// Fetch summary data
$santriCount = $pdo->query("SELECT COUNT(*) FROM santri")->fetchColumn();
$totalTagihan = $pdo->query("SELECT COUNT(total_tagihan) FROM tagihan")->fetchColumn();

// Fetch payment status data
$paymentLunasCount = $pdo->query("SELECT COUNT(*) FROM tagihan WHERE status = 'lunas'")->fetchColumn();
$paymentBelumLunasCount = $pdo->query("SELECT COUNT(*) FROM tagihan WHERE status = 'belum lunas'")->fetchColumn();

// Get current date and time
date_default_timezone_set('Asia/Jakarta'); // Set the timezone to Jakarta
$currentDateTime = date('l, j F Y H:i'); // Format: Day, Date Month Year Hours:Minutes
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .sidebar {
            background-color: #333; /* Dark Gray */
            display: flex;
            flex-direction: column;
            height: 100vh; /* Full height */
            position: fixed;
            top: 50px; /* Adjusted top to match the navbar height */
            left: 0;
            width: 16rem; /* Sidebar width */
        }
        .sidebar-link {
            color: #ddd; /* Light Gray */
        }
        .sidebar-link:hover {
            color: #fff; /* White on hover */
        }
        .content-box {
            background-color: #fff; /* White Background */
            border: 1px solid #ddd; /* Light Gray Border */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle Shadow */
        }
        .navbar {
            background-color: #4a5568; /* Dark Gray */
            color: #fff; /* White text */
            height: 50px; /* Reduced height */
        }
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .logout-button {
            border: none; /* Remove background color */
            color: #fff; /* White text */
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
            margin-top: auto; /* Pushes footer to the bottom */
            padding: 1rem;
        }
        .date-time {
            font-size: 0.875rem;
            color: #666;
        }
    </style>
</head>
<body class="flex flex-col h-screen">
    <!-- Navbar -->
    <div class="navbar w-full p-2 fixed top-0 left-0 flex items-center justify-between z-10">
        <div class="text-lg font-semibold">APP - PEMBAYARAN PCN</div>
        <div class="flex items-center">
            <!-- Notification Icon -->
            <i class="fas fa-bell navbar-icon"></i>
            <!-- Settings Icon -->
            <i class="fas fa-cog navbar-icon"></i>
            <!-- Profile Image -->
            <img src="img/image.png" alt="Profile Image" class="profile-img ml-4">
            <!-- Logout Button (Visible on Larger Screens) -->
            <a href="logout.php" class="logout-button px-4 py-2 rounded items-center ml-4 hidden md:flex"><i class="fas fa-sign-out-alt mr-2"></i> LogOut</a>
        </div>
    </div>
    
    <div class="flex flex-1 mt-12"> <!-- Adjusted margin-top for the reduced navbar height -->
        <!-- Sidebar -->
        <div class="sidebar p-4">
            <!-- Profile Section -->
            <div class="flex items-center text-white mb-8">
                <img src="img/image.png" alt="Profile Image" class="sidebar-profile-img mr-4">
                <div>
                    <div class="text-lg font-semibold mb-2">Admin</div>
                    <p class="text-sm mb-2">admin@cemerlang.com</p>
                    <a href="profile.php" class="text-teal-300 underline text-sm">Lihat Profil</a>
                </div>
            </div>
            <!-- Sidebar Links -->
            <nav>
                <ul>
                    <li><a href="#" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="list_santri.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-users"></i> Daftar Santri</a></li>
                    <li><a href="list_tagihan.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-file-invoice"></i> Daftar Tagihan</a></li>
                    <li><a href="eror-404.html" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-money-bill-wave"></i> Daftar Pembayaran</a></li>
                    <li><a href="add_santri.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-user-plus"></i> Tambah Santri</a></li>
                    <li><a href="add_tagihan.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-plus-circle"></i> Buat Tagihan</a></li>
                    <li><a href="konfirmasi_tagihan.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-check-circle"></i> Konfirmasi</a></li>
                </ul>
            </nav>
            <!-- Footer with Settings Icon -->
            <div class="footer-sidebar flex items-center justify-between text-white">
                <!-- Settings Icon -->
                <i class="fas fa-cog navbar-icon"></i>
                <!-- Logout Button (Visible on Smaller Screens) -->
                <a href="logout.php" class="logout-button px-4 py-2 rounded flex items-center md:hidden"><i class="fas fa-sign-out-alt mr-2"></i> LogOut</a>
            </div>
        </div>
        
        <div class="ml-64 flex-1 p-6">
            <!-- Logout Button on Smaller Screens -->
            <div class="md:hidden flex justify-end mb-4">
                <a href="logout.php" class="logout-button px-4 py-2 rounded flex items-center"><i class="fas fa-sign-out-alt mr-2"></i> LogOut</a>
            </div>
            
            <!-- Page Content -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Box for Santri Count -->
                <div class="content-box p-6 rounded-lg">
                    <h2 class="text-lg font-semibold mb-2 flex items-center"><i class="fas fa-users mr-2"></i> Jumlah Santri</h2>
                    <p class="text-2xl font-bold"><?= htmlspecialchars($santriCount) ?></p>
                    <a href="list_santri.php" class="text-teal-600 underline mt-2 block">Lihat Daftar Santri</a>
                </div>

                <!-- Box for Total Tagihan -->
                <div class="content-box p-6 rounded-lg col-span-2 md:col-span-2">
                    <h2 class="text-lg font-semibold mb-2 flex items-center"><i class="fas fa-file-invoice mr-2"></i> Total Tagihan</h2>
                    <p class="text-2xl font-bold"><?= htmlspecialchars($totalTagihan); ?></p>
                    <a href="list_tagihan.php" class="text-teal-600 underline mt-2 block">Lihat Daftar Tagihan</a>
                </div>

                <!-- Box for Pembayaran Lunas -->
                <div class="content-box p-6 rounded-lg">
                    <h2 class="text-lg font-semibold mb-2 flex items-center"><i class="fas fa-check-circle mr-2"></i> Lunas</h2>
                    <p class="text-2xl font-bold"><?= htmlspecialchars($paymentLunasCount) ?></p>
                </div>

                <!-- Box for Pembayaran Belum Lunas -->
                <div class="content-box p-6 rounded-lg">
                    <h2 class="text-lg font-semibold mb-2 flex items-center"><i class="fas fa-times-circle mr-2"></i> Belum Lunas</h2>
                    <p class="text-2xl font-bold"><?= htmlspecialchars($paymentBelumLunasCount) ?></p>
                </div>
            </div>

            <!-- Buttons to manage data -->
            <div class="mt-6 flex flex-wrap gap-4">
                <a href="add_santri.php" class="bg-teal-600 text-white px-4 py-2 rounded flex items-center hover:bg-teal-700 transition-colors"><i class="fas fa-user-plus mr-2"></i> Tambah Santri</a>
                <a href="add_tagihan.php" class="bg-teal-600 text-white px-4 py-2 rounded flex items-center hover:bg-teal-700 transition-colors"><i class="fas fa-plus-circle mr-2"></i> Buat Tagihan</a>
                <a href="list_pembayaran.php" class="bg-teal-600 text-white px-4 py-2 rounded flex items-center hover:bg-teal-700 transition-colors"><i class="fas fa-money-bill-wave mr-2"></i> Kelola Pembayaran</a>
            </div>
        </div>
    </div>
</body>
</html>
