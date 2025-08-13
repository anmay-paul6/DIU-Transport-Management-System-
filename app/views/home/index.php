<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/diu/public');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Varsity Transport System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0056b3;
            --primary-dark: #003d82;
            --secondary: #00c9a7;
            --accent: #ff6b6b;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --transition: all 0.3s ease;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            scroll-behavior: smooth;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        ul {
            list-style: none;
        }

        .header {
            position: sticky;
            top: 0;
            background: white;
            z-index: 999;
            box-shadow: var(--shadow);
        }

        .navbar {
            max-width: 1200px;
            margin: auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links li a {
            color: var(--dark);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links li a:hover {
            color: var(--primary);
        }

        .menu-toggle {
            display: none;
        }

        .hero {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            padding: 5rem 2rem;
            text-align: center;
            color: white;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 3px 5px rgba(0, 0, 0, 0.5);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 700px;
            margin-inline: auto;
        }

        .login-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .login-link-btn {
            background: white;
            color: var(--primary);
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .login-link-btn:hover {
            background: var(--accent);
            color: white;
        }

        .cta-button {
            background: var(--dark);
            color: white;
            border: none;
            padding: 0.9rem 2.2rem;
            border-radius: 30px;
            margin: 0 0.5rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .cta-button:hover {
            background: var(--primary);
        }

        .section-title {
            text-align: center;
            padding: 3rem 1rem 1rem;
        }

        .section-title h2 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--primary-dark);
        }

        .feature-cards, .stats-container, .testimonial-cards {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            padding: 2rem 1rem;
        }

        .card, .testimonial {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 2rem;
            text-align: center;
            flex: 1 1 280px;
            transition: var(--transition);
        }

        .card:hover, .testimonial:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .card-icon {
            font-size: 2.5rem;
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary);
        }

        .testimonial-content {
            font-style: italic;
            color: var(--gray);
            margin-bottom: 1rem;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .author-avatar {
            background: var(--accent);
            color: white;
            font-weight: bold;
            padding: 0.5rem 0.9rem;
            border-radius: 50%;
        }

        .footer {
            background: var(--dark);
            color: #d6d6d6;
            padding: 3rem 2rem 2rem;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .footer h4, .footer-logo {
            color: white;
        }

        .footer-links li, .contact-info li {
            margin-bottom: 0.6rem;
        }

        .footer-links a:hover {
            color: var(--accent);
        }

        .social-links a {
            margin-right: 1rem;
            color: white;
            font-size: 1.2rem;
        }

        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--primary);
            color: white;
            padding: 0.6rem 0.8rem;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }

        .scroll-top:hover {
            background: var(--accent);
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .menu-toggle {
                display: block;
                color: var(--dark);
                font-size: 1.5rem;
            }

            .login-links {
                flex-direction: column;
            }

            .hero h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="logo"><i class="fas fa-bus"></i> Varsity Transport</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#stats">Stats</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="menu-toggle"><i class="fas fa-bars"></i></div>
        </nav>
    </header>

    <!-- Hero -->
    <section id="home" class="hero">
        <h1>Welcome to Varsity Transport System</h1>
        <p>Efficient, Reliable, and Safe Transportation for Students and Faculty</p>
        <div class="login-links">
            <a href="<?= BASE_URL ?>/admin/login" class="login-link-btn"><i class="fas fa-user-shield"></i> Admin Login</a>
            <a href="<?= BASE_URL ?>/driver/login" class="login-link-btn"><i class="fas fa-id-badge"></i> Driver Login</a>
            <a href="<?= BASE_URL ?>/student/login" class="login-link-btn"><i class="fas fa-user-graduate"></i> Student Login</a>
        </div>
        <div>
            <button class="cta-button">Get Started</button>
            <button class="cta-button">Learn More</button>
        </div>
    </section>

    <!-- Features -->
    <section id="features">
        <div class="section-title">
            <h2>Key Features</h2>
            <p>Explore what makes our transport system reliable and student-friendly.</p>
        </div>
        <div class="feature-cards">
            <div class="card">
                <div class="card-icon"><i class="fas fa-route"></i></div>
                <h3>Multiple Routes</h3>
                <p>Covering all major city points for easy access.</p>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Safety First</h3>
                <p>Trained drivers and emergency protocols ensure safety.</p>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fas fa-clock"></i></div>
                <h3>Timely Service</h3>
                <p>On-time departures and arrivals to keep you punctual.</p>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section id="stats">
        <div class="section-title"><h2>Our Impact</h2></div>
        <div class="stats-container">
            <div class="stat-item"><div class="stat-number">50+</div><div class="stat-label">Buses</div></div>
            <div class="stat-item"><div class="stat-number">2000+</div><div class="stat-label">Students Served</div></div>
            <div class="stat-item"><div class="stat-number">15+</div><div class="stat-label">Daily Routes</div></div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials">
        <div class="section-title"><h2>What Our Students Say</h2></div>
        <div class="testimonial-cards">
            <div class="testimonial">
                <div class="testimonial-content">"The transport system is always on time. I never miss my classes!"</div>
                <div class="testimonial-author">
                    <div class="author-avatar">A</div>
                    <div class="author-info">
                        <h4>Alamin Khan</h4><p>Student, DIU</p>
                    </div>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-content">"Professional drivers and comfortable buses – a great service!"</div>
                <div class="testimonial-author">
                    <div class="author-avatar">S</div>
                    <div class="author-info">
                        <h4>Sadia Nahar</h4><p>Faculty, DIU</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact / Footer -->
    <section id="contact" class="footer">
        <div class="footer-content">
            <div class="footer-about">
                <h3 class="footer-logo">Varsity Transport</h3>
                <p>Providing smooth and reliable transport for students & staff every day.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div>
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#stats">Stats</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                </ul>
            </div>
            <div>
                <h4>Contact</h4>
                <ul class="contact-info">
                    <li><i class="fas fa-map-marker-alt"></i> DIU Campus, Ashulia</li>
                    <li><i class="fas fa-envelope"></i> transport@diu.edu.bd</li>
                    <li><i class="fas fa-phone"></i> +880 1234 567890</li>
                </ul>
            </div>
        </div>
        <div style="text-align:center; padding-top: 1rem;">&copy; <?= date('Y') ?> Varsity Transport. All rights reserved.</div>
    </section>

    <!-- Scroll to Top -->
    <div class="scroll-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        <i class="fas fa-arrow-up"></i>
    </div>

</body>
</html>
