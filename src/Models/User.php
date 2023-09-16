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

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateContactInformation($id, $name, $surname, $email, $phone, $city): void
    {
        $stmt = $this->pdo->prepare("UPDATE users SET name = ?, surname = ?, email = ?, phone = ?, city = ? WHERE id = ?");
        $stmt->execute([$name, $surname, $email, $phone, $city, $id]);
    }

}