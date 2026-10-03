<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$product = $product ?? [];
$old = $old ?? [];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"><title>Edit Product</title><link rel="stylesheet" href="<?= base_url('assets/css/kinich.css') ?>">
    </head>
        <body>
<main>
<h1>Edit Product</h1>
<?php if (!empty($errors)) : ?>
    <div class="errors" role="alert"><?php foreach ($errors as $error) : ?>
        <p><?= html_escape($error) ?></p><?php endforeach; ?>
    </div><?php endif; ?>
<form method="post" action="<?= site_url('products/update/' . (int) $product['id']) ?>">
    <?php csrf_field(); ?>
<p>
    <label>Product name <input name="product_name" maxlength="150" required value="<?= html_escape($old['product_name'] ?? $product['product_name']) ?>"></label></p><p><label>Description<br><textarea name="description"><?= html_escape($old['description'] ?? ($product['description'] ?? '')) ?></textarea>
</label></p>
<p>
    <label>Price <input type="number" name="price" min="0" step="0.01" required value="<?= html_escape($old['price'] ?? $product['price']) ?>"></label></p><p><label>Quantity <input type="number" name="quantity" min="0" step="1" required value="<?= html_escape($old['quantity'] ?? $product['quantity']) ?>">
</label></p><button type="submit">Update Product</button> <a href="<?= site_url('products') ?>">Cancel</a>
</form>
</main>
 </body>
</html>
