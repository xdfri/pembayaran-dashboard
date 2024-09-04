<?php
require 'includes/db.php';
require 'includes/auth.php';

// Pastikan pengguna sudah login
if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

// Debug: Cek apakah ID ada dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Debug: Tampilkan ID
    echo 'ID: ' . htmlspecialchars($id);

    // Validasi ID untuk menghindari SQL Injection
    if (!is_numeric($id)) {
        die('ID tidak valid');
    }

    // Update status tagihan menjadi Lunas
    $stmt = $pdo->prepare("UPDATE tagihan SET is_confirmed = TRUE, status = 'Lunas' WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect kembali ke halaman utama dengan pesan sukses
    header('Location: konfirmasi_tagihan.php?status=success');
    exit();
} else {
    die('ID tidak ditemukan');
}
?>
