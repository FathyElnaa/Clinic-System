<?php

namespace App\Models;

use PDO;

class Appointment
{
    private int $id;
    private int $patient_id;
    private int $doctor_id;
    private string $appointment_date;
    private string $status;

    public function __construct(int $id, int $patient_id, int $doctor_id, string $appointment_date, string $status = 'pending')
    {
        $this->id = $id;
        $this->patient_id = $patient_id;
        $this->doctor_id = $doctor_id;
        $this->appointment_date = $appointment_date;
        $this->status = $status;
    }

    public static function create(PDO $pdo, int $patient_id, int $doctor_id, string $appointment_date): ?self
    {
        $stmt = $pdo->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_date) 
        VALUES (:patient_id, :doctor_id, :appointment_date)");

        $created = $stmt->execute([
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
            'appointment_date' => $appointment_date
        ]);

        if ($created) {
            $id = $pdo->lastInsertId();
            return new self($id, $patient_id, $doctor_id, $appointment_date);
        }

        return null;
    }

    public static function getDoctorAppointments(PDO $pdo, int $doctor_id): array
    {
        $stmt = $pdo->prepare("SELECT * FROM appointments WHERE doctor_id = :doctor_id ORDER BY appointment_date DESC");
        $stmt->execute(['doctor_id' => $doctor_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPatientAppointments(PDO $pdo, int $patient_id): array
    {
        $stmt = $pdo->prepare("
        SELECT a.*, d.name as doctor_name, m.name as major_name 
        FROM appointments a
        JOIN doctors d ON a.doctor_id = d.id
        JOIN majors m ON d.major_id = m.id
        WHERE a.patient_id = :patient_id 
        ORDER BY a.appointment_date DESC
    ");
        $stmt->execute(['patient_id' => $patient_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllAppointments(PDO $pdo): array
    {
        $stmt = $pdo->prepare("
        SELECT a.*, u.name as patient_name, d.name as doctor_name, m.name as major_name 
        FROM appointments a
        JOIN users u ON a.patient_id = u.id
        JOIN doctors d ON a.doctor_id = d.id
        JOIN majors m ON d.major_id = m.id
        ORDER BY a.appointment_date DESC
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function countAll(PDO $pdo): int
    {
        $stmt = $pdo->query("SELECT COUNT(*) FROM appointments");
        return (int)$stmt->fetchColumn();
    }

    public static function getRecentAppointments(PDO $pdo, int $limit = 10): array
    {
        $stmt = $pdo->prepare("SELECT * FROM appointments ORDER BY appointment_date DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateStatus(PDO $pdo, int $id, string $status): bool
    {
        $stmt = $pdo->prepare("UPDATE appointments SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }
}
