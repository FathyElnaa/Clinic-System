<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../App/config/database.php";
$maintenance = false; // غيرها إلى true لتفعيل وضع الصيانة




use App\Core\Database;

$pdo = Database::getInstance($config)->getconnection();


/*  clinic Router  */
$page = $_GET['page'] ?? 'index';

include '../App/Views/clinic/layouts/header.php';

switch ($page) {
    case 'index':
        require '../App/Views/clinic/index.php';
        break;
    case 'login':
        require '../App/Views/clinic/login.php';
        break;
    case 'register':
        require '../App/Views/clinic/register.php';
        break;
    case 'majors':
        require '../App/Views/clinic/majors.php';
        break;
    case 'Doctors-index':
        require '../App/Views/clinic/indexdoc.php';
        break;
    case 'Doctor':
        require '../App/Views/clinic/doctor.php';
        break;
    case 'Contact':
        require '../App/Views/clinic/contact.php';
        break;
    case "sign-up":
        require("../App/Controllers/registercontrol.php");
        break;
    case "sign-in":
        require("../App/Controllers/logincontrol.php");
        break;
    case "logout":
        require("../App/Controllers/logoutcontrol.php");
        break;
    default:
        require '../App/Views/404.php';
        break;
}

include '../App/Views/clinic/layouts/footer.php';
