<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/diu/public');
}

$error = $data['error'] ?? '';
$success = $data['success'] ?? '';

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
    <title>Driver Signup | Varsity Transport System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --primary: #0056b3;
            --secondary: #00c9a7;
            --success: #27ae60;
            --danger: #e74c3c;
            --glass-bg: rgba(255, 255, 255, 0.9);
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
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
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .signup-section {
            position: relative;
            z-index: 1;
            max-width: 500px;
            width: 100%;
            background: var(--glass-bg);
            padding: 3rem 2rem;
            border-radius: 16px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .signup-section h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 0.7rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            transition: border 0.3s;
        }

        input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.15);
        }

        .signup-button {
            background: var(--primary);
            color: white;
            padding: 0.8rem;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .signup-button:hover {
            background: #004091;
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        .login-link a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .message {
            padding: 0.8rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .message.error {
            background: #ffeaea;
            color: var(--danger);
            border-left: 5px solid var(--danger);
        }

        .message.success {
            background: #e7fbee;
            color: var(--success);
            border-left: 5px solid var(--success);
        }

        @media (max-width: 480px) {
            .signup-section {
                padding: 2rem 1.2rem;
            }
        }
    </style>
</head>
<body>
    <section class="signup-section">
        <h2><i class="fas fa-user-plus"></i> Driver Sign Up</h2>

        <?php if (!empty($error)): ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="message success"><?= $success ?></div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/driver/signup" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    autocomplete="name"
                    placeholder="e.g. John Doe"
                />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    autocomplete="email"
                    placeholder="e.g. john@example.com"
                />
            </div>
            <div class="form-group">
                <label for="license_no">License Number</label>
                <input
                    type="text"
                    id="license_no"
                    name="license_no"
                    required
                    placeholder="e.g. DL-XXXX-XXXX"
                />
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    required
                    autocomplete="tel"
                    placeholder="e.g. 01XXXXXXXXX"
                />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter password"
                />
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    required
                    autocomplete="new-password"
                    placeholder="Re-type password"
                />
            </div>
            <button type="submit" class="signup-button">Sign Up</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="<?= BASE_URL ?>/driver/login">Login</a>
        </div>
    </section>
</body>
</html>
