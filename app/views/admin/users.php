<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            padding: 20px;
        }

        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
            margin-top: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #eaeaea;
        }

        th {
            background-color: #3498db;
            color: #fff;
            font-weight: normal;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td:first-child, th:first-child {
            width: 40px;
            text-align: center;
        }

        a {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2980b9;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 6px;
                background: #fff;
                padding: 10px;
            }

            td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
                border: none;
                border-bottom: 1px solid #eee;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #555;
            }
        }
    </style>
</head>
<body>

    <h2>All Students</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Student ID</th>
                <th>Batch</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students)): $i=1; foreach($students as $stu): ?>
                <tr>
                    <td data-label="#"><?= $i++ ?></td>
                    <td data-label="Name"><?= htmlspecialchars($stu['name']) ?></td>
                    <td data-label="Email"><?= htmlspecialchars($stu['email']) ?></td>
                    <td data-label="Student ID"><?= htmlspecialchars($stu['student_id']) ?></td>
                    <td data-label="Batch"><?= htmlspecialchars($stu['batch']) ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="5">No students found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>All Drivers</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>License No</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($drivers)): $j=1; foreach($drivers as $drv): ?>
                <tr>
                    <td data-label="#"><?= $j++ ?></td>
                    <td data-label="Name"><?= htmlspecialchars($drv['name']) ?></td>
                    <td data-label="Email"><?= htmlspecialchars($drv['email']) ?></td>
                    <td data-label="License No"><?= htmlspecialchars($drv['license_no']) ?></td>
                    <td data-label="Phone"><?= htmlspecialchars($drv['phone']) ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="5">No drivers found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="<?= BASE_URL ?>/admin/dashboard">⬅ Back to Dashboard</a>

</body>
</html>
