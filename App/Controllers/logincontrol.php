<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Validator;
use App\Core\Message;


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $validator = Validator::validateLogin($email, $password);

    if (!$validator->passes()) {
        $errors = $validator->getErrors();
        foreach ($errors as $error) {
            Message::set($error, 'danger');
        }
        header("Location: index.php?page=login");
        exit;
    }

    $user = User::login($pdo, $email, $password);

    if ($user) {
        Message::set("✅ تم التسجيل بنجاح", 'success');
        if ($user->getRole() === "admin") {
            header("Location: dashboard.php?page=dashboard");
            exit;
        } elseif ($user->getRole() === 'patient') {
            header("Location: index.php?page=index");
            exit;
        }
    } else {
        Message::set("❌ البريد الالكتروني غير موجود او غير مسجل مسبقا", 'danger');
        header("Location: index.php?page=login");
        exit;
    }
}
