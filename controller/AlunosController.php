<?php

   class AlunosController {
    private $alunos;
    private $monitores;

    public function __construct() {
      $this->alunos = $_SESSION['alunos'] ?? null;
      $this->monitores = Manager::getAllManagers();

      if($this->alunos && $_SESSION['alunos']['counter'] == 1) unset($_SESSION['alunos']);
    }

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('alunos.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);
        
        return $template->render([
          'nome' => $_SESSION['access']['username'] ?? "Unknown Source",
          'alunos' => $this->alunos,
          'monitores' => $this->monitores
        ]);
    }

    public function recv() {
        $turma = $_POST['select'];
        FrequenciaController::getAlunosByTurma($turma, "/Sistema Monitoria/alunos");
    }
   }