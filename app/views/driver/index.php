<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/diu/public');
}
// $driver_name, $bus_number, $route, $today_trips should be set by extract($data) in the controller
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard | Varsity Transport System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4ade80;
            --warning: #facc15;
            --danger: #f87171;
            --gray: #6c757d;
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05), 0 6px 6px rgba(0, 0, 0, 0.07);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e7f1 100%);
            color: var(--dark);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Header Styles */
        header {
            background: linear-gradient(120deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: 700;
            animation: fadeInLeft 0.8s ease;
        }

        .logo i {
            margin-right: 12px;
            font-size: 2rem;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: var(--transition);
            position: relative;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--accent);
            transition: var(--transition);
            border-radius: 3px;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            background: rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
        }

        .user-profile:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--accent), var(--primary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.2rem;
        }

        /* Main Content */
        .dashboard {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .welcome-section {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
            animation: fadeIn 0.8s ease;
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 8px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--accent));
        }

        .welcome-section h2 {
            font-size: 2.2rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .welcome-section p {
            font-size: 1.1rem;
            color: var(--gray);
            max-width: 800px;
            line-height: 1.7;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            animation: slideUp 0.6s ease;
            position: relative;
            overflow: hidden;
            transform: translateY(20px);
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .card:nth-child(2) {
            animation-delay: 0.4s;
        }

        .card:nth-child(3) {
            animation-delay: 0.6s;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }

        .card:hover .card-icon {
            transform: scale(1.1);
            color: var(--accent);
        }

        .card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .card p {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            transition: var(--transition);
        }

        .card:hover p {
            color: var(--secondary);
        }

        /* Notifications */
        .notifications {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            animation: fadeIn 1s ease;
        }

        .notifications h3 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: var(--dark);
        }

        .notifications h3 i {
            color: var(--warning);
        }

        .notification-list {
            list-style: none;
        }

        .notification-item {
            padding: 1.2rem;
            border-left: 4px solid var(--accent);
            background: #f8f9ff;
            margin-bottom: 1rem;
            border-radius: 0 8px 8px 0;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: var(--transition);
            animation: fadeInRight 0.5s ease;
        }

        .notification-item:hover {
            transform: translateX(8px);
            background: #edf2ff;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .notification-content {
            flex: 1;
        }

        .notification-content p {
            color: var(--gray);
            margin-top: 0.3rem;
            font-size: 0.95rem;
        }

        .notification-time {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 0.3rem;
        }

        /* Footer */
        footer {
            background: linear-gradient(120deg, var(--primary), var(--secondary));
            color: white;
            text-align: center;
            padding: 1.5rem;
            margin-top: 3rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                width: 100%;
                justify-content: center;
            }

            .features {
                grid-template-columns: 1fr;
            }

            .welcome-section,
            .card,
            .notifications {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .nav-links {
                flex-direction: column;
                gap: 0.5rem;
            }

            .user-profile span {
                display: none;
            }

            .welcome-section h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <i class="fas fa-bus"></i>
                <span>Varsity Transport</span>
            </div>
            <ul class="nav-links">
                <li><a href="<?= BASE_URL ?>/driver/index"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="#"><i class="fas fa-route"></i> Routes</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i> Schedule</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Passengers</a></li>
                <li><a href="<?= BASE_URL ?>/driver/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <li>
                    <a href="<?= BASE_URL ?>/driver/profile" class="user-profile">
                        <div class="profile-pic"><?= isset($driver_name) ? substr($driver_name, 0, 1) : 'D' ?></div>
                        <span><?= htmlspecialchars($driver_name ?? 'Driver') ?></span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="dashboard">
        <section class="welcome-section">
            <h2>Welcome, <?= htmlspecialchars($driver_name ?? 'Driver') ?>!</h2>
            <p>You have <?= (int)($today_trips ?? 0) ?> trips scheduled for today. Your next departure is at 10:30 AM from Campus North Gate. Drive safely and have a great day!</p>
        </section>

        <div class="features">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-bus"></i>
                </div>
                <h3>Your Bus</h3>
                <p><?= htmlspecialchars($bus_number ?? 'Not assigned') ?></p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-route"></i>
                </div>
                <h3>Your Route</h3>
                <p><?= htmlspecialchars($route ?? 'Not assigned') ?></p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <h3>Today's Trips</h3>
                <p><?= (int)($today_trips ?? 0) ?></p>
            </div>
        </div>

        <section class="notifications">
            <h3><i class="fas fa-bell"></i> Notifications</h3>
            <ul class="notification-list">
                <li class="notification-item">
                    <div class="notification-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="notification-content">
                        <strong>Route Update</strong>
                        <p>Route 7A has been temporarily diverted due to construction work.</p>
                        <div class="notification-time">10 minutes ago</div>
                    </div>
                </li>
                <li class="notification-item">
                    <div class="notification-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="notification-content">
                        <strong>Maintenance Complete</strong>
                        <p>Your bus #DIU-2025 has passed the monthly inspection.</p>
                        <div class="notification-time">2 hours ago</div>
                    </div>
                </li>
                <li class="notification-item">
                    <div class="notification-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="notification-content">
                        <strong>Passenger Feedback</strong>
                        <p>You have 5 new passenger ratings from yesterday's trips.</p>
                        <div class="notification-time">Yesterday</div>
                    </div>
                </li>
            </ul>
        </section>
    </main>

    <footer>
        <p>© 2025 Varsity Transport System. All Rights Reserved.</p>
    </footer>

    <script>
        // Add animation to cards when they come into view
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            });

            // Add animation to notification items
            const notifications = document.querySelectorAll('.notification-item');
            notifications.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.2}s`;
            });

            // Add hover effect to cards
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-8px)';
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>

</html>
