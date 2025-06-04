<?php

namespace App\Traits;

trait FilesUpload
{
    private static $upload_path = "public/uploads/";

    public static function uploadFile(array $file, array $allowedExtensions = ['jpeg', 'jpg', 'png', 'svg', 'webp'], ?string $upload_folder = null): ?string
    {
        $filename = $file['name'];
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($extension, $allowedExtensions)) {
            return null;
        }

        $newFilename = uniqid() . '.' . $extension;

        $realpath = realpath(__DIR__ . '../../../') . '/' . self::$upload_path;

        if (!file_exists($realpath)) {
            mkdir($realpath, 0755, true);
        }

        $fullpath = $upload_folder ? $realpath . $upload_folder . '/' . $newFilename : $realpath . $newFilename;

        if ($upload_folder && !file_exists($realpath . $upload_folder)) {
            mkdir($realpath . $upload_folder, 0755, true);
        }

        if (move_uploaded_file($file['tmp_name'], $fullpath)) {
            return $newFilename;
        }


        return null;
    }

    public static function deleteFile(?string $filePath): bool
    {
        if ($filePath && file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }
}
