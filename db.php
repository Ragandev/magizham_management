<?php
$host = 'localhost';
$dbname = 'hotel';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Connected to the database.";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
function getCategories($pdo) {
    $query = "SELECT * FROM category";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>