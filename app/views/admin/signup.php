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
    <title>Admin Signup | Varsity Transport System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --primary: #0056b3;
            --primary-dark: #003d82;
            --accent: #00c9a7;
            --danger: #e74c3c;
            --success: #27ae60;
            --bg-overlay: rgba(0, 0, 0, 0.5);
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


        .signup-container {
    background: rgba(255, 255, 255, 0.4); /* less opaque white */
    padding: 2.5rem 2rem;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
    width: 100%;
    max-width: 450px;
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

        input[type="text"],
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

        .signup-button {
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

        .signup-button:hover {
            background: var(--primary-dark);
        }

        .login-link {
            text-align: center;
            margin-top: 1.2rem;
            font-size: 0.95rem;
        }

        .login-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
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

        .success-msg {
            background: #e7f7ec;
            border-left: 4px solid var(--success);
            padding: 0.75rem;
            margin-bottom: 1rem;
            color: var(--success);
            border-radius: 6px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 500px) {
            .signup-container {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <section class="signup-section">
        <div class="signup-container">
            <h2><i class="fas fa-user-plus"></i> Admin Sign Up</h2>

            <?php if (!empty($error)): ?>
                <div class="error-msg"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="success-msg"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/admin/signup" method="POST">
                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" id="name" name="name" required autocomplete="name" />
                </div>
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" name="email" required autocomplete="email" />
                </div>
                <input type="hidden" name="role" value="1" />
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="password" name="password" required autocomplete="new-password" />
                </div>
                <div class="form-group">
                    <label for="confirm_password"><i class="fas fa-lock"></i> Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required autocomplete="new-password" />
                </div>
                <button type="submit" class="signup-button">Sign Up</button>
            </form>

            <div class="login-link">
                Already have an account? <a href="<?= BASE_URL ?>/admin/login">Login</a>
            </div>
        </div>
    </section>
</body>
</html>
