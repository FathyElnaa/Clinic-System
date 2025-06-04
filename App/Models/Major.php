<?php

namespace App\Models;

use PDO;
use App\Traits\FilesUpload;

class Major
{
    use FilesUpload;

    private int $id;
    private string $name;
    private string $description;
    private  $image;
    private string $created_at;

    public function __construct(int $id, string $name,string $description ,  $image, string $created_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->created_at = $created_at;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNameM(): string
    {
        return $this->name;
    }
    public function getdescription(): string
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public static function create(PDO $pdo, string $name,string $description, $image = null): ?Major
    {
        $imageName = null;
        if ($image) {
            $imageName = self::uploadFile($image); 
        }

        $query = "INSERT INTO majors (name,description , image, created_at) VALUES (:name,:description ,:image, :created_at)";
        $stmt = $pdo->prepare($query);
        $created_at = date('Y-m-d H:i:s');

        $success = $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':image' => $imageName,
            ':created_at' => $created_at
        ]);

        if ($success) {
            $id = (int)$pdo->lastInsertId();
            return new self($id, $name,$description ,$imageName, $created_at);
        }

        return null;
    }

    public static function getAll(PDO $pdo): array
    {
        $query = "SELECT * FROM majors";
        $stmt = $pdo->query($query);
        $majors = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $majors[] = new self(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['image'],
                $row['created_at']
            );
        }

        return $majors;
    }

    public static function getById(PDO $pdo, int $id): ?Major
    {
        $query = "SELECT * FROM majors WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new self(
            $row['id'],
            $row['name'],
            $row['description'],
            $row['image'],
            $row['created_at']
        );
    }

    public static function update(PDO $pdo, int $id, string $name,string $description,$image = null): bool
    {
        $current = self::getById($pdo, $id);
        if (!$current) {
            return false;
        }

        $imageName = $current->getImage();
        if ($image) {
            if ($imageName) {
                self::deleteFile($imageName);
            }
            $imageName = self::uploadFile($image);
        }

        $query = "UPDATE majors SET name = :name,description=:description ,image = :image WHERE id = :id";
        $stmt = $pdo->prepare($query);

        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':description' => $description,
            ':image' => $imageName
        ]);
    }

    public static function delete(PDO $pdo, int $id): bool
    {
         $major = self::getById($pdo, $id);
        if (!$major) {
            return false;
        }

        if ($major->getImage()) {
            self::deleteFile($major->getImage());
        }

        $query = "DELETE FROM majors WHERE id = ?";
        $stmt = $pdo->prepare($query);
        return $stmt->execute([$id]);
    }
}
