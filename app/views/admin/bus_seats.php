<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Seats for Bus <?= htmlspecialchars($bus['bus_number']) ?></title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        input[type="number"], input[type="text"] { width: 80px; padding: 5px; }
        button { padding: 5px 10px; cursor: pointer; }
        table { border-collapse: collapse; width: 400px; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        .error { color: red; margin-top: 10px; }
        select { padding: 5px; margin-bottom: 20px; }
        a { text-decoration: none; color: #333; }
    </style>
    <script>
        function changeBus(busId) {
            window.location.href = '<?= BASE_URL ?>/admin/bus-seats/' + busId;
        }
    </script>
</head>
<body>

    <h2>Seat Management</h2>

    <!-- ✅ Bus Dropdown -->
    <label for="bus_select">Select Bus:</label>
    <select id="bus_select" onchange="changeBus(this.value)">
        <?php foreach ($buses as $b): ?>
            <option value="<?= $b['id'] ?>" <?= $b['id'] == $bus['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($b['bus_number']) ?> - <?= htmlspecialchars($b['route']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <h3>Seats for Bus <?= htmlspecialchars($bus['bus_number']) ?> (Route: <?= htmlspecialchars($bus['route']) ?>)</h3>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- ✅ Add Seat -->
    <form method="POST" style="margin-bottom: 20px;">
        <label for="seat_number">Seat Number:</label>
        <input type="number" name="seat_number" id="seat_number" required>
        <button type="submit" name="add_seat">Add Seat</button>
    </form>

    <!-- ✅ Seat List -->
    <h3>Existing Seats</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Seat Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($seats)): ?>
                <?php foreach ($seats as $seat): ?>
                    <tr>
                        <td><?= $seat['id'] ?></td>
                        <td>
                            <form method="POST" action="<?= BASE_URL ?>/admin/update-seat/<?= $bus['id'] ?>/<?= $seat['id'] ?>" style="display:inline-flex; gap: 5px;">
                                <input type="text" name="new_seat_number" value="<?= htmlspecialchars($seat['seat_number']) ?>" required>
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="<?= BASE_URL ?>/admin/delete-seat/<?= $bus['id'] ?>/<?= $seat['id'] ?>" style="display:inline;">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this seat?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3">No seats found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p><a href="<?= BASE_URL ?>/admin/buses">← Back to Buses</a></p>

</body>
</html>
