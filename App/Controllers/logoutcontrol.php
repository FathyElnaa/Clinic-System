<?php

namespace App\Controllers;

use App\Models\User;

session_start();

if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
    User::logout();
    header("Location: dashboard.php?page=admin-login");
    exit;
} else {
    User::logout();
    header("Location: index.php?page=login");
    exit;
}
