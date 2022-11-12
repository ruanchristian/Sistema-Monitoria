<?php

 class Monitor {
    private $id;
    private $matricula;
    private $password;

    public function validateLogin() {
       $conn = Connection::getConnection();
       $statement = $conn->prepare("SELECT * FROM monitores WHERE matricula = :mat AND senha = :pass");
       $statement->bindValue(":mat", $this->matricula);
       $statement->bindValue(":pass", $this->password);
       $statement->execute();

       if($statement->rowCount()) {
          $row = $statement->fetch();
          $_SESSION['usr'] = $row['nome'];
          return true;
       }
       throw new \Exception("Matrícula ou senha inválidas");
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setPassword($password) {
        $this->password = md5($password);
    }

    public function getMatricula($matricula) {
        return $this->matricula;
    }
 }