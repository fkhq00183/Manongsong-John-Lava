<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/kinich.css') ?>">
</head>
<body>
    <h1>Product Management Login</h1>

    <?php if (!empty($errors)) : ?>
        <div role="alert">
            <?php foreach ($errors as $error) : ?>
                <p><?= html_escape($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('products/login') ?>" method="POST">
        <?php csrf_field(); ?>
        <p>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?= html_escape($old['username'] ?? '') ?>" required>
        </p>
        <p>
            <label for="password">Password:</label>
            <span class="password-control">
                <input type="password" id="password" name="password" required>
                <button type="button" onclick="togglePassword('password', this)" aria-label="Show password">&#128065;</button>
            </span>
        </p>
        <button type="submit">Login</button>
    </form>
    <a href="<?= site_url('users/register') ?>">Register</a>

    <script>
        function togglePassword(fieldId, button) {
            const field = document.getElementById(fieldId);
            const visible = field.type === 'text';
            field.type = visible ? 'password' : 'text';
            button.setAttribute('aria-label', visible ? 'Show password' : 'Hide password');
        }
    </script>
</body>
</html>
