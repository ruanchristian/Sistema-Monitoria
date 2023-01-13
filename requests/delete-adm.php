<?php

define('CONFIGS', [
    "dsn" => "mysql:host=127.0.0.1;dbname=db_monitoria",
    "user" => "root",
    "pass" => ''
]);
if (empty($_POST['id'])) header('HTTP/1.1 503 Service Unavailable');

$conection = new PDO(CONFIGS['dsn'], CONFIGS['user'], CONFIGS['pass']);
//Deletando admin do banco
$stmt = $conection->prepare("DELETE FROM admins WHERE id = ?");
$stmt->execute(array($_POST['id']));

// Resetando AUTO INCREMENT, para ficar organizado dentro do banco de dados.
$conection->exec("ALTER TABLE admins AUTO_INCREMENT = 1");