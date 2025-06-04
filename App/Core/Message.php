<?php

namespace App\Core;

class Message
{
    public static function set(string $message, string $type = 'success'): void
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    public static function show(): void
    {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            echo '<div class="alert alert-' . $flash['type'] . ' text-center">' . $flash['message'] . '</div>';
            unset($_SESSION['flash']);
        }
    }
}
