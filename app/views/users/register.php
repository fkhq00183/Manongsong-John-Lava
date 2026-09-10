<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/kinich.css') ?>">
</head>
<body>
    <h1>Register</h1>

    <?php if (isset($_GET['registered']) && $_GET['registered'] === '1') : ?>
        <p role="status">Registration successful. You can now log in.</p>
    <?php endif; ?>

    <?php if (!empty($errors)) : ?>
        <div role="alert">
            <?php foreach ($errors as $error) : ?>
                <p><?= html_escape($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('users/register') ?>" method="POST">
        <?php csrf_field(); ?>

        <p>
            <label for="username">Username:</label>
            <input
                type="text"
                id="username"
                name="username"
                maxlength="100"
                value="<?= html_escape($old['username'] ?? '') ?>"
                required
            >
        </p>

        <p>
            <label for="password">Password:</label>
            <span class="password-control">
                <input type="password" id="password" name="password" minlength="8" required>
                <button type="button" onclick="togglePassword('password', this)" aria-label="Show password">&#128065;</button>
            </span>
        </p>

        <p>
            <label for="password_confirmation">Confirm password:</label>
            <span class="password-control">
                <input type="password" id="password_confirmation" name="password_confirmation" minlength="8" required>
                <button type="button" onclick="togglePassword('password_confirmation', this)" aria-label="Show password">&#128065;</button>
            </span>
        </p>

        <button type="submit">Register</button>
        <a href="<?= site_url('products/login') ?>">Back to login</a>
    </form>

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
