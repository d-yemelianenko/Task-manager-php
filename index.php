<?php
define('APP_ROOT', dirname(__FILE__));
$page_title = "Task Manager";

// Ładowanie konfiguracji
require_once APP_ROOT . '/includes/database.php';
require_once APP_ROOT . '/includes/select.php';
include APP_ROOT . '/includes/header.php';
?>
<h1>Prosty Task Manager</h1>

<section>
    <article>
        <?php if (!empty($tasks)) : ?>
            <?php foreach ($tasks as $task): ?>
                <h2><?= htmlspecialchars($task['title']) ?></h2>
                <p><?= nl2br(htmlspecialchars($task['description'])) ?></p>
                <p><?= htmlspecialchars($task['status']) ?></p>
                <p>Data stworzenia zadania: <?= htmlspecialchars($task['created_at']) ?></p>
                <p>Data modyfikacji zadania: <?= htmlspecialchars($task['updated_at']) ?></p>
                <p>Data wykonania zadania: <?= htmlspecialchars($task['due_date']) ?></p>
                <button class="btn-edit" data-id="<?= $task['id'] ?>">Edytuj</button>
                <button class="btn-delete" data-id="<?= $task['id'] ?>">Usuń</button>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Brak postów do wyświetlenia.</p>
        <?php endif; ?>
    </article>
</section>
<?php include APP_ROOT . '/includes/footer.php'; ?>