<?php

  class HomeController {
    private $totalMonitores = 0;

    public function __construct() {
      $this->totalMonitores = $this->getCount();
    }

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('home.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);
        
        return $template->render([
          'nome' => $_SESSION['access']['username'] ?? "Unknown Source",
          'tot' => $this->totalMonitores
        ]);
    }

    private function getCount() {
      $pdo = Connection::getConnection();
      $statement = $pdo->prepare("SELECT COUNT(*) as total FROM monitores");
      $statement->execute();

      return $statement->fetch()['total'];
    }
  }