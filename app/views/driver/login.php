<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/diu/public');
}

$error = $data['error'] ?? '';

// Redirect if already logged in as driver
if (isset($_SESSION['driver']) && !empty($_SESSION['driver']['id'])) {
    header('Location: ' . BASE_URL . '/driver/index');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Driver Login | Varsity Transport System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --primary: #0056b3;
            --secondary: #00c9a7;
            --dark: #1a1a2e;
            --light: #f9f9f9;
            --danger: #e74c3c;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5); /* dark overlay for contrast */
            z-index: 0;
        }

        .login-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 3rem 2rem;
            border-radius: 16px;
            max-width: 400px;
            width: 100%;
            box-shadow: var(--shadow);
            animation: fadeIn 0.6s ease-in-out;
            position: relative;
            z-index: 1;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-section h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
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
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: 0.3s;
        }

        input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 89, 179, 0.2);
        }

        .login-button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.8rem;
            width: 100%;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            margin-top: 0.5rem;
            transition: background 0.3s;
        }

        .login-button:hover {
            background: #004095;
        }

        .signup-link {
            text-align: center;
            font-size: 0.95rem;
            margin-top: 1rem;
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
            background: #ffecec;
            border-left: 5px solid var(--danger);
            padding: 0.8rem 1rem;
            color: var(--danger);
            margin-bottom: 1rem;
            border-radius: 6px;
            font-size: 0.95rem;
        }

        @media (max-width: 480px) {
            .login-section {
                padding: 2rem 1.5rem;
            }

            .login-section h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <section class="login-section">
        <h2><i class="fas fa-id-badge"></i> Driver Login</h2>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/driver/login" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    autocomplete="username"
                    autofocus
                    placeholder="Enter your email"
                />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password"
                />
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>

        <div class="signup-link">
            Don't have an account? <a href="<?= BASE_URL ?>/driver/signup">Sign up</a>
        </div>
    </section>
</body>
</html>
