<?php
date_default_timezone_set('America/Fortaleza');

class FrequenciaController {

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('frequencia.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);
        return $template->render([
          'nome' => $_SESSION['usr'] ?? "Unknown Source",
          'date' => date("Y-m-d", time())
        ]);
    }
}
