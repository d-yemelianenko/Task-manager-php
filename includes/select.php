<?php
require_once 'database.php';

try {

    $stmt = $pdo->prepare("SELECT * FROM tasks");
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Błąd: " . $e->getMessage();
}
