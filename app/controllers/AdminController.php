<?php
// C:\xampp\htdocs\diu\app\controllers\AdminController.php

require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Bus.php';
require_once __DIR__ . '/../models/Transport.php';
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/Driver.php';
require_once __DIR__ . '/../models/ScheduleModel.php';
require_once __DIR__ . '/../models/Seat.php';

class AdminController
{
    private $adminModel;
    private $busModel;
    private $transportModel;
    private $db;
    private $studentModel;
    private $driverModel;
    private $scheduleModel;
    private $seatModel;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->adminModel = new Admin($this->db);
        $this->busModel = new Bus($this->db);
        $this->transportModel = new Transport($this->db);
        $this->studentModel = new Student($this->db);
        $this->driverModel = new Driver($this->db);
        $this->scheduleModel = new ScheduleModel($this->db);
        $this->seatModel = new Seat($this->db);
    }

    // Start session safely
    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Admin Login (GET + POST)
    public function login()
    {
        $this->startSession();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $admin = $this->adminModel->findByEmail($email);

            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_name'] = $admin['name'] ?? 'Admin';
                header('Location: /diu/public/admin/dashboard');
                exit;
            }
            $error = 'Invalid email or password';
        }
        require __DIR__ . '/../views/admin/login.php';
    }

    // Admin Logout
    public function logout()
    {
        $this->startSession();
        session_destroy();
        header('Location: /diu/public/admin/login');
        exit;
    }

    // Admin Dashboard
    public function dashboard()
    {
        $this->startSession();
        if (empty($_SESSION['admin_id'])) {
            header('Location: /diu/public/admin/login');
            exit;
        }

        $total_students = $this->studentModel->countAll();
        $total_drivers = $this->driverModel->countAll();
        $total_buses = $this->busModel->countAll();
        $total_users = $total_students + $total_drivers + $this->adminModel->countAll();

        $data = [
            'total_users' => $total_users,
            'total_students' => $total_students,
            'total_drivers' => $total_drivers,
            'total_buses' => $total_buses,
        ];

        extract($data);

        require __DIR__ . '/../views/admin/dashboard.php';
    }

    // Show list of seats and add seat form
    public function busSeats($bus_id)
    {
        $this->startSession();
        if (empty($_SESSION['admin_id'])) {
            header('Location: /diu/public/admin/login');
            exit;
        }

        $bus = $this->busModel->findById($bus_id);
        if (!$bus) {
            header('Location: /diu/public/admin/buses');
            exit;
        }

        $seats = $this->seatModel->getSeatsByBus($bus_id);

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $seat_number = intval($_POST['seat_number'] ?? 0);
            if ($seat_number > 0) {
                $added = $this->seatModel->addSeat($bus_id, $seat_number);
                if ($added) {
                    header("Location: /diu/public/admin/bus-seats/$bus_id");
                    exit;
                } else {
                    $error = "Seat number already exists for this bus.";
                }
            } else {
                $error = "Please enter a valid seat number.";
            }
        }

        require __DIR__ . '/../views/admin/bus_seats.php';
    }

    // Delete seat
    public function deleteSeat($bus_id, $seat_id)
    {
        $this->startSession();
        if (empty($_SESSION['admin_id'])) {
            header('Location: /diu/public/admin/login');
            exit;
        }

        $this->seatModel->deleteSeat($seat_id);
        header("Location: /diu/public/admin/bus-seats/$bus_id");
        exit;
    }

    // List all buses
    public function buses()
    {
        $this->startSession();
        if (empty($_SESSION['admin_id'])) {
            header('Location: /diu/public/admin/login');
            exit;
        }
        $buses = $this->busModel->getAll();
        require __DIR__ . '/../views/admin/buses.php';
    }

    // Show Add Bus form and process POST
    public function addBus()
    {
        $this->startSession();
        if (empty($_SESSION['admin_id'])) {
            header('Location: /diu/public/admin/login');
            exit;
        }
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bus_number = trim($_POST['bus_number'] ?? '');
            $route = trim($_POST['route'] ?? '');
            $driver_id = $_POST['driver_id'] ?? null;

            if ($bus_number && $route) {
                $this->busModel->create($bus_number, $route, $driver_id);
                header('Location: /diu/public/admin/buses');
                exit;
            } else {
                $error = 'Bus number and route are required.';
            }
        }
        $drivers = $this->driverModel->getAll();
        require __DIR__ . '/../views/admin/buses_add.php';
    }

    // Edit Bus
    public function editBus($id)
    {
        $this->startSession();
        if (empty($_SESSION['admin_id'])) {
            header('Location: /diu/public/admin/login');
            exit;
        }

        $bus = $this->busModel->findById($id);
        if (!$bus) {
            header('Location: /diu/public/admin/buses');
            exit;
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bus_number = trim($_POST['bus_number'] ?? '');
            $route = trim($_POST['route'] ?? '');
            $driver_id = $_POST['driver_id'] ?? null;

            if ($bus_number && $route) {
                $this->busModel->update($id, $bus_number, $route, $driver_id);
                header('Location: /diu/public/admin/buses');
                exit;
            } else {
                $error = 'Bus number and route are required.';
            }
        }
        $drivers = $this->driverModel->getAll();
        require __DIR__ . '/../views/admin/buses_edit.php';
    }

    // Manage Bus Schedules
    public function manageSchedules($bus_id)
    {
        $this->startSession();
        if (empty($_SESSION['admin_id'])) {
            header('Location: /diu/public/admin/login');
            exit;
        }

        $bus = $this->busModel->findById($bus_id);
        if (!$bus) {
            header('Location: /diu/public/admin/buses');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $time = $_POST['departure_time'] ?? '';
            if ($time) {
                $this->scheduleModel->create($bus_id, $time);
            }
        }

        $schedules = $this->scheduleModel->getByBus($bus_id);

        require __DIR__ . '/../views/admin/bus_schedules.php';
    }

    // Delete schedule entry
    public function deleteSchedule($schedule_id, $bus_id)
    {
        $this->startSession();
        if (empty($_SESSION['admin_id'])) {
            header('Location: /diu/public/admin/login');
            exit;
        }

        $this->scheduleModel->delete($schedule_id);
        header("Location: /diu/public/admin/buses/schedules/$bus_id");
        exit;
    }

    // Transports
    public function transports()
    {
        $this->startSession();
        if (empty($_SESSION['admin_id'])) {
            header('Location: /diu/public/admin/login');
            exit;
        }
        $transports = $this->transportModel->getAllDetailed();
        require __DIR__ . '/../views/admin/transports.php';
    }

    // Delete a transport record
    public function deleteTransport($id)
    {
        $this->startSession();
        if (empty($_SESSION['admin_id'])) {
            header('Location: /diu/public/admin/login');
            exit;
        }
        $this->transportModel->delete($id);
        header('Location: /diu/public/admin/transports');
        exit;
    }

    // Users (list students and drivers)
    public function users()
    {
        $this->startSession();
        if (empty($_SESSION['admin_id'])) {
            header('Location: /diu/public/admin/login');
            exit;
        }
        $students = $this->studentModel->getAll();
        $drivers = $this->driverModel->getAll();
        require __DIR__ . '/../views/admin/users.php';
    }

    // Admin Signup (optional)
    public function signup()
    {
        $this->startSession();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if (!$name || !$email || !$password || !$confirm_password) {
                $error = 'All fields are required.';
            } elseif ($password !== $confirm_password) {
                $error = 'Passwords do not match.';
            } elseif ($this->adminModel->findByEmail($email)) {
                $error = 'Email already exists.';
            } else {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $this->adminModel->create($name, $email, $hashed);
                header('Location: /diu/public/admin/login');
                exit;
            }
        }
        require __DIR__ . '/../views/admin/signup.php';
    }
}
