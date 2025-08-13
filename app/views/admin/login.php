<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/diu/public');
}
$error = $data['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login | Varsity Transport System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --primary: #0056b3;
            --primary-dark: #003d82;
            --accent: #00c9a7;
            --danger: #e74c3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: 
                url('<?= BASE_URL ?>/images/diu-trans2.jpg') center/cover no-repeat fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #001b3a;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.5); /* 50% transparent white */
            padding: 2.5rem 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.8s ease-in-out;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
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
            font-weight: 600;
            color: #222;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            transition: 0.3s ease;
        }

        input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 86, 179, 0.2);
        }

        .login-button {
            width: 100%;
            padding: 0.75rem;
            background: var(--primary);
            color: white;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-button:hover {
            background: var(--primary-dark);
        }

        .signup-link {
            text-align: center;
            margin-top: 1.2rem;
            font-size: 0.95rem;
        }

        .signup-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .error-msg {
            background: #ffe5e5;
            border-left: 4px solid var(--danger);
            padding: 0.75rem;
            margin-bottom: 1rem;
            color: var(--danger);
            border-radius: 6px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 500px) {
            .login-container {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <section class="login-section">
        <div class="login-container">
            <h2><i class="fas fa-user-shield"></i> Admin Login</h2>

            <?php if (!empty($error)): ?>
                <div class="error-msg"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/admin/login" method="POST" autocomplete="on">
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" name="email" required autocomplete="username" autofocus />
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password" />
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>

            <div class="signup-link">
                Don’t have an account? <a href="<?= BASE_URL ?>/admin/signup">Sign up</a>
            </div>
        </div>
    </section>
</body>
</html>
