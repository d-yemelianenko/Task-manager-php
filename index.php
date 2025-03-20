<?php
require_once 'select.php';

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="styles.css">

</head>

<body>
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
</body>

</html>