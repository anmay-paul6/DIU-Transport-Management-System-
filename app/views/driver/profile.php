<!DOCTYPE html>
<html>
<head>
    <title>Driver Profile</title>
</head>
<body>
    <h2>My Profile</h2>
    <?php if ($driver): ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr><th>Name</th><td><?= htmlspecialchars($driver['name']) ?></td></tr>
            <tr><th>Email</th><td><?= htmlspecialchars($driver['email']) ?></td></tr>
            <tr><th>License No</th><td><?= htmlspecialchars($driver['license_no']) ?></td></tr>
            <tr><th>Phone</th><td><?= htmlspecialchars($driver['phone']) ?></td></tr>
        </table>
    <?php else: ?>
        <p>Profile not found.</p>
    <?php endif; ?>

    <p><a href="<?= BASE_URL ?>/driver/index">Dashboard</a></p>
    <p><a href="<?= BASE_URL ?>/driver/schedule">My Schedule</a></p>
    <p><a href="<?= BASE_URL ?>/driver/logout">Logout</a></p>
</body>
</html>
