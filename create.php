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
<form action="create.php" method="POST">
    Nazwa zadania :
    <input type="text" id="title" name="title" required><br>
    Opis zadania : <input type="text" name="description" required><br>
    Status zadania
    <input list="status" name="status" required><br>
    <datalist id="status">
        <option value="todo">Do zrobienia</option>
        <option value="in_progress">W trakcie</option>
        <option value="done">Skonczone</option>
    </datalist>
    Wybież prioritet <input list="priority" name="priority" required><br>
    <datalist id="priority">
        <option value="low">Zaplanowane</option>
        <option value="medium">Sredniej ważności</option>
        <option value="high">Terminowe</option>
    </datalist>
    Data wykonania zadania: <input type="date" name="due_date" required><br>
    Data rozpoczecia zadania: <input type="date" name="created_date" required><br>
    <button type="submit" name="submit">Submit</button>
</form>