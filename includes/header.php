<?php defined('APP_ROOT') or die('Access denied!'); ?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Mój Blog'; ?></title>
    <?php define('BASE_URL', '/php_blog/'); ?>
    <link href="<?php echo BASE_URL; ?>css/style.css">


</head>


<body>
    <?php include 'includes/header.php'; ?>
    <main>