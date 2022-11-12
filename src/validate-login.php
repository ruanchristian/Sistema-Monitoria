<?php
include_once('power-session.php');
require_once("init.php");

if ((empty($_POST['matricula']) || empty($_POST['pass']))) {
    header('Location: ../index');
    return;
} 

$matricula = mysqli_real_escape_string($conn, trim($_POST['matricula']));
$senha = mysqli_real_escape_string($conn, trim($_POST['pass']));
$statement = $conn->prepare("SELECT * FROM monitores WHERE matricula = ? and senha = ?");
$statement->bind_param("ss", $matricula, md5($senha));
$statement->execute();

$row = $statement->get_result()->fetch_array();

if($row != null) {
    $_SESSION['user'] = $row['nome'];
    $_SESSION['matricula'] = $row['matricula'];
    header('Location: home');
} else {
    header('Location: ../index');
}

$conn->close();

