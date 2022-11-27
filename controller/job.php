<?php

define('CONFIGS', [
    "dsn" => "mysql:host=127.0.0.1;dbname=sistema",
    "user" => "root",
    "pass" => ''
]);

if(empty($_POST['turma'])) return;

$conn = new PDO(CONFIGS['dsn'], CONFIGS['user'], CONFIGS['pass']);

$statement = $conn->prepare("SELECT * FROM alunos WHERE turma = ?");
$statement->execute(array($_POST['turma']));
$arr = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($arr as $value){
    echo <<<ROW
    <option value="{$value['nome']}">{$value['nome']}</option>
    ROW;
}

