<?php
require_once 'db.php';

function getProdukRekomendasi() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM produk WHERE is_rekomendasi = TRUE LIMIT 10");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProdukDiskon() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM produk WHERE is_diskon = TRUE LIMIT 10");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProdukRandom() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM produk ORDER BY RAND() LIMIT 15");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProdukByKategori($kategori_ids) {
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($kategori_ids), '?'));
    $stmt = $pdo->prepare("SELECT p.* FROM produk p WHERE p.kategori_id IN ($placeholders)");
    $stmt->execute($kategori_ids);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProdukById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT p.*, k.nama_kategori FROM produk p JOIN kategori k ON p.kategori_id = k.id WHERE p.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function searchProduk($keyword) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM produk WHERE nama_produk LIKE ? OR deskripsi LIKE ? OR tag LIKE ?");
    $searchTerm = "%$keyword%";
    $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllKategori() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM kategori WHERE status = 'aktif'");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>