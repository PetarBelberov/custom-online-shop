<?php
// Include your Database credentials for local development.
$host = 'db-mysql-nyc1-48624-do-user-14704390-0.b.db.ondigitalocean.com';
$db = 'defaultdb';
$username = 'doadmin';
$password = 'AVNS_0XlS0_a0hJKRnjLRuzd';
$port = '25060';

// Create a new PDO instance.
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}