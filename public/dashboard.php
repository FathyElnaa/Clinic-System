<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../App/config/database.php";





use App\Core\Database;

$pdo = Database::getInstance($config)->getconnection();


/* ---- Dashboard Router ---- */
$page = $_GET['page'] ?? 'admin-login';

include '../App/Views/dashboard-lte/layouts/nav.php';

switch ($page) {
    case 'dashboard':
        require '../App/Views/dashboard-lte/dashboard.php';
        break;
    case 'admin-login':
        require '../App/Views/dashboard-lte/login.php';
        break;
    case 'admin-register':
        require '../App/Views/dashboard-lte/register.php';
        break;
    case 'users':
        require '../App/Views/dashboard-lte/users.php';
        break;
    case 'majors':
        require '../App/Views/dashboard-lte/Majors.php';
        break;
    case 'Create-Major':
        require '../App/Views/dashboard-lte/crud_major/create-major.php';
        break;
    case 'Edit-Major':
        require '../App/Views/dashboard-lte/crud_major/edit-major.php';
        break;
    case 'Control-Major':
        require '../App/Controllers/MajorControl.php';
        break;
    case 'doctors':
        require '../App/Views/dashboard-lte/doctors.php';
        break;
    case 'Create-Doctor':
        require '../App/Views/dashboard-lte/crud_doctor/create-doctor.php';
        break;
    case 'Edit-Doctor':
        require '../App/Views/dashboard-lte/crud_doctor/edit-doctor.php';
        break;
    case 'doctor-detail':
        require '../App/Views/dashboard-lte/doctor-detail.php';
        break;
    case 'Control-Doctor':
        require '../App/Controllers/DoctorControl.php';
        break;
    case "admin-sign-up":
        require("../App/Controllers/registercontrol.php");
        break;
    case "admin-sign-in":
        require("../App/Controllers/logincontrol.php");
        break;
    case "logout":
        require("../App/Controllers/logoutcontrol.php");
        break;
    default:
        require '../App/Views/404.php';
        break;
}
