<?php
class Seat
{
    private $db;
    private $table = 'seats';

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Get all seats for a bus
    public function getSeatsByBus($bus_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM seats WHERE bus_id = ? ORDER BY seat_number ASC");
        $stmt->execute([$bus_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new seat for a bus (avoid duplicates)
    public function addSeat($bus_id, $seat_number)
    {
        // Check if seat already exists
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM seats WHERE bus_id = ? AND seat_number = ?");
        $stmt->execute([$bus_id, $seat_number]);
        if ($stmt->fetchColumn() > 0) {
            return false; // seat exists
        }

        // Insert new seat
        $stmt = $this->db->prepare("INSERT INTO seats (bus_id, seat_number) VALUES (?, ?)");
        return $stmt->execute([$bus_id, $seat_number]);
    }

    // Delete seat by ID
    public function deleteSeat($seat_id)
    {
        $stmt = $this->db->prepare("DELETE FROM seats WHERE id = ?");
        return $stmt->execute([$seat_id]);
    }
}
