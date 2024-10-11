<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian</title>
</head>
<body>
    <h4>Hasil Pencarian untuk "<?php echo $query; ?>"</h4>

    <?php if (!empty($results)): ?>
        <ul>
            <?php foreach ($results as $product): ?>
                <li><?php echo $product->name; ?> - Rp. <?php echo number_format($product->price, 0, ',', '.'); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Tidak ada hasil ditemukan.</p>
    <?php endif; ?>
</body>
</html>
