<!-- C:\xampp\htdocs\diu\app\views\admin\dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DIU Transport - Admin Dashboard</title>
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
        /* Submenu styling */
        .submenu {
            margin-left: 1rem;
            border-left: 2px solid #2563eb;
            padding-left: 0.5rem;
        }
        .submenu a {
            padding-left: 1rem;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-blue-800 text-white w-64 flex-shrink-0 flex flex-col">
            <div class="p-4 flex items-center space-x-3 border-b border-blue-700">
                <div class="bg-white p-2 rounded-lg">
                    <i class="fas fa-bus text-blue-800 text-xl"></i>
                </div>
                <span class="logo-text text-xl font-bold">DIU Transport</span>

                <!-- Sidebar Toggle Button -->
                <button id="toggleSidebar" class="ml-auto text-white focus:outline-none hover:text-blue-300">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="p-4 space-y-2 flex-grow overflow-auto">
                <a href="/diu/public/admin/dashboard" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-tachometer-alt w-6 text-center"></i>
                    <span class="nav-text">Dashboard</span>
                </a>

                <a href="/diu/public/admin/buses" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-bus w-6 text-center"></i>
                    <span class="nav-text">Buses</span>
                </a>

                <!-- Bus Related Submenu -->
                <div class="submenu">
                    <a href="/diu/public/admin/bus-seats/1" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-blue-600">
                        <i class="fas fa-chair w-6 text-center"></i>
                        <span class="nav-text">Bus Seats Management</span>
                    </a>
                    <a href="/diu/public/admin/buses/schedules/1" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-blue-600">
                        <i class="fas fa-clock w-6 text-center"></i>
                        <span class="nav-text">Bus Schedules Management</span>
                    </a>
                </div>

                <a href="/diu/public/admin/transports" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-route w-6 text-center"></i>
                    <span class="nav-text">Transports</span>
                </a>

                <a href="/diu/public/admin/users" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-users w-6 text-center"></i>
                    <span class="nav-text">Users</span>
                </a>

                <a href="/diu/public/admin/signup" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-user-plus w-6 text-center"></i>
                    <span class="nav-text">Add Admin</span>
                </a>

                <div class="border-t border-blue-700 mt-4 pt-4">
                    <a href="/diu/public/admin/logout" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700">
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
                            <?= htmlspecialchars(substr($_SESSION['admin_name'] ?? 'A', 0, 1)) ?>
                        </div>
                        <span><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></span>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6 flex-grow overflow-auto">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow-md p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Users</p>
                                <h3 class="text-2xl font-bold"><?= htmlspecialchars($total_users) ?></h3>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Students</p>
                                <h3 class="text-2xl font-bold"><?= htmlspecialchars($total_students) ?></h3>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-user-graduate text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Drivers</p>
                                <h3 class="text-2xl font-bold"><?= htmlspecialchars($total_drivers) ?></h3>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-user-tie text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Buses</p>
                                <h3 class="text-2xl font-bold"><?= htmlspecialchars($total_buses) ?></h3>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-bus text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities and Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Activities -->
                    <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-2 overflow-auto max-h-[400px]">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold">Recent Activities</h2>
                            <a href="#" class="text-blue-600 text-sm">View All</a>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <i class="fas fa-bus text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">New bus added (D-102)</p>
                                    <p class="text-sm text-gray-500">2 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="bg-green-100 p-2 rounded-full">
                                    <i class="fas fa-user text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">New driver registered (John Doe)</p>
                                    <p class="text-sm text-gray-500">5 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="bg-purple-100 p-2 rounded-full">
                                    <i class="fas fa-route text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">New transport route created</p>
                                    <p class="text-sm text-gray-500">1 day ago</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="/diu/public/admin/buses/add" class="bg-blue-50 p-4 rounded-lg text-center hover:bg-blue-100 transition-colors">
                                <i class="fas fa-bus text-blue-600 text-2xl mb-2"></i>
                                <p class="font-medium">Add Bus</p>
                            </a>
                            <a href="/diu/public/admin/transports" class="bg-green-50 p-4 rounded-lg text-center hover:bg-green-100 transition-colors">
                                <i class="fas fa-route text-green-600 text-2xl mb-2"></i>
                                <p class="font-medium">Manage Routes</p>
                            </a>
                            <a href="/diu/public/admin/users" class="bg-purple-50 p-4 rounded-lg text-center hover:bg-purple-100 transition-colors">
                                <i class="fas fa-user-plus text-purple-600 text-2xl mb-2"></i>
                                <p class="font-medium">Add User</p>
                            </a>
                            <a href="#" class="bg-yellow-50 p-4 rounded-lg text-center hover:bg-yellow-100 transition-colors">
                                <i class="fas fa-file-alt text-yellow-600 text-2xl mb-2"></i>
                                <p class="font-medium">Generate Report</p>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Interactive sidebar toggle & active menu highlight
        document.addEventListener('DOMContentLoaded', function () {
            const toggleSidebar = document.getElementById('toggleSidebar');
            const sidebar = document.querySelector('.sidebar');

            if (toggleSidebar && sidebar) {
                toggleSidebar.addEventListener('click', () => {
                    sidebar.classList.toggle('sidebar-collapsed');
                });
            }

            // Highlight active nav link based on current URL path
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('nav a');

            navLinks.forEach(link => {
                // Exact or partial match for active link
                if (currentPath === link.getAttribute('href') || currentPath.startsWith(link.getAttribute('href'))) {
                    link.classList.add('active-nav');
                }
            });
        });
    </script>
</body>
</html>
