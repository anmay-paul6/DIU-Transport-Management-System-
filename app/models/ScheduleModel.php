<?php
class ScheduleModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($bus_id, $departure_time)
    {
        $stmt = $this->db->prepare("INSERT INTO schedules (bus_id, departure_time) VALUES (?, ?)");
        return $stmt->execute([$bus_id, $departure_time]);
    }

    public function getByBus($bus_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM schedules WHERE bus_id = ? ORDER BY departure_time");
        $stmt->execute([$bus_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM schedules WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
