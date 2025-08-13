<?php
// Assume $student, $buses, $tickets variables are passed from the controller
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DIU Transport - Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        .sidebar {
            transition: all 0.3s;
        }
        .sidebar-collapsed {
            width: 80px;
        }
        .sidebar-collapsed .nav-text {
            display: none;
        }
        .sidebar-collapsed .logo-text {
            display: none;
        }
        .sidebar-collapsed .menu-toggle {
            justify-content: center;
        }
        .active-nav {
            background-color: #3b82f6;
            color: white !important;
        }
        .active-nav i {
            color: white !important;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <div class="sidebar bg-blue-800 text-white w-64 flex-shrink-0 flex flex-col">
        <div class="p-4 flex items-center space-x-3 border-b border-blue-700">
            <div class="bg-white p-2 rounded-lg">
                <i class="fas fa-user-graduate text-blue-800 text-xl"></i>
            </div>
            <span class="logo-text text-xl font-bold">DIU Transport</span>
            <button id="toggleSidebar" class="ml-auto text-white focus:outline-none hover:text-blue-300">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <nav class="p-4 space-y-2 flex-grow overflow-auto">
            <a href="/diu/public/student/index" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 active-nav">
                <i class="fas fa-tachometer-alt w-6 text-center"></i>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="/diu/public/student/schedule" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700">
                <i class="fas fa-clock w-6 text-center"></i>
                <span class="nav-text">Schedule</span>
            </a>
            <a href="/diu/public/student/tracking" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700">
                <i class="fas fa-route w-6 text-center"></i>
                <span class="nav-text">Tracking</span>
            </a>
            <a href="/diu/public/student/profile" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700">
                <i class="fas fa-user w-6 text-center"></i>
                <span class="nav-text">Profile</span>
            </a>
            <div class="border-t border-blue-700 mt-4 pt-4">
                <a href="/diu/public/student/logout" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-sign-out-alt w-6 text-center"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto flex flex-col">

        <!-- Top Navigation -->
        <header class="bg-white shadow-sm p-4 flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <i class="fas fa-bell text-gray-500 text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                        <?= htmlspecialchars(substr($student['name'] ?? 'S', 0, 1)) ?>
                    </div>
                    <span><?= htmlspecialchars($student['name'] ?? 'Student') ?></span>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="p-6 flex-grow overflow-auto">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Total Buses</p>
                            <h3 class="text-2xl font-bold"><?= count($buses) ?></h3>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i class="fas fa-bus text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Tickets Booked</p>
                            <h3 class="text-2xl font-bold"><?= count($tickets) ?></h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-ticket-alt text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <!-- Add more stats if needed -->
            </div>

            <!-- Buses List -->
            <section>
                <h2 class="text-xl font-semibold mb-4">Available Buses</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($buses as $bus): ?>
                        <div class="bg-white rounded-lg shadow-md p-4 card-hover transition-all duration-300 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold mb-2"><?= htmlspecialchars($bus['name'] ?? 'Bus') ?></h3>
                                <p class="text-gray-600">Route: <?= htmlspecialchars($bus['route'] ?? 'N/A') ?></p>
                                <p class="text-gray-600">Total Seats: <?= count($bus['seats'] ?? []) ?></p>
                                <p class="text-gray-600">Booked Seats: <?= count($bus['booked_seats'] ?? []) ?></p>
                            </div>
                            <a href="/diu/public/student/viewBusSeats/<?= intval($bus['id']) ?>"
                               class="mt-4 inline-block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition-colors">
                                View & Book Seats
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

        </main>

    </div>
</div>

<script>
    // Sidebar toggle
    document.addEventListener('DOMContentLoaded', function () {
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.querySelector('.sidebar');

        if (toggleSidebar && sidebar) {
            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.toggle('sidebar-collapsed');
            });
        }

        // Highlight active nav link
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('nav a');

        navLinks.forEach(link => {
            if (currentPath === link.getAttribute('href') || currentPath.startsWith(link.getAttribute('href'))) {
                link.classList.add('active-nav');
            }
        });
    });
</script>

</body>
</html>
