<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$kategoriList = getAllKategori();
$selectedKategori = isset($_GET['kategori']) ? $_GET['kategori'] : [];

if (!empty($selectedKategori)) {
    $produk = getProdukByKategori($selectedKategori);
} else {
    $produk = [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Produk - MurahAja</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h1>Kategori Produk</h1>
        <form action="search.php" method="get" class="search-bar">
            <input type="text" name="q" placeholder="Cari produk...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </header>

    <form method="get" class="category-filter">
        <h2>Filter Kategori</h2>
        <?php foreach ($kategoriList as $kategori): ?>
        <div class="category-checkbox">
            <input type="checkbox" name="kategori[]" id="kategori-<?= $kategori['id'] ?>" value="<?= $kategori['id'] ?>"
                <?= in_array($kategori['id'], $selectedKategori) ? 'checked' : '' ?>>
            <label for="kategori-<?= $kategori['id'] ?>"><?= $kategori['nama_kategori'] ?></label>
        </div>
        <?php endforeach; ?>
        <button type="submit" class="filter-button">Terapkan Filter</button>
    </form>

    <?php if (!empty($produk)): ?>
    <div class="product-grid">
        <?php foreach ($produk as $item): ?>
        <a href="produk.php?id=<?= $item['id'] ?>" class="product-card">
            <img src="assets/images/<?= explode(',', $item['gambar'])[0] ?>" alt="<?= $item['nama_produk'] ?>">
            <div class="product-info">
                <div class="product-name">
                    <?= $item['nama_produk'] ?>
                    <?php if ($item['is_rekomendasi']): ?>
                    <span class="rekomendasi-badge">🔥</span>
                    <?php endif; ?>
                </div>
                <?php if ($item['is_diskon'] && $item['harga_diskon']): ?>
                <div class="product-price">
                    <span class="product-price-original">Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                    Rp <?= number_format($item['harga_diskon'], 0, ',', '.') ?>
                </div>
                <?php else: ?>
                <div class="product-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
                <?php endif; ?>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="no-products">
        <p>Tidak ada produk yang ditemukan untuk kategori yang dipilih.</p>
    </div>
    <?php endif; ?>

    <?php include 'includes/navbar.php'; ?>
</body>
</html>