<?php
// Database credentials.
$host = '192.168.10.10';
$db = 'indeavr-online-shop';
$username = 'homestead';
$password = 'secret';

// Create a new PDO instance.
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;port=3306", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}