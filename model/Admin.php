<?php

class Admin extends Manager {
    private $user;
    private $pass;

    public function validateLogin() {
        $conn = Connection::getConnection();
        $statement = $conn->prepare("SELECT * FROM admins WHERE usuario = ? AND senha = ?");
        $statement->execute(array($this->user, $this->pass));

        if ($statement->rowCount()) {
            $row = $statement->fetch();
            $_SESSION['access'] = [
                'username' => $row['usuario'],
                'id' => $row['id'],
                'accept' => TRUE
            ];
            return true;
        }
        throw new Exception("Esse admin não existe");
    }

    public static function getAllAdmins() {
        $pdo = Connection::getConnection();
        $stmt = $pdo->prepare("SELECT usuario FROM admins");
        $stmt->execute();

        $array = $stmt->fetchAll();
        return array_column($array, 'usuario');
    }

    public function setUsername($username) {
        $this->user = $username;
    }

    public function setPassword($password) {
        $this->pass = md5($password);
    }
}