<?php

namespace App\Controllers;

use App\Models\Major;
use App\Core\Validator;
use App\Core\Message;
use PDOException;



class MajorControl
{
    public static function handle($pdo)
    {

        $action = $_GET['action'] ?? null;

        switch ($action) {
            case 'major-store':
                $validator = new Validator();
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $name = trim((string) $_POST['name']);
                    $description = trim((string) $_POST['description']);
                    $image = $_FILES['image'];

                    $validator->valName($name);
                    if (!$validator->passes()) {
                        $errors = $validator->getErrors();
                        foreach ($errors as $error) {
                            Message::set($error, 'danger');
                        }
                        header("Location: dashboard.php?page=Create-Major");
                        exit;
                    }

                    try {
                        $major = Major::create($pdo, $name, $description, $image);

                        if ($major) {
                            Message::set("✅ تم انشاء تخصص جديد", 'success');
                            header("Location: dashboard.php?page=majors");
                            exit;
                        } else {
                            Message::set("❌ قد يكون التخصص موجود بالفعل", 'danger');
                            header("Location: dashboard.php?page=Create-Major");
                            exit;
                        }
                    } catch (PDOException $e) {
                        Message::set("❌ قد يكون التخصص موجود بالفعل", 'danger');
                        header("Location: dashboard.php?page=Create-Major");
                        exit;
                    }
                }
                break;
            case 'major-edit':
                $validator = new Validator();
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $id = (int) $_POST['id'];
                    $name = trim((string) $_POST['name']);
                    $description = trim((string) $_POST['description']);
                    $image = $_FILES['image'];

                    $validator->valName($name);
                    if (!$validator->passes()) {
                        $errors = $validator->getErrors();
                        foreach ($errors as $error) {
                            Message::set($error, 'danger');
                        }
                        header("Location: dashboard.php?page=Edit-Major");
                        exit;
                    }
                    $success = Major::update($pdo,  $id,  $name, $description, $image);

                    if ($success) {
                        Message::set("✅ تم تحديث التخصص بنجاح", 'success');
                        header("Location: dashboard.php?page=majors");
                        exit;
                    } else {
                        Message::set("❌ حدث خطأ اثنا التحديث", 'danger');
                        header("Location: dashboard.php?page=Edit-Major");
                        exit;
                    }
                }
                break;

            case 'major-delete':
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $id = (int) $_GET['id'];
                    $major = Major::getById($pdo, $id);

                    if (!$major) {
                        Message::set("❌ التخصص غير موجود ", 'danger');
                        header("Location: dashboard.php?page=majors");
                        exit;
                    }

                    $success = Major::delete($pdo, (int)$id);

                    if ($success) {
                        Message::set("✅ تم حذف التخصص بنجاح", 'success');
                        header("Location: dashboard.php?page=majors");
                        exit;
                    } else {
                        Message::set("❌ حدث خطأ اثنا الحذف", 'danger');
                        header("Location: dashboard.php?page=majors");
                        exit;
                    }
                }
                break;
        }
    }
}
MajorControl::handle($pdo);
