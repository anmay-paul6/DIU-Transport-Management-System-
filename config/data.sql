-- Admins Table
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Drivers Table
CREATE TABLE drivers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    license_no VARCHAR(50),
    phone VARCHAR(20)
    -- add more fields for drivers if needed
);

-- Students Table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    student_id VARCHAR(50),
    batch VARCHAR(30)
    -- add more fields for students if needed
);

-- Buses Table
CREATE TABLE buses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    driver_id INT,
    bus_number VARCHAR(50),
    route VARCHAR(255),
    FOREIGN KEY (driver_id) REFERENCES drivers(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Transports Table
CREATE TABLE transports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    bus_id INT,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (bus_id) REFERENCES buses(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tickets Table
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    bus_id INT NOT NULL,
    seat_number INT NOT NULL,
    booked_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    UNIQUE KEY unique_seat (bus_id, seat_number),
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (bus_id) REFERENCES buses(id)
);
-- Schedules Table
CREATE TABLE schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bus_id INT NOT NULL,
    departure_time TIME NOT NULL,
    date DATE, -- Optional, if you want per-day scheduling
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (bus_id) REFERENCES buses(id) ON DELETE CASCADE
);

-- Seats Table
CREATE TABLE seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bus_id INT NOT NULL,
    seat_number INT NOT NULL,
    UNIQUE KEY unique_seat_per_bus (bus_id, seat_number),
    FOREIGN KEY (bus_id) REFERENCES buses(id) ON DELETE CASCADE
);
