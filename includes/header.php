<?php defined('APP_ROOT') or die('Access denied!'); ?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Mój Blog'; ?></title>
    <link rel="stylesheet" href="css/styles.css">

</head>


<body>
    <header role="banner">
        <nav aria-label="Menu bloga">
            <ul>
                <li><a href="/">Strona główna</a></li>
                <li><a href="/create.php">Dodanie Zadania</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <main>