<!DOCTYPE html>
<html>
<head>
    <title>Bus Tracking</title>
</head>
<body>
    <h2>My Current Bus Assignment</h2>

    <?php if (!empty($currentBus)): ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr><th>Bus Number</th><td><?= htmlspecialchars($currentBus['bus_number']) ?></td></tr>
            <tr><th>Route</th><td><?= htmlspecialchars($currentBus['route']) ?></td></tr>
        </table>
    <?php else: ?>
        <p>You are not assigned to any bus right now.</p>
    <?php endif; ?>

    <p><a href="<?= BASE_URL ?>/student/index">All Buses</a></p>
    <p><a href="<?= BASE_URL ?>/student/schedule">My Schedule</a></p>
    <p><a href="<?= BASE_URL ?>/student/logout">Logout</a></p>
</body>
</html>
s