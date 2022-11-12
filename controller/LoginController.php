<?php

class LoginController {

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
       if (empty($_POST['matricula']) || empty($_POST['pass'])) {
        $_SESSION['error_msg'] = ['msg' => "Preencha ambos os campos", 'contador' => 0];
        header('Location: /Sistema Monitoria/');
        die;
       }

       try {
        $monitor = new Monitor();
        $monitor->setMatricula($_POST['matricula']);
        $monitor->setPassword($_POST['pass']);
        $monitor->validateLogin();
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
