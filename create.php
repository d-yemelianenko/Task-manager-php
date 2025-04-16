<?php
define('APP_ROOT', dirname(__FILE__));
require_once APP_ROOT . '/includes/database.php';
include APP_ROOT . '/includes/header.php';

// Włącz wyświetlanie błędów (tylko na czas developmentu)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdź czy wszystkie wymagane pola są ustawione
    $required = ['title', 'description', 'status', 'priority', 'due_date', 'created_date'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            die("Brakujące wymagane pole: $field");
        }
    }

    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $due_date = date('Y-m-d H:i:s', strtotime($_POST['due_date']));
    $created_date = date('Y-m-d H:i:s', strtotime($_POST['created_date']));

    try {
        $sql = "INSERT INTO tasks (title, description, status, priority, due_date, created_at)
                VALUES (:title, :description, :status, :priority, :due_date, :created_at)";

        $stmt = $pdo->prepare($sql);

        // Wiążemy parametry z wartościami
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':due_date', $due_date);
        $stmt->bindParam(':created_at', $created_date);

        // Wykonaj zapytanie TYLKO RAZ
        $result = $stmt->execute();

        if ($result) {
            echo "New record created successfully";
            header("Location: index.php");
            // exit;
        } else {
            echo "Error: No rows affected. Check your data and table structure.";
            print_r($stmt->errorInfo()); // Wyświetl szczegóły błędu
        }
    } catch (PDOException $e) {
        // Wyświetl błąd (tylko na czas developmentu)
        echo "Database Error: " . $e->getMessage();
        error_log($e->getMessage());
    }
}
?>
<div class="form-container">
<h2 class="my-3">New tasks</h2>
<form action="create.php" method="POST" class="p-4 bg-dark text-white rounded">
    <div class="mb-3">
        <label for="title" class="form-label">Nazwa zadania:</label>
        <input type="text" class="form-control" id="title" name="title" required><br>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Opis zadania:</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status zadania:</label>
        <select class="form-select" id="status" name="status" required>
            <option value="todo">Do zrobienia</option>
            <option value="in_progress">W trakcie</option>
            <option value="done">Skończone</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="priority" class="form-label">Wybierz priorytet:</label>
        <select class="form-select" id="priority" name="priority" required>
            <option value="low">Zaplanowane</option>
            <option value="medium">Sredniej ważności</option>
            <option value="high">Terminowe</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="created_date" class="form-label">Data rozpoczecia zadania: </label>
        <input type="date" class="form-control" id="created_date" name="created_date" required>
    </div>
    <div class="mb-3">
        <label for="due_date" class="form-label">Data wykonania zadania:</label>
        <input type="date" class="form-control" id="due_date" name="due_date" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Zapisz</button>
</form>
</div>