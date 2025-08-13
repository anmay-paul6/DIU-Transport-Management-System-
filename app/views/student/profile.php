<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Student Profile</title>
    <style>
        /* Reset & base */
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        .profile-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgb(0 0 0 / 0.1);
            max-width: 500px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
            font-weight: 700;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 35px;
        }
        th, td {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid #e1e8ed;
            font-size: 1.1rem;
            color: #34495e;
        }
        th {
            background-color: #ecf0f1;
            font-weight: 600;
            width: 35%;
        }
        td {
            background-color: #fafafa;
            border-radius: 4px;
        }
        p.message {
            font-size: 1.1rem;
            color: #e74c3c;
            text-align: center;
        }
        .links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .links a {
            text-decoration: none;
            padding: 10px 22px;
            background-color: #2980b9;
            color: white;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgb(41 128 185 / 0.3);
        }
        .links a:hover {
            background-color: #1c5c85;
            box-shadow: 0 6px 14px rgb(28 92 133 / 0.6);
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>My Profile</h2>

        <?php if ($student): ?>
        <table>
            <tr>
                <th>Name</th>
                <td><?= htmlspecialchars($student['name']) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($student['email']) ?></td>
            </tr>
            <tr>
                <th>Student ID</th>
                <td><?= htmlspecialchars($student['student_id']) ?></td>
            </tr>
            <tr>
                <th>Batch</th>
                <td><?= htmlspecialchars($student['batch']) ?></td>
            </tr>
        </table>
        <?php else: ?>
        <p class="message">Profile not found.</p>
        <?php endif; ?>

        <div class="links">
            <a href="<?= BASE_URL ?>/student/index">All Buses</a>
            <a href="<?= BASE_URL ?>/student/schedule">My Schedule</a>
            <a href="<?= BASE_URL ?>/student/logout">Logout</a>
        </div>
    </div>
</body>
</html>
