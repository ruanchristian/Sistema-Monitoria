<?php

class LoginController {
  private $valError;

    public function __construct() {
      $this->valError = $_SESSION['error_msg'] ?? null;        

      if($this->valError && $this->valError['contador'] == 0) {
        $_SESSION['error_msg']['contador']++;
      } else {
        unset($_SESSION['error_msg']);
      }
    }

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('login.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);
        return $template->render(['error' => $_SESSION['error_msg'] ?? null]);
    }

    public function check() {

       try {
        $manager = new Manager();
        $manager->setMatricula($_POST['matricula']);
        $manager->setPassword($_POST['pass']);
        $manager->validateLogin();
        header("Location: /Sistema Monitoria/home");
       } catch (\Exception $e) {
         $_SESSION['error_msg'] = ['msg' => $e->getMessage(), 'contador' => 0];
         header('Location: /Sistema Monitoria/');
       }
    }

    public function logout() {
      session_destroy();
      header('Location: /Sistema Monitoria/');
  }
}
