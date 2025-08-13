<?php
if (!defined('BASE_URL')) define('BASE_URL', '/diu/public');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>My Bus Schedule | Varsity Transport</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/styles.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
            background-color: #f8f9fa;
            color: #333;
        }
        h2 {
            margin-bottom: 1rem;
        }
        div.schedule-info {
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
            max-width: 400px;
        }
        div.schedule-info strong {
            display: inline-block;
            width: 100px;
        }
        a.back-link {
            display: inline-block;
            margin-top: 1.5rem;
            text-decoration: none;
            color: var(--primary, #4361ee);
            font-weight: 600;
        }
        a.back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>My Bus Schedule</h2>
    <?php if (!empty($bus)): ?>
        <div class="schedule-info">
            <p><strong>Bus Number:</strong> <?= htmlspecialchars($bus['bus_number']) ?></p>
            <p><strong>Route:</strong> <?= htmlspecialchars($bus['route']) ?></p>
            <p><strong>Driver ID:</strong> <?= htmlspecialchars($bus['driver_id']) ?></p>
        </div>
    <?php else: ?>
        <p>You are not assigned to a bus yet.</p>
    <?php endif; ?>
    <a href="<?= BASE_URL ?>/student/index" class="back-link">← Back to Dashboard</a>
</body>
</html>
