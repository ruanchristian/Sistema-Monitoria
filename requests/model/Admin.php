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
            $_SESSION['access_admin'] = [
                'username' => $row['usuario'],
                'id' => $row['id']
            ];
            return true;
        }
        throw new Exception("Esse admin não existe");
    }

    public static function getAllAdmins() {
        $pdo = Connection::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM admins");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setUsername($username) {
        $this->user = $username;
    }

    public function setPassword($password) {
        $this->pass = md5($password);
    }
}