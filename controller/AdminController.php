<?php

class AdminController {
    private $errorMsg;

    public function __construct() {
     $this->errorMsg = $_SESSION['error_msg_admin'] ?? null;

     if ($this->errorMsg) {
       $_SESSION['error_msg_admin']['contador']++;
       if ($this->errorMsg['contador'] >= 2) unset($_SESSION['error_msg_admin']);
     }
    }

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('admin-login.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);

        return $template->render([
            'error' => $this->errorMsg
        ]
     );
   }

   // Editar admin
   public function edit() {
      $user = $_POST['user'];
      $pass = $_POST['pass'];
      $admin_id = $_POST['button'];

      try {
        $pdo = Connection::getConnection();
        $stmt = $pdo->prepare("UPDATE admins SET usuario = ?, senha = md5(?) WHERE id = ?");
        $stmt->execute(array($user, $pass, $admin_id));
        header('Location: /Sistema Monitoria/painel');
        $_SESSION['success_adm'] = ['msg' => "Administrador $admin_id editado com sucesso.", 'contador' => 1];
      } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
      }
   }

   // Função que cria um novo monitor
   public function createManager() {
      $matricula = $_POST['aluno-mat'];
      $default_pass = "1234";

      try {
        $pdo = Connection::getConnection();
        $statement = $pdo->prepare("SELECT nome, turma FROM alunos WHERE matricula = ?");
        $statement->execute(array($matricula));
        $aluno_data = $statement->fetch();
  

        $stmt = $pdo->prepare("INSERT INTO monitores (matricula, nome, senha, turma) VALUES (?, ?, md5(?), ?)");
        $stmt->execute(array($matricula, $aluno_data['nome'], $default_pass, $aluno_data['turma']));
        $_SESSION['success_adm'] = ['msg' => "Monitor adicionado com sucesso.", 'contador' => 1];
        header('Location: /Sistema Monitoria/painel');
      } catch (Exception $e) {
        echo "ERRO INESPERADO: ". $e->getMessage();
      }
   }

   // Deleta a tabela monitores
   public function deleteAllManagers() {
    $pdo = Connection::getConnection();

    $pdo->exec("DELETE FROM monitores");
    $pdo->exec("ALTER TABLE monitores AUTO_INCREMENT = 1");
    header("Location: /Sistema Monitoria/painel");
   }

   // Função que cria um novo administrador
   public function createAccess() {
    $username = $_POST['username'];
    $password = $_POST['pass'];

    try {
      $pdo = Connection::getConnection();
      $stmt = $pdo->prepare("INSERT INTO admins (usuario, senha) VALUES (?, md5(?))");
      $stmt->execute(array($username, $password));
      $_SESSION['success_adm'] = ['msg' => "Administrador cadastrado com sucesso.", 'contador' => 1];
      header('Location: /Sistema Monitoria/painel');
    } catch (Exception $e) {
      echo "Erro: ". $e->getMessage();
    }
   }

   public function verify() {
    try {
        $admin = new Admin();
        $admin->setUsername($_POST['user']);
        $admin->setPassword($_POST['pass']);
        $admin->validateLogin();
        header("Location: /Sistema Monitoria/home");
      } catch (Exception $e) {
        $_SESSION['error_msg_admin'] = ['msg' => $e->getMessage(), 'contador' => 2];
        header('Location: /Sistema Monitoria/admin');
      }
   }
}