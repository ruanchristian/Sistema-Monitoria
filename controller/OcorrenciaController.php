<?php

class OcorrenciaController {

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('ocorrencia.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);

        return $template->render([
          'nome' => $_SESSION['access']['username'] ?? "Unknown Source",
          'date' => date("Y-m-d", time())
        ]);
    }

    
}