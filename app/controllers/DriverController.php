<?php
require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../models/Driver.php';
require_once __DIR__ . '/../models/Bus.php';
require_once __DIR__ . '/../models/Transport.php';

class DriverController
{
    private $db;
    private $driverModel;
    private $busModel;
    private $transportModel;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->driverModel = new Driver($this->db);
        $this->busModel = new Bus($this->db);
        $this->transportModel = new Transport($this->db);
    }

    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    // Driver login
    public function login()
    {
        $this->startSession();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $driver = $this->driverModel->findByEmail($email);

            if ($driver && password_verify($password, $driver['password'])) {
                $_SESSION['driver_id'] = $driver['id'];
                header('Location: /diu/public/driver/index');
                exit;
            }
            $error = 'Invalid email or password';
        }
        require __DIR__ . '/../views/driver/login.php';
    }

    // Driver signup
    public function signup()
    {
        $this->startSession();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $license_no = trim($_POST['license_no'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            if ($name && $email && $password && $license_no && $phone) {
                if ($this->driverModel->findByEmail($email)) {
                    $error = 'Email already registered.';
                } else {
                    $hashed = password_hash($password, PASSWORD_BCRYPT);
                    $this->driverModel->create($name, $email, $hashed, $license_no, $phone);
                    header('Location: /diu/public/driver/login');
                    exit;
                }
            } else {
                $error = 'All fields are required.';
            }
        }
        require __DIR__ . '/../views/driver/signup.php';
    }

    // Driver logout
    public function logout()
    {
        $this->startSession();
        session_destroy();
        header('Location: /diu/public/driver/login');
        exit;
    }

    // Driver profile
    public function profile()
    {
        $this->startSession();
        if (empty($_SESSION['driver_id'])) {
            header('Location: /diu/public/driver/login');
            exit;
        }
        $driver_id = $_SESSION['driver_id'];
        $driver = $this->driverModel->findById($driver_id);
        require __DIR__ . '/../views/driver/profile.php';
    }

    // Driver dashboard
    public function index()
    {
        $this->startSession();
        if (empty($_SESSION['driver_id'])) {
            header('Location: /diu/public/driver/login');
            exit;
        }
        $driver_id = $_SESSION['driver_id'];

        $driver = $this->driverModel->findById($driver_id); // Fetch driver data
        $bus = $this->busModel->getByDriverId($driver_id);

        $driver_name = $driver['name'] ?? 'Driver';
        $bus_number = $bus['bus_number'] ?? 'Not assigned';
        $route = $bus['route'] ?? 'Not assigned';
        $today_trips = 0;
        if ($bus && isset($bus['id'])) {
            $today_trips = $this->transportModel->countByBusId($bus['id']);
        }

        $data = [
            'driver_name' => $driver_name,
            'bus_number' => $bus_number,
            'route' => $route,
            'today_trips' => $today_trips,
        ];
        extract($data);
        require __DIR__ . '/../views/driver/index.php';
    }
}
