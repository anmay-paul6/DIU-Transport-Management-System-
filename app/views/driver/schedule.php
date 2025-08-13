<!DOCTYPE html>
<html>
<head>
    <title>My Bus Schedule</title>
</head>
<body>
    <h2>My Assigned Buses & Routes</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Bus Number</th>
                <th>Route</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($buses)): $i = 1; foreach ($buses as $bus): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($bus['bus_number']) ?></td>
                    <td><?= htmlspecialchars($bus['route']) ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="3">No assigned buses.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <p><a href="<?= BASE_URL ?>/driver/index">Dashboard</a></p>
    <p><a href="<?= BASE_URL ?>/driver/logout">Logout</a></p>
</body>
</html>
