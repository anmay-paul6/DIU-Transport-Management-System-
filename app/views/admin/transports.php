<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/diu/public');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transport Assignments | Admin</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/styles.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            padding: 20px 0;
        }

        table {
            width: 90%;
            margin: 0 auto 30px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        thead {
            background-color: #2e86de;
            color: white;
        }

        th, td {
            padding: 12px 16px;
            text-align: center;
            border: 1px solid #e0e0e0;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #2e86de;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #1b4f72;
        }

        .btn {
            padding: 6px 14px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #c0392b;
        }

        .back-link {
            display: block;
            width: max-content;
            margin: 0 auto 40px auto;
            padding: 10px 20px;
            background-color: #2e86de;
            color: white;
            border-radius: 6px;
            text-align: center;
        }

        .back-link:hover {
            background-color: #2163af;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            tr {
                margin-bottom: 15px;
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                position: absolute;
                left: 16px;
                top: 12px;
                content: attr(data-label);
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<h2>Transport Assignments</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>Bus Number</th>
            <th>Route</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($transports)): foreach ($transports as $row): ?>
            <tr>
                <td data-label="ID"><?= htmlspecialchars($row['id']) ?></td>
                <td data-label="Student Name"><?= htmlspecialchars($row['student_name']) ?></td>
                <td data-label="Student ID"><?= htmlspecialchars($row['student_id_val']) ?></td>
                <td data-label="Bus Number"><?= htmlspecialchars($row['bus_number']) ?></td>
                <td data-label="Route"><?= htmlspecialchars($row['route']) ?></td>
                <td data-label="Actions">
                    <a href="<?= BASE_URL ?>/admin/transports/delete/<?= $row['id'] ?>" 
                       class="btn"
                       onclick="return confirm('Delete this transport assignment?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; else: ?>
            <tr><td colspan="6">No transport assignments found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<a href="<?= BASE_URL ?>/admin/dashboard" class="back-link">← Back to Dashboard</a>

</body>
</html>
