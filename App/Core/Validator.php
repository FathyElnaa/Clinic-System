<?php

namespace App\Core;

class Validator
{
    private $errors = [];

    public function valName($name)
    {
        if (empty($name)) {
            $this->errors['name'] = "Name is required";
        } elseif (strlen($name) <= 3) {
            $this->errors['name'] = "Name must be at least 3 characters";
        }
    }

    public function valEmail($email)
    {
        if (empty($email)) {
            $this->errors['email'] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format";
        }
    }

    public function valPassword($password)
    {
        if (empty($password)) {
            $this->errors['password'] = "Password is required";
        } elseif (strlen($password) <= 8) {
            $this->errors['password'] = "Password must be at least 8 characters long";
        } elseif (!preg_match("/[A-Z]/", $password)) {
            $this->errors['password'] = "Password must contain at least one uppercase letter";
        } elseif (!preg_match("/[a-z]/", $password)) {
            $this->errors['password'] = "Password must contain at least one lowercase letter";
        } elseif (!preg_match("/[0-9]/", $password)) {
            $this->errors['password'] = "Password must contain at least one number";
        }
    }

    public function valPhone($phone)
    {
        if (empty($phone)) {
            $this->errors['phone'] = "Phone is required";
        } 
         elseif (strlen($phone) <= 10) {
             $this->errors['phone'] = "Phone must be at least 10 digits";
         }
    }

    public static function validateRegister($name, $email, $password)
    {
        $validator = new self();
        $validator->valName($name);
        $validator->valEmail($email);
        $validator->valPassword($password);
        return $validator;
    }

    public static function validateLogin($email, $password)
    {
        $validator = new self();
        $validator->valEmail($email);
        if (empty($password)) {
            $validator->errors['password'] = "Password is required";
        }
        return $validator;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function passes()
    {
        return empty($this->errors);
    }
}