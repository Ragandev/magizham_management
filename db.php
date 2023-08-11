<?php
$host = 'localhost';
$dbname = 'resto_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Connected to the database.";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>