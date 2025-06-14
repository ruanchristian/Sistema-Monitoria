<?php

  class HomeController {
    private $totalMonitores = 0;
    private $totalAlunos = 0;
    private $totalOcorrencias = 0;
    private $totalAdmins = 0;
    private $alunos;
    private $monitores;
    private $admins;

    public function __construct() {
      $this->getAlunos();
      $this->getTurmas();
      $this->alunos = $_SESSION['alunos'] ?? null;

      $this->monitores = Manager::getAllManagers();
      $this->admins = Admin::getAllAdmins();

      $this->totalMonitores = $this->getCountOf("monitores");
      $this->totalAlunos = $this->getCountOf("alunos");
      $this->totalOcorrencias = $this->getCountOf("ocorrencias") + $this->getCountOf("observacoes");
      $this->totalAdmins = $this->getCountOf("admins");
    }

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('home.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);
        
        return $template->render([
          'admin' => $_SESSION['access_admin'] ?? NULL,
          'nome' => $_SESSION['access']['username'] ?? $_SESSION['access_admin']['username'] ?? NULL,
          'alunos' => $this->alunos,
          'monitores' => $this->monitores,
          'admins' => $this->admins ?? NULL,
          'totalMonitores' => $this->totalMonitores,
          'totalAlunos' => $this->totalAlunos,
          'totalOcorrencias' => $this->totalOcorrencias,
          'totalAdmins' => $this->totalAdmins
        ]);
    }

    public static function getAlunos() {
      $pdo = Connection::getConnection();
      $statement = $pdo->prepare("SELECT * FROM alunos WHERE periodo = ?");
      $statement->execute(array("2022"));

      $_SESSION['alunos'] = ['list' => $statement->fetchAll(PDO::FETCH_ASSOC)];
    }

    public static function getTurmas() {
      $pdo = Connection::getConnection();
      $statement = $pdo->prepare("SELECT nome, periodo FROM turmas WHERE periodo = ?");
      $statement->execute(array("2022"));

      $_SESSION['turmas'] = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getCountOf($table) {
      $pdo = Connection::getConnection();

      if($table === "alunos") {
        $statement = $pdo->prepare("SELECT COUNT(*) as total FROM $table WHERE periodo = ?");
        $statement->execute(array("2022"));
        return $statement->fetch()['total'];
      }
      
      $statement = $pdo->prepare("SELECT COUNT(*) as total FROM $table");
      $statement->execute();

      return $statement->fetch()['total'];
    }
  }