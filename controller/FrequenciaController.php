<?php

class FrequenciaController {
    private $alunos = [];
    private $imgs = [];
    private $error;
    private $success;

    public function __construct() {
      $this->readImages();
      $this->error = $_SESSION['error_msg'] ?? null;
      $this->alunos = $_SESSION['students'] ?? null;
      $this->success = $_SESSION['success'] ?? null;


      if($this->alunos && $_SESSION['students']['counter'] == 1) unset($_SESSION['students']);
      if($this->error && $_SESSION['error_msg']['contador'] == 1) unset($_SESSION['error_msg']);
      if($this->success && $_SESSION['success']['contador'] == 1) unset($_SESSION['success']);
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
          'success' => $this->success,
          'img' => $this->imgs ?? null
        ]);
    }

    //Função que realiza a frequência e insere no banco.
    public function write() {
     if(!isset($_POST['check'])) {
      $_SESSION['success'] = ['msg' => "Frequência registrada com sucesso.", 'contador' => 1];
      header('Location: /Sistema Monitoria/frequencia');
      die;
     }

     $faltososId = $_POST['check'];
     $pdo = Connection::getConnection();

     $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");

     foreach ($faltososId as $id) {
          $stmt->execute(array($id));
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $pdo->prepare(
            "INSERT INTO faltas (nome_aluno, matricula_aluno, turma_aluno, date_write, author)
             VALUES (?, ?, ?, NOW(), ?)")->execute(array(
              $row['nome'], $row['matricula'], $row['turma'], $_SESSION['access']['matricula']
            ));
     }
            $_SESSION['success'] = ['msg' => "Frequência registrada com sucesso.", 'contador' => 1];
            header('Location: /Sistema Monitoria/frequencia');
    }

    public function search() {
       $turma = $_POST['frequenciaSelect'];
       FrequenciaController::getAlunosByTurma($turma, "/Sistema Monitoria/frequencia");
    }

    public static function getAlunosByTurma($turma, $path) {
      try {
       $_SESSION['students'] = ['list' => (new self)->retrieveAllAlunos($turma), 'counter' => 1];
       header('Location: '. $path);
      } catch(Exception $e) {
        $_SESSION['error_msg'] = ['msg' => $e->getMessage(), 'contador' => 1];
        header('Location: '. $path);
      }
    }

    private function readImages() {
      $pathFile = "assets/csv/images-2b.csv";
      $file = file($pathFile);
      
      foreach ($file as $key => $row) {
         $this->imgs[$key] = $row;
      }
    }

    private function retrieveAllAlunos($turma) {
      $pdo = Connection::getConnection();
      $statement = $pdo->prepare("SELECT * FROM alunos WHERE turma = ?");
      $statement->execute(array($turma));

      if(!$statement->rowCount() > 0) throw new Exception("Turma não cadastrada no banco de dados.");
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
