<?php

  class HomeController {
    private $totalMonitores = 0;
    private $totalAlunos = 0;
    private $alunos;
    private $monitores;

    public function __construct() {
      $this->getAlunos();
      $this->alunos = $_SESSION['alunos'] ?? null;

      $this->monitores = Manager::getAllManagers();

      $this->totalMonitores = $this->getCount("monitores");
      $this->totalAlunos = $this->getCount("alunos");
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
          'alunos' => $this->alunos,
          'monitores' => $this->monitores,
          'totalMonitores' => $this->totalMonitores,
          'totalAlunos' => $this->totalAlunos
        ]);
    }

    private function getAlunos() {
      $pdo = Connection::getConnection();
      $statement = $pdo->prepare("SELECT * FROM alunos");
      $statement->execute();

      $_SESSION['alunos'] = ['list' => $statement->fetchAll(PDO::FETCH_ASSOC)];
    }

    private function getCount($table) {
      $pdo = Connection::getConnection();
      $statement = $pdo->prepare("SELECT COUNT(*) as total FROM {$table}");
      $statement->execute();

      return $statement->fetch()['total'];
    }
  }