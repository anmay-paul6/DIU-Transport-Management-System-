<?php
require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/Bus.php';
require_once __DIR__ . '/../models/Transport.php';
require_once __DIR__ . '/../models/Ticket.php';
require_once __DIR__ . '/../models/Seat.php';

class StudentController
{
    private $studentModel;
    private $busModel;
    private $transportModel;
    private $ticketModel;
    private $seatModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->studentModel = new Student($this->db);
        $this->busModel = new Bus($this->db);
        $this->transportModel = new Transport($this->db);
        $this->ticketModel = new Ticket($this->db);
        $this->seatModel = new Seat($this->db);
    }

    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }



    
    // Student login
    public function login()
    {
        $this->startSession();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $student = $this->studentModel->findByEmail($email);

            if ($student && password_verify($password, $student['password'])) {
                $_SESSION['student_id'] = $student['id'];
                header('Location: /diu/public/student/index');
                exit;
            }
            $error = 'Invalid email or password';
        }
        require __DIR__ . '/../views/student/login.php';
    }



    
    // Student signup
    public function signup()
    {
        $this->startSession();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $student_id = trim($_POST['student_id'] ?? '');
            $batch = trim($_POST['batch'] ?? '');

            if ($name && $email && $password && $student_id && $batch) {
                if ($this->studentModel->findByEmail($email)) {
                    $error = 'Email already registered.';
                } else {
                    $hashed = password_hash($password, PASSWORD_BCRYPT);
                    $this->studentModel->create($name, $email, $hashed, $student_id, $batch);
                    header('Location: /diu/public/student/login');
                    exit;
                }
            } else {
                $error = 'All fields are required.';
            }
        }
        require __DIR__ . '/../views/student/signup.php';
    }

    // Show list of buses
   public function index()
{
    $this->startSession();
    if (empty($_SESSION['student_id'])) {
        header('Location: /diu/public/student/login');
        exit;
    }

    $student_id = $_SESSION['student_id'];
    $student = $this->studentModel->findById($student_id);
    $buses = $this->busModel->getAll();
    $tickets = $this->ticketModel->getTicketsByStudent($student_id);

    // Add seat and booked info
    foreach ($buses as &$bus) {
        $bus_id = $bus['id'];
        $bus['seats'] = $this->seatModel->getSeatsByBus($bus_id);
        $bus['booked_seats'] = $this->ticketModel->getBookedSeatsByBus($bus_id);
    }
    unset($bus);

    require __DIR__ . '/../views/student/index.php'; // main dashboard view
}



    // View and book seats for a specific bus
    public function viewBusSeats($bus_id)
    {
        $this->startSession();
        if (empty($_SESSION['student_id'])) {
            header('Location: /diu/public/student/login');
            exit;
        }

        $bus = $this->busModel->findById($bus_id);
        if (!$bus) {
            header('Location: /diu/public/student/index');
            exit;
        }

        $seats = $this->seatModel->getSeatsByBus($bus_id);
        $bookedSeats = $this->ticketModel->getBookedSeatsByBus($bus_id);
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $seat_number = intval($_POST['seat_number'] ?? 0);
            $student_id = $_SESSION['student_id'];

            if ($seat_number > 0) {
                if (in_array($seat_number, $bookedSeats)) {
                    $error = "Seat $seat_number is already booked.";
                } else {
                    $booked = $this->ticketModel->bookSeat($student_id, $bus_id, $seat_number);
                    if ($booked) {
                        $success = "Seat $seat_number booked successfully!";
                        $bookedSeats[] = $seat_number;
                    } else {
                        $error = "Failed to book the seat. Please try again.";
                    }
                }
            } else {
                $error = "Please select a valid seat number.";
            }
        }

        require __DIR__ . '/../views/student/bus_seats.php'; // View with booking form
    }

    public function schedule()
    {
        $this->startSession();
        if (empty($_SESSION['student_id'])) {
            header('Location: /diu/public/student/login');
            exit;
        }

        $student_id = $_SESSION['student_id'];
        $transports = $this->transportModel->getStudentSchedule($student_id);
        require __DIR__ . '/../views/student/schedule.php';
    }

    public function tracking()
    {
        $this->startSession();
        if (empty($_SESSION['student_id'])) {
            header('Location: /diu/public/student/login');
            exit;
        }

        $student_id = $_SESSION['student_id'];
        $assigned = $this->transportModel->getStudentSchedule($student_id);
        $currentBus = !empty($assigned) ? $assigned[0] : null;
        require __DIR__ . '/../views/student/tracking.php';
    }

    public function profile()
    {
        $this->startSession();
        if (empty($_SESSION['student_id'])) {
            header('Location: /diu/public/student/login');
            exit;
        }

        $student_id = $_SESSION['student_id'];
        $student = $this->studentModel->findById($student_id);
        require __DIR__ . '/../views/student/profile.php';
    }

    public function logout()
    {
        $this->startSession();
        session_destroy();
        header('Location: /diu/public/student/login');
        exit;
    }
}
