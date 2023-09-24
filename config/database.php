<?php
// Include your Database credentials for local development.
$host = '192.168.10.10';
$db = 'indeavr-online-shop';
$username = 'homestead';
$password = 'secret';
$port = '3306';

// Create a new PDO instance.
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}