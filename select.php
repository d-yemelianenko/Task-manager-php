<?php
require_once 'config.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM posts");
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($posts)) {
        echo "Nie znaleziono posta o ID: $id";
    }
} catch (PDOException $e) {
    echo "Błąd: " . $e->getMessage();
}