<?php

define('CONFIGS', [
    "dsn" => "mysql:host=127.0.0.1;dbname=sistema",
    "user" => "root",
    "pass" => ''
]);

if(empty($_POST['turma'])) return;

$conn = new PDO(CONFIGS['dsn'], CONFIGS['user'], CONFIGS['pass']);

$statement = $conn->prepare("SELECT id, nome, matricula FROM alunos WHERE turma = ?");
$statement->execute(array($_POST['turma']));

if(!$statement->rowCount() > 0) header('HTTP/1.1 503 Service Unavailable');

$arr = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($arr as $aluno) {
    echo <<<ALUNO
     <i class="fas fa-user"></i>
      <span class="d-inline user-select-none"> {$aluno['nome']} </span>
      <small> ({$aluno['matricula']})</small><br>
      <label class='switch mt-4'><input value="{$aluno['id']}" onchange="changeState(this, `{$aluno['id']}`)" name="check[]" type='checkbox'><span></span></label>
      <span id="{$aluno['id']}" class="float-end">P</span>
      <hr>
    ALUNO;
}