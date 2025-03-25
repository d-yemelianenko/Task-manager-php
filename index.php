<?php
define('APP_ROOT', dirname(__FILE__));
$page_title = "Blog Programistyczny";

// Ładowanie konfiguracji
require_once APP_ROOT . '/includes/database.php';
require_once APP_ROOT . '/includes/select.php';
include APP_ROOT . '/includes/header.php';

?>
<h1>Prosty blog w czystym PHP</h1>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Content</th>
            <th>Data stworzenia</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($posts)) : ?>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?php echo $post['id']; ?></td>
                    <td><?php echo $post['title']; ?></td>
                    <td><?php echo $post['content']; ?></td>
                    <td><?php echo $post['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Brak postów do wyświetlenia.</td>
            </tr>

        <?php endif; ?>
    </tbody>
</table>

<section>
    <?php if (!empty($posts)) : ?>
        <?php foreach ($posts as $post): ?>
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <p><?php nl2br(htmlspecialchars($post['content'])) ?></p>
        <?php endforeach; ?>
    <?php else : ?>
            <p>Brak postów do wyświetlenia.</p>
    <?php endif; ?>
</section>
<?php include APP_ROOT . 'includes/footer.php'; ?>