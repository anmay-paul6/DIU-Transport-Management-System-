<?php
class Ticket
{
    private $db;
    private $table = 'tickets';

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Check if seat is booked
    public function isSeatBooked($bus_id, $seat_number)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM tickets WHERE bus_id = ? AND seat_number = ?");
        $stmt->execute([$bus_id, $seat_number]);
        return $stmt->fetchColumn() > 0;
    }

    // Book a seat (create ticket)
    public function bookSeat($student_id, $bus_id, $seat_number)
    {
        // Prevent double booking by checking unique key
        $stmt = $this->db->prepare("INSERT INTO tickets (student_id, bus_id, seat_number) VALUES (?, ?, ?)");
        return $stmt->execute([$student_id, $bus_id, $seat_number]);
    }

    // Get all tickets booked by a student
    public function getTicketsByStudent($student_id)
    {
        $stmt = $this->db->prepare("SELECT t.*, b.bus_number, b.route FROM tickets t JOIN buses b ON t.bus_id = b.id WHERE t.student_id = ?");
        $stmt->execute([$student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get booked seats for a bus
    public function getBookedSeatsByBus($bus_id)
    {
        $stmt = $this->db->prepare("SELECT seat_number FROM tickets WHERE bus_id = ?");
        $stmt->execute([$bus_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
