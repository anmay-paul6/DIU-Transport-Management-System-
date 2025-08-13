<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/diu/public');
}
$error = $data['error'] ?? '';
$success = $data['success'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Signup | Varsity Transport System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        :root {
            --primary: #0056b3;
            --danger: #e74c3c;
            --success: #27ae60;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f4f8;
            position: relative;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url('<?= BASE_URL ?>/images/diu-trans2.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }

        .signup-section {
            position: relative;
            z-index: 1;
            background: #fff;
            padding: 2.5rem 2rem;
            border-radius: 16px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 0.7rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 86, 179, 0.15);
        }

        .signup-button {
            width: 100%;
            padding: 0.8rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .signup-button:hover {
            background: #003d82;
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .message {
            margin-bottom: 1rem;
            padding: 0.8rem 1rem;
            border-radius: 6px;
            font-size: 0.95rem;
        }

        .message.error {
            background: #ffecec;
            color: var(--danger);
            border-left: 5px solid var(--danger);
        }

        .message.success {
            background: #e7fbee;
            color: var(--success);
            border-left: 5px solid var(--success);
        }

        @media (max-width: 480px) {
            body::after {
                display: none;
            }

            .signup-section {
                padding: 2rem 1.2rem;
            }
        }
    </style>
</head>
<body>
    <section class="signup-section">
        <h2><i class="fas fa-user-plus"></i> Student Sign Up</h2>

        <?php if (!empty($error)): ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="message success"><?= $success ?></div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/student/signup" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required autocomplete="name" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required autocomplete="email" />
            </div>
            <div class="form-group">
                <label for="student_id">Student ID</label>
                <input type="text" id="student_id" name="student_id" required autocomplete="off" />
            </div>
            <div class="form-group">
                <label for="batch">Batch</label>
                <input type="text" id="batch" name="batch" required autocomplete="off" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="new-password" />
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required autocomplete="new-password" />
            </div>
            <button type="submit" class="signup-button">Sign Up</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="<?= BASE_URL ?>/student/login">Login</a>
        </div>
    </section>
</body>
</html>
