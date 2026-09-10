<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management Module</title>

    <style>

        /* =================================
           BASIC PAGE SETTINGS
           ================================= */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            /* Increased spacing around the whole page */
            padding: 60px 35px;

            font-family: Arial, sans-serif;

            /* Dark ocean background */
            background: #06141f;

            color: #e8fbff;
        }

        /* Main content width */
        .container {
            max-width: 1100px;
            margin: auto;
        }


        /* =================================
           HEADER
           ================================= */

        .header {
            /* More space below the header */
            margin-bottom: 35px;
        }

        .header h1 {
            margin: 0;

            /* Larger title spacing */
            letter-spacing: 2px;

            color: #00eaff;

            font-size: 34px;
            font-weight: 700;

            /* Neon glow */
            text-shadow:
                0 0 5px #00eaff,
                0 0 15px #00eaff;
        }

        .header p {
            /* More space between title and subtitle */
            margin-top: 12px;

            color: #83c9d8;
            font-size: 15px;

            letter-spacing: 1px;
        }

        /* Ocean wave decoration */
        .wave {
            color: #00eaff;
            margin-right: 10px;

            text-shadow:
                0 0 5px #00eaff,
                0 0 12px #00eaff;
        }


        /* =================================
           TABLE CARD
           ================================= */

        .card {
            background: #0a202d;

            /* Increased inner spacing */
            padding: 30px;

            border-radius: 18px;

            /* Neon border */
            border: 1px solid #00d9ff;

            /* Neon glow around the card */
            box-shadow:
                0 0 8px rgba(0, 234, 255, 0.5),
                0 0 25px rgba(0, 234, 255, 0.15);
        }

        /* Prevents table from breaking on mobile */
        .table-wrapper {
            overflow-x: auto;
        }


        /* =================================
           TABLE
           ================================= */

        table {
            border-collapse: separate;
            border-spacing: 0;

            width: 100%;
        }

        /* Table header */
        th {
            background: #062b3a;

            color: #00eaff;

            /* Increased cell spacing */
            padding: 17px 20px;

            text-align: left;

            font-size: 14px;

            letter-spacing: 1px;

            border-bottom: 1px solid #00d9ff;

            text-shadow:
                0 0 5px rgba(0, 234, 255, 0.8);
        }

        /* Rounded top corners */
        th:first-child {
            border-radius: 10px 0 0 0;
        }

        th:last-child {
            border-radius: 0 10px 0 0;
        }


        /* =================================
           TABLE DATA
           ================================= */

        td {
            /* More vertical and horizontal spacing */
            padding: 18px 20px;

            border-bottom: 1px solid #163b49;

            font-size: 14px;

            color: #d8f5fa;
        }

        /* More space between rows */
        tbody tr {
            transition: 0.25s ease;
        }

        /* Neon hover effect */
        tbody tr:hover {
            background: #0d3342;

            box-shadow:
                inset 4px 0 0 #00eaff;

            transform: translateX(3px);
        }

        /* Remove border from last row */
        tbody tr:last-child td {
            border-bottom: none;
        }


        /* =================================
           SPECIAL TEXT
           ================================= */

        /* ID styling */
        .id {
            color: #00eaff;

            font-weight: 700;

            text-shadow:
                0 0 6px rgba(0, 234, 255, 0.7);
        }

        /* Username styling */
        .username {
            color: #28f5c4;

            font-weight: 600;

            text-shadow:
                0 0 6px rgba(40, 245, 196, 0.6);
        }

        /* No users message */
        .empty {
            text-align: center;

            padding: 40px;

            color: #78aebc;

            letter-spacing: 1px;
        }


        /* =================================
           MOBILE RESPONSIVE DESIGN
           ================================= */

        @media (max-width: 600px) {

            body {
                /* Smaller spacing on phones */
                padding: 35px 15px;
            }

            .header {
                margin-bottom: 25px;
            }

            .header h1 {
                font-size: 27px;
            }

            .card {
                padding: 18px;
            }

            th,
            td {
                /* Comfortable spacing on small screens */
                padding: 14px 12px;

                font-size: 13px;
            }
        }

    </style>
</head>

<body>
    <?php
    $escape = static function ($value) {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    };
    $old = $old ?? [];
    $errors = $errors ?? [];
    ?>

    <div class="container">
        <div class="header">
            <h1><span class="wave">[+]</span> Users</h1>
            <p>User Management Module</p>
        </div>

        <div class="card">
            <?php if (!empty($errors)) : ?>
                <div class="errors" role="alert">
                    <?php foreach ($errors as $error) : ?>
                        <p><?= $escape($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <h2>Add User</h2>
            <form method="POST" action="/users/create">
                <?php csrf_field(); ?>
                <input type="text" name="username" value="<?= $escape($old['username'] ?? '') ?>"
                       minlength="3" maxlength="100" pattern="[A-Za-z0-9]+" required>
                <input type="email" name="email" value="<?= $escape($old['email'] ?? '') ?>"
                       maxlength="255" required>
                <input type="password" name="password" minlength="8" maxlength="255" required>
                <select name="role" required>
                    <option value="">Select role</option>
                    <?php foreach (['user', 'moderator', 'admin'] as $role) : ?>
                        <option value="<?= $role ?>" <?= (($old['role'] ?? '') === $role) ? 'selected' : '' ?>>
                            <?= ucfirst($role) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Add User</button>
            </form>
        </div>

        <div class="card">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)) : ?>
                            <?php foreach ($users as $user) : ?>
                                <?php $userId = (int) $user['id']; ?>
                                <tr>
                                    <td class="id"><?= $userId ?></td>
                                    <td class="username"><?= $escape($user['username']) ?></td>
                                    <td><?= $escape($user['email']) ?></td>
                                    <td><?= $escape($user['role'] ?? 'user') ?></td>
                                    <td><?= ((int) ($user['is_active'] ?? 1) === 1) ? 'Active' : 'Inactive' ?></td>
                                    <td>
                                        <details>
                                            <summary>Edit</summary>
                                            <form method="POST" action="/users/update/<?= $userId ?>">
                                                <?php csrf_field(); ?>
                                                <input type="text" name="username" value="<?= $escape($user['username']) ?>"
                                                       minlength="3" maxlength="100" pattern="[A-Za-z0-9]+" required>
                                                <input type="email" name="email" value="<?= $escape($user['email']) ?>"
                                                       maxlength="255" required>
                                                <input type="password" name="password" minlength="8" maxlength="255"
                                                       placeholder="Leave blank to keep current password">
                                                <select name="role" required>
                                                    <?php foreach (['user', 'moderator', 'admin'] as $role) : ?>
                                                        <option value="<?= $role ?>" <?= (($user['role'] ?? 'user') === $role) ? 'selected' : '' ?>>
                                                            <?= ucfirst($role) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <select name="is_active" required>
                                                    <option value="1" <?= ((int) ($user['is_active'] ?? 1) === 1) ? 'selected' : '' ?>>Active</option>
                                                    <option value="0" <?= ((int) ($user['is_active'] ?? 1) === 0) ? 'selected' : '' ?>>Inactive</option>
                                                </select>
                                                <button type="submit">Save</button>
                                            </form>
                                        </details>
                                        <form method="POST" action="/users/delete/<?= $userId ?>"
                                              onsubmit="return confirm('Delete this user?');">
                                            <?php csrf_field(); ?>
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="empty">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
