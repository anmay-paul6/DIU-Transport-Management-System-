<?php
// C:\xampp\htdocs\diu\app\models\Transport.php

class Transport
{
    private $db;
    private $table = 'transports';

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Get a transport record by ID
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all transport records (simple)
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all transport records with joined details (student/bus info)
    public function getAllDetailed()
    {
        $sql = "SELECT t.*, 
                       s.name AS student_name, 
                       b.bus_number, 
                       b.route
                FROM {$this->table} t
                LEFT JOIN students s ON t.student_id = s.id
                LEFT JOIN buses b ON t.bus_id = b.id
                ORDER BY t.id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new transport record
    public function create($student_id, $bus_id)
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (student_id, bus_id) VALUES (?, ?)");
        $stmt->execute([$student_id, $bus_id]);
        return $this->db->lastInsertId();
    }

    // Delete a transport record
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Count all transport records
    public function countAll()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }
    public function getStudentSchedule($student_id)
{
    $sql = "SELECT t.*, b.bus_number, b.route
            FROM {$this->table} t
            LEFT JOIN buses b ON t.bus_id = b.id
            WHERE t.student_id = ?
            ORDER BY t.id DESC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$student_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function countByBusId($bus_id)
{
    $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM transports WHERE bus_id = ?");
    $stmt->execute([$bus_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'] ?? 0;
}



}
