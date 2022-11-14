<?php

class Manager {
    private $matricula;
    private $password;

    public function validateLogin() {
        $conn = Connection::getConnection();
        $statement = $conn->prepare("SELECT * FROM monitores WHERE matricula = ? AND senha = ?");
        $statement->execute(array($this->matricula, $this->password));

        if ($statement->rowCount()) {
            $row = $statement->fetch();
            $_SESSION['access'] = [
                'username' => $row['nome'],
                'matricula' => $row['matricula']
            ];
            return true;
        }
        throw new \Exception("Matrícula ou senha inválidas");
    }

    public function changePassword($pass1, $pass2, $currentPass) {
        $pdo = Connection::getConnection();
        $matricula = $_SESSION['access']['matricula'];

        if($pass1 != $pass2) throw new \Exception("Erro ao mudar a senha. As novas senhas não são iguais");
        if($currentPass != $this->getCurrentPassword($pdo, $matricula)) throw new \Exception("Informe corretamente sua senha atual");

        $stmt = $pdo->prepare("UPDATE monitores SET senha = ? WHERE matricula = ?");
        $stmt->execute(array(md5($pass1), $matricula));
    }

    public function getCurrentPassword($pdoConn, $matricula) {
      $stmt = $pdoConn->prepare("SELECT * FROM monitores WHERE matricula = ?");
      $stmt->execute(array($matricula));

      return $stmt->fetch()['senha'];
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setPassword($password) {
        $this->password = md5($password);
    }
}
