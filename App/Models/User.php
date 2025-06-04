<?php

namespace App\Models;

use PDO;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $passwordHash;
    private  $phone;
    private string $role;

    public function __construct(int $id, string $name, string $email, string $passwordHash,  $phone, string $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->phone = $phone;
        $this->role = $role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getRole(): string
    {
        return $this->role;
    }


    public static function create(PDO $pdo, string $name, string $email, string $password,  $phone, string $role = "patient"): ?self
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, email, password,phone, role) VALUES (:name, :email, :password, :phone,:role)";
        $stmt = $pdo->prepare($query);

        $created = $stmt->execute([
            'name'     => $name,
            'email'    => $email,
            'password' => $passwordHash,
            'phone' => $phone,
            'role'     => $role
        ]);

        if ($created) {
            $id = $pdo->lastInsertId();
            $_SESSION['user'] = [
                'name' => $name,
                'email' => $email
            ];
            return new self($id, $name, $email, $passwordHash, $phone, $role);
        }

        return null;
    }
    public static function login(PDO $pdo, string $email, string $password): ?self
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'name' => $user['name'],
                'email' => $email,
                'role' => $user['role']
            ];
            return new self($user['id'], $user['name'], $user['email'], $user['password'], $user['phone'], $user['role']);
        }

        return null;
    }

    public static function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();
    }
}
