<?php
// C:\xampp\htdocs\diu\app\models\Admin.php

class Admin
{
    private $db;
    private $table = 'admins';

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Get admin by ID
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get admin by email
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Count all admins
    public function countAll()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    // Get all admins
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new admin (returns inserted id)
    public function create($name, $email, $password)
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);
        return $this->db->lastInsertId();
    }

    // Update admin info (with or without password)
    public function update($id, $name, $email, $password = null)
    {
        if ($password) {
            $stmt = $this->db->prepare("UPDATE {$this->table} SET name = ?, email = ?, password = ? WHERE id = ?");
            return $stmt->execute([$name, $email, $password, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE {$this->table} SET name = ?, email = ? WHERE id = ?");
            return $stmt->execute([$name, $email, $id]);
        }
    }

    // Delete admin
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
