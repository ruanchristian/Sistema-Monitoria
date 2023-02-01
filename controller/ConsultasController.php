<?php

class ConsultasController {
    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('consulta.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);

        return $template->render([
            'admin' => $_SESSION['access_admin'] ?? NULL,
            'nome' => $_SESSION['access']['username'] ?? $_SESSION['access_admin']['username'] ?? NULL
        ]);
    }
}