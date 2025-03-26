<?php
define('APP_ROOT', dirname(__FILE__));
require_once APP_ROOT . '/includes/database.php';
include APP_ROOT . '/includes/header.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdź czy wszystkie wymagane pola są ustawione
    $required = ['title', 'description', 'status', 'priority', 'due_date'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            die("Brakujące wymagane pole: $field");
        }
    }
    $taskId = $_POST['id'];
    if (!is_numeric($taskId)) {
        die("Nieprawidłowe ID");
    }

    $taskId = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $due_date = date('Y-m-d H:i:s', strtotime($_POST['due_date']));
    $updated_at_date = $_POST['updated_at'] . ' ' . date('H:i:s');


    try {

        $sql = "UPDATE tasks SET title=?, description=?, status=?, priority=?, due_date=?, updated_at =? WHERE id=?";
        $stmt = $pdo->prepare($sql);

        $result = $stmt->execute([
            $title,
            $description,
            $status,
            $priority,
            $due_date,
            $updated_at_date,
            $taskId
        ]);
        if ($result) {
            echo "Update record successfully";
            header("Location: index.php");
            exit;
        } else {
            echo "Error: No rows affected. Check your data and table structure.";
            print_r($stmt->errorInfo()); // Wyświetl szczegóły błędu
        }
    } catch (PDOException $e) {
        // Wyświetl błąd (tylko na czas developmentu)
        echo "Database Error: " . $e->getMessage();
        error_log($e->getMessage());
    }
} else {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        die("Nieprawidłowe ID taska! Użyj URL w formacie: edit.php?id=1");
    }

    $taskId = (int)$_GET['id']; // Konwersja na integer dla bezpieczeństwa

    try {
        // Pobierz task z bazy
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$taskId]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        $updated_at_date = date('Y-m-d', strtotime($task['updated_at']));
        if (!$task) {
            die("Nie znaleziono taska o ID: $taskId");
        }
        $title = $task['title'];
        if (!empty($task['due_date'])) {
            if (strpos($task['due_date'], '-') !== false) { // Format DATE/DATETIME
                $due_date = substr($task['due_date'], 0, 10); // Obetnij czas jeśli DATETIME
            } else { // Inny format
                $due_date = date('Y-m-d', strtotime($task['due_date']));
            }
        }


        // Tutaj możesz użyć $task do wypełnienia formularza
        // np. $task['task_name'], $task['description'] itd.

    } catch (PDOException $e) {
        die("Błąd bazy danych: " . $e->getMessage());
    }
}
?>
<form action="edit.php" method="POST">
    <input type="hidden" name="id" value="<?= $task['id'] ?>">
    Nazwa zadania :
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($title ?? '') ?>" required><br>
    Opis zadania : <textarea name="description" required> <?= htmlspecialchars($task['description'] ?? '') ?></textarea><br>
    Status zadania:
    <select name="status" required>
        <option value="todo" <?= ($task['status'] ?? '') === 'todo' ? 'selected' : '' ?>>Do zrobienia</option>
        <option value="in_progress" <?= ($task['status'] ?? '') === 'in_progress' ? 'selected' : '' ?>>W trakcie</option>
        <option value="done" <?= ($task['status'] ?? '') === 'done' ? 'selected' : '' ?>>Skończone</option>
    </select><br>
    Wybież prioritet
    <select name="priority" id="priority">
        <option value="low" <?= ($task['priority'] === 'low' ? 'selected' : '') ?>>Zaplanowane</option>
        <option value="medium" <?= ($task['priority'] === 'medium' ? 'selected' : '') ?>>Sredniej ważności</option>
        <option value="high" <?= ($task['priority'] === 'high' ? 'selected' : '') ?>>Terminowe</option>
    </select><br>
    Data wykonania zadania: <input type="date" name="due_date" value="<?= htmlspecialchars($due_date) ?>" required><br>
    Data modyfikacji: <input type="date" name="updated_at" value="<?= htmlspecialchars($updated_at_date) ?>" required><br>
    <button type="submit" name="submit">Zapisz</button>
</form>