<?php

class PainelController {
    private $admins;
    private $success;

    public function __construct() {
        $this->admins = Admin::getAllAdmins() ?? NULL;
        $this->success = $_SESSION['success_adm'] ?? NULL;

        if ($this->success) {
            $_SESSION['success_adm']['contador']++;
            if ($this->success['contador'] >= 2) unset($_SESSION['success_adm']);
        }
    }

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('painel.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);

        return $template->render([
            'admin' => $_SESSION['access_admin'] ?? NULL,
            'nome' => $_SESSION['access']['username'] ?? $_SESSION['access_admin']['username'] ?? NULL,
            'admins' => $this->admins,
            'success_access' => $this->success
        ]);
    }
}