<?php
defined('APP_ROOT') or die('Access denied!'); 
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'php_tasks';
try {
    $pdo = new PDO("mysql:host=$server; dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e) {
    echo $pdo . "<br>" . $e->getMessage();
}
