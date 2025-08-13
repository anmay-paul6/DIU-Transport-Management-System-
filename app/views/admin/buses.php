<?php
// If not already set, define BASE_URL for links
if (!defined('BASE_URL')) {
    define('BASE_URL', '/diu/public');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Buses | Admin</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        .add-btn {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }

        .add-btn:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f0f0f0;
            color: #34495e;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .actions a {
            text-decoration: none;
            margin-right: 10px;
            color: #2980b9;
            font-weight: 500;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .actions a.delete {
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Buses</h2>

        <a class="add-btn" href="<?= BASE_URL ?>/admin/buses/add">+ Add New Bus</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bus Number</th>
                    <th>Route</th>
                    <th>Driver ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($buses)): foreach ($buses as $bus): ?>
                    <tr>
                        <td><?= htmlspecialchars($bus['id']) ?></td>
                        <td><?= htmlspecialchars($bus['bus_number']) ?></td>
                        <td><?= htmlspecialchars($bus['route']) ?></td>
                        <td><?= htmlspecialchars($bus['driver_id']) ?></td>
                        <td class="actions">
                            <a href="<?= BASE_URL ?>/admin/buses/edit/<?= $bus['id'] ?>">Edit</a>
                            <a href="<?= BASE_URL ?>/admin/buses/delete/<?= $bus['id'] ?>" class="delete" onclick="return confirm('Delete this bus?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center; color: gray;">No buses found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
