<?php
define('APP_ROOT', dirname(__FILE__));
$page_title = "Task Manager";

// Ładowanie konfiguracji
require_once APP_ROOT . '/includes/database.php';
require_once APP_ROOT . '/includes/select.php';
include APP_ROOT . '/includes/header.php';
?>
<h1>Prosty Task Manager</h1>

<div>
    <button class="view-btn active" onclick="showView('table')">Widok tabeli</button>
    <button class="view-btn" onclick="showView('cards')">Widok kart</button>
</div>

<div id="table-view" style="display: none;">
    <table>
        <?php if (!empty($tasks)) : ?>
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Opis</th>
                    <th>Data stworzenia</th>
                    <th>Data modyfikacji</th>
                    <th>Data wykonania</th>
                    <th>Opcje</th>
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
                        <td><a href="edit.php?id=<?= htmlspecialchars($task['id']) ?>" class="btn-edit">Edytuj</a></td>
                        <td><a href="delete.php?id=<?= htmlspecialchars($task['id']) ?>" class="btn-delete">Usuń</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Brak postów do wyświetlenia.</td>
                </tr>

            <?php endif; ?>
            </tbody>
    </table>
</div>

<div id="cards-view" style="display: none;">
    <?php if (!empty($tasks)) : ?>
        <?php foreach ($tasks as $task): ?>
            <div class="task-card">
                <h3><?= htmlspecialchars($task['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($task['description'])) ?></p>
                <p><?= htmlspecialchars($task['status']) ?></p>
                <p>Data stworzenia zadania: <?= htmlspecialchars(date('Y-m-d', strtotime($task['created_at']))); ?></p>
                <p>Data modyfikacji zadania: <?= htmlspecialchars(date('Y-m-d', strtotime($task['updated_at']))); ?></p>
                <span>Termin: <?= htmlspecialchars(date('Y-m-d', strtotime($task['due_date']))); ?></span>
                <a href="edit.php?id=<?= htmlspecialchars($task['id']) ?>" class="btn-edit">Edytuj</a>
                <a href="delete.php?id=<?= htmlspecialchars($task['id']) ?>" class="btn-delete">Usuń</a>
                
            </div>

        <?php endforeach; ?>
    <?php else : ?>
        <p>Brak postów do wyświetlenia.</p>
    <?php endif; ?>
</div>

<?php include APP_ROOT . '/includes/footer.php'; ?>