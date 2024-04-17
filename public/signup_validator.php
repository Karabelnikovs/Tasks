<?php

class Validator
{
    public $email;
    public $username;
    public $password;
    public $passwordConfirmation;

    function __construct($email, $username, $password, $passwordConfirmation)
    {
        $this->email = $email;
        $this->username = trim($username);
        $this->password = $password;
        $this->passwordConfirmation = $passwordConfirmation;
    }

    public static function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }else{
            return null;
        }
    }

    public static function validateDatetime($datetimeString, $format = 'Y-m-d H:i:s')
    {
        $dateTime = DateTime::createFromFormat($format, $datetimeString);
        if (!$dateTime || $dateTime->format($format) !== $datetimeString) {
            return "Invalid datetime format. Expected format: " . $format;
        }else{
            return null;
        }
    }
    public static function string(string $value, int $min = 0, int $max = INF)
    {
        $value = trim($value);
        return strlen($value) <= $min || strlen($value) >= $max;
    }


    public static function validateUsername($username)
    {
        $usernameRegex = "/^[a-zA-Z0-9_]+$/";
        if (!preg_match($usernameRegex, $username) || strlen($username)<4 || strlen($username)>20) {
            return "Username must be 4-20 characters and contain only letters, numbers, and underscores.";
        }else{
            return null;
        }
    }

    public static function validatePassword($password)
    {
        $passwordRegex = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[.!@$%^&*])[a-zA-Z0-9.!@$%^&*]{8,}$/";
        if (!preg_match($passwordRegex, $password)) {
            return "Password must be at least 8 characters and include at least one uppercase letter, lowercase letter, number, and special character.";
        }else{
            return null;
        }
    }

    public static function validatePasswordConfirmation($password, $passwordConfirmation)
    {
        if ($password !== $passwordConfirmation) {
            return "Password confirmation does not match password.";
        }else{
            return null;
        }
    }

    public static function validate($email, $username, $password, $passwordConfirmation)
    {
        $errors = [];
        $error = self::validateEmail($email);
        if ($error) {
            $errors[] = $error;
        }
        $error = self::validateUsername($username);
        if ($error) {
            $errors[] = $error;
        }
        $error = self::validatePassword($password);
        if ($error) {
            $errors[] = $error;
        }
        $error = self::validatePasswordConfirmation($password, $passwordConfirmation);
        if ($error) {
            $errors[] = $error;
        }
        return $errors;
    }
}
