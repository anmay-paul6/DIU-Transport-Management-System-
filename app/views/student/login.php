<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/diu/public');
}

$error = $data['error'] ?? '';

// Redirect logged-in students to dashboard
if (isset($_SESSION['student'])) {
    header('Location: ' . BASE_URL . '/student/index');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Login | Varsity Transport System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        :root {
            --primary: #0056b3;
            --danger: #e74c3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5); /* dark overlay */
            z-index: 0;
        }

        .login-section {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 3rem 2rem;
            border-radius: 16px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease;
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
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            transition: border 0.3s ease;
        }

        input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.15);
        }

        .login-button {
            width: 100%;
            padding: 0.8rem;
            background: var(--primary);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-button:hover {
            background: #003d82;
        }

        .signup-link {
            text-align: center;
            margin-top: 1.2rem;
            font-size: 0.95rem;
        }

        .signup-link a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: #ffeaea;
            border-left: 5px solid var(--danger);
            padding: 0.8rem 1rem;
            color: var(--danger);
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        @media (max-width: 480px) {
            .login-section {
                padding: 2rem 1.2rem;
            }

            h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <section class="login-section">
        <h2><i class="fas fa-user-graduate"></i> Student Login</h2>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/student/login" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required autocomplete="username" autofocus />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password" />
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>

        <div class="signup-link">
            Don't have an account? <a href="<?= BASE_URL ?>/student/signup">Sign up</a>
        </div>
    </section>
</body>
</html>
