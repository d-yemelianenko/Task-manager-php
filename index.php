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
    <?php if (!empty($tasks)) : ?>
        <?php foreach ($tasks as $task): ?>
            <h2><?= htmlspecialchars($task['title']) ?></h2>
            <p><?= nl2br(htmlspecialchars($task['description'])) ?></p>
            <p><?= htmlspecialchars($task['status']) ?></p>
            <p><?= htmlspecialchars($task['created_at']) ?></p>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Brak postów do wyświetlenia.</p>
    <?php endif; ?>
</section>
<?php include APP_ROOT . '/includes/footer.php'; ?>