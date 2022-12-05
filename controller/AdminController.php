<?php

class AdminController {
    private $errorMsg;

    public function __construct() {
     $this->errorMsg = $_SESSION['error_msg'] ?? null;

     if ($this->errorMsg && $this->errorMsg['contador'] == 1) unset($_SESSION['error_msg']);
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

   public function verify() {
    try {
        $admin = new Admin();
        $admin->setUsername($_POST['user']);
        $admin->setPassword($_POST['pass']);
        $admin->validateLogin();
        header("Location: /Sistema Monitoria/home");
      } catch (Exception $e) {
        $_SESSION['error_msg'] = ['msg' => $e->getMessage(), 'contador' => 1];
        header('Location: /Sistema Monitoria/admin');
      }
   }
}