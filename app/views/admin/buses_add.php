<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/diu/public');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Bus | Admin</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 60px auto;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 15px;
            font-weight: 500;
            color: #34495e;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .error {
            background-color: #fce4e4;
            color: #d8000c;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Bus</h2>

        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/admin/buses/add" method="POST">
            <label for="bus_number">
                Bus Number:
                <input type="text" id="bus_number" name="bus_number" required>
            </label>

            <label for="route">
                Route:
                <input type="text" id="route" name="route" required>
            </label>

            <label for="driver_id">
                Driver:
                <select name="driver_id" id="driver_id" required>
                    <option value="">-- Select Driver --</option>
                    <?php if (!empty($drivers)): foreach ($drivers as $driver): ?>
                        <option value="<?= $driver['id'] ?>">
                            <?= htmlspecialchars($driver['name']) ?>
                        </option>
                    <?php endforeach; endif; ?>
                </select>
            </label>

            <button type="submit">Add Bus</button>
        </form>

        <div class="back-link">
            <p><a href="<?= BASE_URL ?>/admin/buses">← Back to Bus List</a></p>
        </div>
    </div>
</body>
</html>
