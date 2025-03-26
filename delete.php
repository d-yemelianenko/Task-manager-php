<?php
define('APP_ROOT', dirname(__FILE__));
require_once APP_ROOT . '/includes/database.php';

$taskId = (int)$_GET['id'];

$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
$success = $stmt->execute([$taskId]);

if ($success && $stmt->rowCount() > 0) {
    header("Location: index.php");
    exit;
} else {
    echo "Nie udało się usunąć zadania lub zadanie nie istnieje.";
    // print_r($stmt->errorInfo()); // Odkomentuj do debugowania
}
