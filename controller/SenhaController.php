<?php
  class SenhaController {
    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('changes.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);
        return $template->render(['nome' => $_SESSION['usr'] ?? "Unknown Source"]);
    }
  }