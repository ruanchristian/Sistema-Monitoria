<?php
define('CONFIGS', [
    "dsn" => "mysql:host=127.0.0.1;dbname=sistema",
    "user" => "root",
    "pass" => ''
]);

$conn = new PDO(CONFIGS['dsn'], CONFIGS['user'], CONFIGS['pass']);

$statement = $conn->prepare("SELECT id, nome, matricula FROM monitores ORDER BY nome ASC");
$statement->execute();

if(!$statement->rowCount() > 0) header('HTTP/1.1 503 Service Unavailable');

$arr = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($arr as $manager) {
    echo <<<MANAGER
     <i class="fas fa-user"></i>
      <span class="d-inline user-select-none"> {$manager['nome']} </span>
      <small> ({$manager['matricula']})</small><br>
      <label class='switch mt-4'><input value="{$manager['id']}" onchange="changeState(this, `{$manager['id']}`)" name="check[]" type='checkbox'><span></span></label>
      <span id="{$manager['id']}" class="float-end">P</span>
      <hr>
    MANAGER;
}