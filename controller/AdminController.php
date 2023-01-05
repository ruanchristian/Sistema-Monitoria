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

   public function createAccess() {
    $username = $_POST['username'];
    $password = $_POST['pass'];

    try {
      $pdo = Connection::getConnection();
      $stmt = $pdo->prepare("INSERT INTO admins (usuario, senha) VALUES (?, md5(?))");
      $stmt->execute(array($username, $password));
      $_SESSION['success_access'] = ['msg' => "Administrador cadastrado com sucesso.", 'contador' => 1];
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