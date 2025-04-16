<?php
define('APP_ROOT', dirname(__FILE__));
$page_title = "Task Manager";

// Ładowanie konfiguracji
require_once APP_ROOT . '/includes/database.php';
require_once APP_ROOT . '/includes/select.php';
include APP_ROOT . '/includes/header.php';
?>

<h1 class="my-4">Prosty Task Manager</h1>

<div class="my-3">
    <button class="btn btn-dark" onclick="showView('table')">Widok tabeli</button>
    <button class="btn btn-dark" onclick="showView('cards')">Widok kart</button>
</div>




<div id="table-view" style="display: none;">
    <h2 class="table-title">Lista zadań</h2>
    <table class="table table-dark table-hover table-bordered rounded">
        <?php if (!empty($tasks)) : ?>
            <thead class="align-middle text-center">
                <tr>
                    <th>Tytuł</th>
                    <th>Opis</th>
                    <th>Data stworzenia</th>
                    <th>Data modyfikacji</th>
                    <th>Data wykonania</th>
                    <th>Status</th>
                    <th colspan="2">Opcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['title']); ?></td>
                        <td><?= htmlspecialchars($task['description']); ?></td>
                        <td><?= htmlspecialchars(date('Y-m-d', strtotime($task['created_at']))); ?></td>
                        <td><?= htmlspecialchars(date('Y-m-d', strtotime($task['updated_at']))); ?></td>
                        <td><?= htmlspecialchars(date('Y-m-d', strtotime($task['due_date']))); ?></td>
                        <td>
                            <?php
                            $status = $task['status'];
                            $statusText = '';
                            $badgeClass = '';

                            switch ($status) {
                                case 'todo':
                                    $statusText = 'Do zrobienia';
                                    $badgeClass = 'badge-todo';
                                    break;
                                case 'in_progress':
                                    $statusText = 'W trakcie';
                                    $badgeClass = 'badge-in-progress';
                                    break;
                                case 'done':
                                    $statusText = 'Skończone';
                                    $badgeClass = 'badge-done';
                                    break;
                            }
                            ?>
                            <span class="badge <?= $badgeClass ?> px-3 py-2"><?= $statusText ?></span>
                        </td>
                        <td><a href="edit.php?id=<?= htmlspecialchars($task['id']) ?>" class="btn btn-outline-warning btn-sm">Edytuj</a></td>
                        <td><a href="delete.php?id=<?= htmlspecialchars($task['id']) ?>" class="btn btn-outline-danger btn-sm">Usuń</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Brak postów do wyświetlenia.</td>
                </tr>
            <?php endif; ?>
            </tbody>
    </table>
</div>

<div class="container my-4" id="cards-view" style="display: none;">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

        <?php if (!empty($tasks)) : ?>
            <?php foreach ($tasks as $task): ?>
                <?php
                $status = $task['status'];
                $statusText = '';
                $badgeClass = '';

                switch ($status) {
                    case 'todo':
                        $statusText = 'Do zrobienia';
                        $badgeClass = 'badge-todo';
                        break;
                    case 'in_progress':
                        $statusText = 'W trakcie';
                        $badgeClass = 'badge-in-progress';
                        break;
                    case 'done':
                        $statusText = 'Skończone';
                        $badgeClass = 'badge-done';
                        break;
                }
                ?>
                <div class="col">
                    <div class="card h-100 shadow-sm p-3 bg-dark">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-white"><?= htmlspecialchars($task['title']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($task['description'])) ?></p>

                            <p>Status: <span class="badge <?= $badgeClass ?>"><?= $statusText ?></span></p>
                            <p>Stworzone: <?= htmlspecialchars(date('Y-m-d', strtotime($task['created_at']))) ?></p>
                            <p>Zmodyfikowane: <?= htmlspecialchars(date('Y-m-d', strtotime($task['updated_at']))) ?></p>
                            <p>Termin: <?= htmlspecialchars(date('Y-m-d', strtotime($task['due_date']))) ?></p>

                            <div class="mt-auto">
                                <a href="edit.php?id=<?= htmlspecialchars($task['id']) ?>" class="btn btn-outline-primary me-2">Edytuj</a>
                                <a href="delete.php?id=<?= htmlspecialchars($task['id']) ?>" class="btn btn-outline-danger">Usuń</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Brak zadań do wyświetlenia.</p>
        <?php endif; ?>
    </div>
</div>

<?php include APP_ROOT . '/includes/footer.php'; ?>