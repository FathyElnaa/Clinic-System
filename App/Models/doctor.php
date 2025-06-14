<?php

namespace App\Models;

use PDO;

use App\Traits\FilesUpload;


class Doctor
{
    use FilesUpload;

    private int $id;
    private string $name;
    private  $phone;
    private int $major_id;
    private  $image;
    private float $consultation_fee;
    private int $experience_years;
    private ?string $major_name = null;



    public function __construct(int $id, string $name, $phone, $image, float $consultation_fee, int $major_id, int $experience_years, ?string $major_name = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->image = $image;
        $this->major_id = $major_id;
        $this->consultation_fee = $consultation_fee;
        $this->experience_years = $experience_years;
        $this->major_name = $major_name;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getMajorId()
    {
        return $this->major_id;
    }
    public function getConsultation_fee()
    {
        return $this->consultation_fee;
    }
    public function getExperience_years()
    {
        return $this->experience_years;
    }
    public function getMajorName(): ?string
    {
        return $this->major_name;
    }


    public static function create(PDO $pdo, string $name, int $phone, $image, float $consultation_fee, int $major_id, int $experience_years): ?Doctor
    {
        $imageName = null;
        if ($image) {
            $imageName = self::uploadFile($image);
        }
        $query = "INSERT INTO doctors (name,consultation_fee,experience_years,image,phone,major_id)
         VALUES (:name,:consultation_fee,:experience_years,:image,:phone,:major_id)";
        $stmt = $pdo->prepare($query);
        $success = $stmt->execute([
            ':name' => $name,
            ':consultation_fee' => $consultation_fee,
            ':experience_years' => $experience_years,
            ':image' => $imageName,
            ':phone' => $phone,
            ':major_id' => $major_id
        ]);
        if ($success) {
            $id = (int)$pdo->lastInsertId();
            return new self($id,  $name,  $phone, $image,  $consultation_fee, $major_id, $experience_years);
        }

        return null;
    }

    public static function getAll(PDO $pdo): array
    {
        $query = "SELECT d.*, m.name AS major_name 
              FROM doctors d 
               JOIN majors m ON d.major_id = m.id";
        $stmt = $pdo->query($query);
        $doctors = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $doctors[] = new self(
                $row['id'],
                $row['name'],
                $row['phone'],
                $row['image'],
                $row['consultation_fee'],
                $row['major_id'],
                $row['experience_years'],
                $row['major_name']

            );
        }

        return $doctors;
    }

    public static function getById(PDO $pdo, $id): ?Doctor
    {
        $query = " SELECT d.*, m.name AS major_name 
        FROM doctors d JOIN majors m 
        ON d.major_id = m.id
        WHERE d.id = :id LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }
        return new self(
            $row['id'],
            $row['name'],
            $row['phone'],
            $row['image'],
            $row['consultation_fee'],
            $row['major_id'],
            $row['experience_years'],
            $row['major_name']

        );
    }
    public static function getByMajorId(PDO $pdo, int $major_id): array
    {
        $query = "SELECT d.*, m.name AS major_name 
        FROM doctors d JOIN majors m 
        ON d.major_id = m.id
        WHERE d.major_id = :major_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':major_id' => $major_id]);

        $doctors = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $doctors[] = new self(
                $row['id'],
                $row['name'],
                $row['phone'],
                $row['image'],
                $row['consultation_fee'],
                $row['major_id'],
                $row['experience_years'],
                $row['major_name']
            );
        }

        return $doctors;
    }


    public static function delete(PDO $pdo, int $id): bool
    {
        $doctor = self::getById($pdo, $id);
        if (!$doctor) {
            return false;
        }

        if ($doctor->getImage()) {
            self::deleteFile($doctor->getImage());
        }

        $query = "DELETE FROM doctors WHERE id = ?";
        $stmt = $pdo->prepare($query);
        return $stmt->execute([$id]);
    }

    public static function update(PDO $pdo, int $id, string $name, int $phone, $image, float $consultation_fee, int $major_id, int $experience_years)
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
        $query = "UPDATE doctors SET name = :name,phone=:phone ,image = :image,consultation_fee=:consultation_fee,major_id=:major_id,experience_years=:experience_years WHERE id = :id";
        $stmt = $pdo->prepare($query);

        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':consultation_fee' => $consultation_fee,
            ':experience_years' => $experience_years,
            ':image' => $imageName,
            ':phone' => $phone,
            ':major_id' => $major_id
        ]);
    }

    public static function countAll(PDO $pdo): int
    {
        $stmt = $pdo->query("SELECT COUNT(*) FROM doctors");
        return (int)$stmt->fetchColumn();
    }

    
}
