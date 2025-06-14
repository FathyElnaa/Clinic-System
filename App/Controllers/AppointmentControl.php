<?php

namespace App\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Core\Validator;
use App\Core\Message;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $appointment_date = trim($_POST['appointment_date'] ?? '');
    $doctor_id = (int)($_POST['doctor_id'] ?? 0);

    $validator = new Validator();
    $validator->valName($name);
    $validator->valEmail($email);
    $validator->valPhone($phone);


    if (!$validator->passes()) {
        $errors = $validator->getErrors();
        foreach ($errors as $error) {
            Message::set($error, 'danger');
        }
        header("Location: index.php?page=Doctor&id=" . $doctor_id);
        exit;
    }

    $user = User::getByEmail($pdo, $email);
    
    if (!$user) {
        $password = bin2hex(random_bytes(4)); 
        $user = User::create($pdo, $name, $email, $password, $phone, 'patient');
        
        if (!$user) {
            Message::set("❌ Failed to create user account", 'danger');
            header("Location: index.php?page=Doctor&id=" . $doctor_id);
            exit;
        }
    }

    $appointment = Appointment::create($pdo, $user->getId(), $doctor_id, $appointment_date);

    if ($appointment) {
        Message::set("✅ Appointment booked successfully!", 'success');
        header("Location: index.php?page=index");
        exit;
    } else {
        Message::set("❌ Failed to book appointment", 'danger');
        header("Location: index.php?page=Doctor&id=" . $doctor_id);
        exit;
    }
}