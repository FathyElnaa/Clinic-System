<?php

namespace App\Controllers;

use App\Models\User;

User::logout();
header("Location: index.php?page=login");
exit;
