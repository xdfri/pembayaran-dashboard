<?php

function fetch_bills() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM tagihan ORDER BY tanggal_jatuh_tempo DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetch_payments($pdo) {
    $stmt = $pdo->query("SELECT pembayaran.id, santri.nama_santri, pembayaran.jumlah, pembayaran.tanggal_pembayaran, pembayaran.tipe 
                          FROM pembayaran
                          JOIN tagihan ON pembayaran.tagihan_id = tagihan.id
                          JOIN santri ON tagihan.santri_id = santri.id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetch_payment($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM pembayaran WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
