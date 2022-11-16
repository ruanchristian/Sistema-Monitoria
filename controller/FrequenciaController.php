<?php

class FrequenciaController {
    private $alunos = [];
    private $error;

    public function __construct() {
      $this->error = $_SESSION['error_msg'] ?? null;
      $this->alunos = $_SESSION['alunos'] ?? null;

      if($this->alunos && $_SESSION['alunos']['counter'] == 1) unset($_SESSION['alunos']);
      if($this->error && $_SESSION['error_msg']['contador'] == 1) unset($_SESSION['error_msg']);
    }

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('frequencia.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);

        return $template->render([
          'nome' => $_SESSION['access']['username'] ?? "Unknown Source",
          'date' => date("Y-m-d", time()),
          'alunos' => $this->alunos,
          'error' => $this->error,
        ]);
    }

    public function getAlunosByTurma() {
      try {
       $turma = $_POST['frequenciaSelect'];
       $_SESSION['alunos'] = ['list' => $this->retrieveAllAlunos($turma), 'counter' => 1];
       header('Location: /Sistema Monitoria/frequencia');
      } catch(Exception $e) {
        $_SESSION['error_msg'] = ['msg' => $e->getMessage(), 'contador' => 1];
        header('Location: /Sistema Monitoria/frequencia');
      }
    }

    private function retrieveAllAlunos($turma) {
      $pdo = Connection::getConnection();
      $statement = $pdo->prepare("SELECT * FROM alunos WHERE turma = ?");
      $statement->execute(array($turma));

      if(!$statement->rowCount() > 0) throw new Exception("Opção inválida");
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
