<?php
namespace Models;

use PDO;

class User
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function setUser($name, $surname, $email, $phone, $city, $hashedPassword)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, surname, email, phone, city, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $surname, $email, $phone, $city, $hashedPassword]);
    }

    public function getUser($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}