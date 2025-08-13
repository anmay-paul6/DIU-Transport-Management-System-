<?php
// C:\xampp\htdocs\diu\app\models\Bus.php

class Bus
{
    private $db;
    private $table = 'buses';

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Get a single bus by its ID
     * @param int $id
     * @return array|false
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all buses
     * @return array
     */
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new bus record
     * @param string $bus_number
     * @param string $route
     * @param int|null $driver_id
     * @return bool
     */
    public function create($bus_number, $route, $driver_id = null)
    {
        if ($driver_id) {
            $stmt = $this->db->prepare("INSERT INTO {$this->table} (bus_number, route, driver_id) VALUES (?, ?, ?)");
            return $stmt->execute([$bus_number, $route, $driver_id]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO {$this->table} (bus_number, route) VALUES (?, ?)");
            return $stmt->execute([$bus_number, $route]);
        }
    }

    /**
     * Update a bus record (can update driver)
     * @param int $id
     * @param string $bus_number
     * @param string $route
     * @param int|null $driver_id
     * @return bool
     */
    public function update($id, $bus_number, $route, $driver_id = null)
    {
        if ($driver_id !== null) {
            $stmt = $this->db->prepare("UPDATE {$this->table} SET bus_number = ?, route = ?, driver_id = ? WHERE id = ?");
            return $stmt->execute([$bus_number, $route, $driver_id, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE {$this->table} SET bus_number = ?, route = ? WHERE id = ?");
            return $stmt->execute([$bus_number, $route, $id]);
        }
    }

    /**
     * Delete a bus record
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Count all buses
     * @return int
     */
    public function countAll()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    /**
     * Get all buses assigned to a specific driver
     * @param int $driver_id
     * @return array
     */
    public function getByDriverId($driver_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE driver_id = ?");
        $stmt->execute([$driver_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
