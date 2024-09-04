<?php
require 'includes/db.php';

// Ambil santri yang terdaftar
$santris = $pdo->query("SELECT * FROM santri")->fetchAll(PDO::FETCH_ASSOC);

foreach ($santris as $santri) {
    // Cek jika tagihan sudah ada untuk hari ini, jika sudah skip
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM tagihan WHERE santri_id = ? AND DATE(tanggal_jatuh_tempo) = CURDATE()");
    $stmt->execute([$santri['id']]);
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        // Simpan tagihan dengan tipe dan keterangan default
        $stmt = $pdo->prepare("INSERT INTO tagihan (santri_id, total_tagihan, tanggal_jatuh_tempo, tipe, keterangan) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $santri['id'], 
            100000, // Total tagihan default
            date('Y-m-d', strtotime('+1 month')), // Tanggal jatuh tempo satu bulan dari sekarang
            'syariah', // Tipe tagihan
            'Tagihan otomatis untuk bulan ini'
        ]);
    }
}
?>
