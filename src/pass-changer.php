<?php
include_once('power-session.php');
require_once("init.php");

//Implementação do algoritmo de troca de senhas.
$matricula = $_SESSION['matricula'] ?? null;

    $senha1 = trim($_POST['newPass1']);
    $senha2 = trim($_POST['newPass2']);
    $senhaAtual = md5(trim($_POST['atualPass']));
    $isEmpty = empty($senha1) || empty($senha2);

if ($isEmpty || $senha1 != $senha2) {
    $_SESSION["in_pass"] = 'Houve um erro em confirmar as senhas';
    header("Location: changes");
    return;
}

$statement = $conn->prepare("SELECT * FROM monitores WHERE matricula = ? and senha = ?");
$statement->bind_param("is", $matricula, $senhaAtual);
$statement->execute();
$linha = $statement->get_result()->fetch_array();

if ($linha != null) {
    $novaSenha = md5($senha1);
    $manager = $conn->prepare("UPDATE monitores SET senha = ? WHERE matricula = ?");
    $manager->bind_param("si", $novaSenha, $matricula);
    $manager->execute();
    $_SESSION['onSuccess'] = "Senha alterada com sucesso";
} else {
    $_SESSION['in_pass'] = "Informe corretamente sua senha atual";
}

header("Location: changes");
$conn->close();
