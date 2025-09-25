<?php
require_once '../config/Database.php';

class Appointment {
    private $conn;
    private $table_name = "appointments";

    public $id;
    public $doctor_id;
    public $patient_id;
    public $appointment_date;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET doctor_id=:doctor_id, patient_id=:patient_id, appointment_date=:appointment_date, status=:status";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":doctor_id", $this->doctor_id);
        $stmt->bindParam(":patient_id", $this->patient_id);
        $stmt->bindParam(":appointment_date", $this->appointment_date);
        $stmt->bindParam(":status", $this->status);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT a.id, a.appointment_date, a.status, d.name as doctor_name, p.name as patient_name 
                  FROM " . $this->table_name . " a 
                  LEFT JOIN doctors d ON a.doctor_id = d.id 
                  LEFT JOIN patients p ON a.patient_id = p.id 
                  ORDER BY a.appointment_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->doctor_id = $row['doctor_id'];
            $this->patient_id = $row['patient_id'];
            $this->appointment_date = $row['appointment_date'];
            $this->status = $row['status'];
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET doctor_id=:doctor_id, patient_id=:patient_id, appointment_date=:appointment_date, status=:status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":doctor_id", $this->doctor_id);
        $stmt->bindParam(":patient_id", $this->patient_id);
        $stmt->bindParam(":appointment_date", $this->appointment_date);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>