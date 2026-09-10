<?php
$escape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
$old = $old ?? [];
$errors = $errors ?? [];
$editing = $editing ?? null;
$editingId = $editing_id ?? ($editing['id'] ?? null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/kinich.css') ?>">
</head>
<body>
<main>
    <h1>Products</h1>
    <p>
        <a href="<?= site_url('products/create') ?>">Add Product</a>
        <a href="<?= site_url('products/logout') ?>">Logout</a>
    </p>

    <section class="table-wrap">
        <table>
            <thead>
                <tr><th>ID</th><th>Product</th><th>Description</th><th>Price</th><th>Quantity</th><th>Created</th><th>Actions</th></tr>
            </thead>
            <tbody>
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <?php $productId = (int) ($product['id'] ?? 0); ?>
                    <tr>
                        <td><?= $productId ?></td>
                        <td><?= $escape($product['product_name'] ?? '') ?></td>
                        <td><?= $escape($product['description'] ?? '') ?></td>
                        <td><?= number_format((float) ($product['price'] ?? 0), 2) ?></td>
                        <td><?= (int) ($product['quantity'] ?? 0) ?></td>
                        <td><?= $escape($product['created_at'] ?? '') ?></td>
                        <td class="actions">
                            <a href="<?= site_url('products/edit/' . $productId) ?>">Edit</a>
                            <form method="POST" action="<?= site_url('products/delete/' . $productId) ?>" onsubmit="return confirm('Delete this product?');">
                                <?php csrf_field(); ?>
                                <button class="delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="7">No products found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </section>
</main>
</body>
</html>