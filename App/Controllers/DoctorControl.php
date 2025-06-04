<?php

namespace App\Controllers;

use App\Models\Doctor;
use App\Core\Validator;
use App\Core\Message;
use PDOException;



class DoctorControl
{
    public static function handle($pdo)
    {

        $action = $_GET['action'] ?? null;

        switch ($action) {
            case 'doctor-store':
                $validator = new Validator();
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $name = trim((string) $_POST['name']);
                    $phone = trim($_POST['phone']);
                    $consultation_fee = trim((float) $_POST['consultation_fee']);
                    $experience_years = trim((int) $_POST['experience_years']);
                    $major_id = trim((int) $_POST['Major_id']);
                    $image = $_FILES['image'];

                    $validator->valName($name);
                    $validator->valPhone($phone);
                    if (!$validator->passes()) {
                        $errors = $validator->getErrors();
                        foreach ($errors as $error) {
                            Message::set($error, 'danger');
                        }
                        header("Location: dashboard.php?page=Create-Doctor");
                        exit;
                    }
                    $doctor = Doctor::create($pdo, $name,$phone,$image,  $consultation_fee, $major_id, $experience_years);

                    if ($doctor) {
                        Message::set("✅ تم انشاء دكتور جديد", 'success');
                        header("Location: dashboard.php?page=doctors");
                        exit;
                    } else {
                        Message::set("❌ فشل", 'danger');
                        header("Location: dashboard.php?page=Create-Doctor");
                        exit;
                    }
                }
                break;
            case 'doctor-edit':
                $validator = new Validator();
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $id = (int) $_POST['id'];
                    $name = trim((string) $_POST['name']);
                    $phone = trim($_POST['phone']);
                    $consultation_fee = trim((float) $_POST['consultation_fee']);
                    $experience_years = trim((int) $_POST['experience_years']);
                    $major_id = trim((int) $_POST['major_id']);
                    $image = $_FILES['image'];

                    $validator->valName($name);
                    $validator->valPhone($phone);
                    if (!$validator->passes()) {
                        $errors = $validator->getErrors();
                        foreach ($errors as $error) {
                            Message::set($error, 'danger');
                        }
                        header("Location: dashboard.php?page=Edit-doctor");
                        exit;
                    }
                    $success = doctor::update($pdo, $id,  $name,  $phone, $image,  $consultation_fee,  $major_id,  $experience_years);

                    if ($success) {
                        Message::set("✅ تم تحديث بيانات الدكتور بنجاح", 'success');
                        header("Location: dashboard.php?page=doctors");
                        exit;
                    } else {
                        Message::set("❌ حدث خطأ اثنا التحديث بيانات الدكتور", 'danger');
                        header("Location: dashboard.php?page=Edit-doctor");
                        exit;
                    }
                }
                break;

            case 'delete-doctor':
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $id = (int) $_GET['id'];
                    $doctor = Doctor::getById($pdo, $id);

                    if (!$doctor) {
                        Message::set("❌ الدكتور غير موجود ", 'danger');
                        header("Location: dashboard.php?page=doctors");
                        exit;
                    }

                    $success = Doctor::delete($pdo, (int)$id);

                    if ($success) {
                        Message::set("✅ تم حذف الدكتور بنجاح", 'success');
                        header("Location: dashboard.php?page=doctors");
                        exit;
                    } else {
                        Message::set("❌ حدث خطأ اثنا الحذف", 'danger');
                        header("Location: dashboard.php?page=doctors");
                        exit;
                    }
                }
                break;
        }
    }
}
DoctorControl::handle($pdo);
