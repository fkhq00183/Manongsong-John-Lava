<?php
$errors = $errors ?? [];
$old = $old ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/kinich.css') ?>">
</head>
<body>
<main>
    <h1>Add Product</h1>

    <?php if (!empty($errors)) : ?>
        <div class="errors" role="alert">
            <?php foreach ($errors as $error) : ?>
                <p><?= html_escape($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= site_url('products/create') ?>">
        <?php csrf_field(); ?>
        <p>
            <label for="product_name">Product name:</label>
            <input type="text" id="product_name" name="product_name" maxlength="150"
                   value="<?= html_escape($old['product_name'] ?? '') ?>" required>
        </p>
        <p>
            <label for="description">Description:</label>
            <textarea id="description" name="description" maxlength="1000"><?= html_escape($old['description'] ?? '') ?></textarea>
        </p>
        <p>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" min="0"
                   value="<?= html_escape($old['price'] ?? '') ?>" required>
        </p>
        <p>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="0" step="1"
                   value="<?= html_escape($old['quantity'] ?? '') ?>" required>
        </p>
        <button type="submit">Add Product</button>
        <a href="<?= site_url('products') ?>">Cancel</a>
    </form>
</main>
</body>
</html>
