<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Validator;
use App\Core\Message;
use PDOException;


if ($_SERVER['REQUEST_METHOD'] === "POST") {
     
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $role     = trim($_POST['role'] ?? 'patient');

    $validator = Validator::validateRegister($name, $email, $password);

    if (!$validator->passes()) {
        $errors = $validator->getErrors();
        foreach ($errors as $error) {
            Message::set($error, 'danger');
        }
        header("Location: index.php?page=register");
        exit;
    }
    try {
        $user = User::create($pdo, $name, $email, $password,$phone, $role);

        if ($user) {
            Message::set("✅ تم التسجيل بنجاح", 'success');
            if ($user->getRole() === "admin") {
                header("Location: dashboard.php?page=dashboard");
                exit;
            } else {
                header("Location: index.php?page=index");
                exit;
            }
        }
    } catch (PDOException $e) {
        Message::set("❌ البريد الإلكتروني مسجل مسبقاً، الرجاء استخدام بريد آخر أو تسجيل الدخول", 'danger');
    }


    Message::set("❌ فشل في التسجيل. ربما البريد مستخدم بالفعل", 'danger');
    header("Location: index.php?page=register");
    exit;
}
