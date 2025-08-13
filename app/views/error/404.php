<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --primary: #0056b3;
            --accent: #ff3e3e;
            --bg: #f8f9fa;
            --text: #333;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: var(--text);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .error-box {
            background: #fff;
            padding: 3rem 2.5rem;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 600px;
            width: 100%;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .error-box h1 {
            font-size: 4rem;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }

        .error-box h2 {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .error-box p {
            font-size: 1rem;
            margin-bottom: 2rem;
            color: #555;
        }

        .error-detail {
            background: #fff5f5;
            color: #b30000;
            border-left: 5px solid #ff3e3e;
            padding: 1rem;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            border-radius: 6px;
            text-align: left;
            word-break: break-word;
        }

        a.back-home {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: var(--primary);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s ease;
        }

        a.back-home:hover {
            background: #003d82;
        }

        @media (max-width: 500px) {
            .error-box {
                padding: 2rem;
            }

            .error-box h1 {
                font-size: 3rem;
            }

            .error-box h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="error-box">
        <h1><i class="fas fa-exclamation-triangle"></i></h1>
        <h2>404 - Page Not Found</h2>
        <p>The page you're looking for doesn’t exist or something went wrong.</p>

        <?php if (!empty($msg)): ?>
            <div class="error-detail"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>

        <a href="<?= BASE_URL ?>" class="back-home"><i class="fas fa-home"></i> Go to Homepage</a>
    </div>
</body>
</html>
