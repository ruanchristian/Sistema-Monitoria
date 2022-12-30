<?php

define('CONFIGS', [
    "dsn" => "mysql:host=127.0.0.1;dbname=monitoria_labs_eeepjas",
    "user" => "root",
    "pass" => ''
]);

if(empty($_POST['turma'])) return;

$conn = new PDO(CONFIGS['dsn'], CONFIGS['user'], CONFIGS['pass']);

$statement = $conn->prepare("SELECT nome FROM alunos WHERE turma = ?");
$statement->execute(array($_POST['turma']));

if (!$statement->rowCount() > 0) header('HTTP/1.1 503 Service Unavailable');

$arr = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($arr as $value){
    echo <<<ROW
    <option value="{$value['nome']}">{$value['nome']}</option>
    ROW;
}

