<?php
require 'includes/db.php';
require 'includes/auth.php';

// Pastikan pengguna sudah login
if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

// Menghapus semua tagihan jika tombol "Hapus Semua Tagihan" diklik
if (isset($_POST['hapus_semua'])) {
    try {
        $pdo->beginTransaction();
        $pdo->exec("DELETE FROM tagihan");
        $pdo->commit();
        $message = "Semua tagihan berhasil dihapus.";
        header('Location: list_tagihan.php'); // Tambahkan 'Location:' di sini
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Terjadi kesalahan: " . $e->getMessage();
    }
}

// Menambahkan tagihan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tagih_semua'])) {
        // Tagih semua santri
        $total_tagihan = $_POST['total_tagihan'];
        $tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'];
        $tipe = $_POST['tipe'];
        $keterangan = 'Tagihan massal untuk bulan ' . date('F Y'); // Keterangan default
        $bulan = $_POST['bulan']; // Ambil bulan dari input

        // Validasi input
        if ($total_tagihan <= 0) {
            $error = "Total tagihan harus lebih besar dari 0.";
        } else {
            // Ambil semua santri
            $santris = $pdo->query("SELECT id FROM santri")->fetchAll(PDO::FETCH_COLUMN);

            // Mulai transaksi
            $pdo->beginTransaction();

            try {
                foreach ($santris as $santri_id) {
                    // Buat tagihan untuk setiap santri
                    $stmt = $pdo->prepare("INSERT INTO tagihan (santri_id, total_tagihan, tanggal_jatuh_tempo, tipe, keterangan, bulan) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$santri_id, $total_tagihan, $tanggal_jatuh_tempo, $tipe, $keterangan, $bulan]);
                }

                // Commit transaksi
                $pdo->commit();

                // Redirect ke halaman list tagihan setelah berhasil
                header('Location: list_tagihan.php');
                exit();
            } catch (Exception $e) {
                // Rollback transaksi jika ada error
                $pdo->rollBack();
                $error = "Terjadi kesalahan: " . $e->getMessage();
            }
        }
    } else {
        // Tambah tagihan untuk satu santri
        $santri_id = $_POST['santri_id'];
        $total_tagihan = $_POST['total_tagihan'];
        $tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'];
        $tipe = $_POST['tipe'];
        $keterangan = $_POST['keterangan'];
        $bulan = $_POST['bulan']; // Tambahkan bulan ke variabel POST

        // Validasi input
        if ($total_tagihan <= 0) {
            $error = "Total tagihan harus lebih besar dari 0.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO tagihan (santri_id, total_tagihan, tanggal_jatuh_tempo, tipe, keterangan, bulan) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$santri_id, $total_tagihan, $tanggal_jatuh_tempo, $tipe, $keterangan, $bulan]);

            // Redirect ke halaman list tagihan setelah berhasil
            header('Location: list_tagihan.php');
            exit();
        }
    }
}

// Ambil data santri untuk dropdown
$santris = $pdo->query("SELECT * FROM santri")->fetchAll(PDO::FETCH_ASSOC);

// Array bulan untuk dropdown
$bulanOptions = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buat Tagihan</title>
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
            <a href="logout.php" class="logout-button px-4 py-2 rounded items-center ml-4 hidden md:flex"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
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
                    <li><a href="create_tagihan.php" class="sidebar-link block py-2 px-3 rounded hover:bg-gray-700"><i class="fas fa-plus-circle"></i> Buat Tagihan</a></li>
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
            <h1 class="text-2xl font-semibold mb-6">Buat Tagihan</h1>

            <!-- Kartu Informasi -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6 w-full">
                <div class="container mx-auto mt-5">
                    <!-- Tampilkan pesan error jika ada -->
                    <?php if (isset($error)): ?>
                        <div class="bg-red-500 text-white p-4 rounded mb-4"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <!-- Tampilkan pesan sukses jika ada -->
                    <?php if (isset($message)): ?>
                        <div class="bg-green-500 text-white p-4 rounded mb-4"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>

                    <form action="add_tagihan.php" method="post" class="space-y-4">
                        <!-- Form untuk tagih semua santri -->
                        <div>
                            <label class="block">Total Tagihan</label>
                            <input type="text" name="total_tagihan" class="border px-4 py-2 w-full" required step="0.01">
                        </div>
                        <div>
                            <label class="block">Tanggal Jatuh Tempo</label>
                            <input type="date" name="tanggal_jatuh_tempo" class="border px-4 py-2 w-full" required>
                        </div>
                        <div>
                            <label class="block">Tipe</label>
                            <select name="tipe" class="border px-4 py-2 w-full" required>
                                <option value="syariah">Syariah</option>
                                <option value="daftar ulang">Daftar Ulang</option>
                            </select>
                        </div>
                        <div>
                            <label class="block">Bulan</label>
                            <select name="bulan" class="border px-4 py-2 w-full" required>
                                <option value="">Pilih Bulan</option>
                                <?php foreach ($bulanOptions as $key => $value): ?>
                                    <option value="<?= $key ?>"><?= htmlspecialchars($value) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block">Keterangan</label>
                            <textarea name="keterangan" class="border px-4 py-2 w-full"></textarea>
                        </div>
                        <button type="submit" name="tagih_semua" class="bg-blue-500 text-white px-4 py-2 rounded">Tagih Semua Santri</button>
                    </form>

                    <!-- Form untuk hapus semua tagihan -->
                    <div class="mt-4">
                        <form action="add_tagihan.php" method="post">
                            <button type="submit" name="hapus_semua" class="bg-gray-500 text-white px-4 py-2 rounded">Hapus Semua Tagihan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
