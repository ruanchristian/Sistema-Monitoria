<?php

class Monitor
{
    private $matricula;
    private $password;

    public function validateLogin()
    {
        $conn = Connection::getConnection();
        $statement = $conn->prepare("SELECT * FROM monitores WHERE matricula = :mat AND senha = :pass");
        $statement->bindValue(":mat", $this->matricula);
        $statement->bindValue(":pass", $this->password);
        $statement->execute();

        if ($statement->rowCount()) {
            $row = $statement->fetch();
            $_SESSION['usr'] = $row['nome'];
            return true;
        }
        throw new \Exception("Matrícula ou senha inválidas");
    }

    public function logout() {
        session_destroy();
        header('Location: /Sistema Monitoria/');
    }

    public function resetPass() {
        $senha1 = trim($_POST['newPass1']);
        $senha2 = trim($_POST['newPass2']);
        $senhaAtual = md5(trim($_POST['atualPass']));
        $isEmpty = empty($senha1) || empty($senha2);

        if ($isEmpty || $senha1 != $senha2) {
            $_SESSION["in_pass"] = 'Houve um erro em confirmar as senhas';
         //   header("Location: changes");
            return;
        }
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    public function getMatricula($matricula)
    {
        return $this->matricula;
    }
}
