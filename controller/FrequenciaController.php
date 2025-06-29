<?php

class FrequenciaController {
    private $success;

    public function __construct() {
      $this->success = $_SESSION['success'] ?? null;

      if ($this->success) {
        $_SESSION['success']['contador']++;
        if ($this->success['contador'] >= 2) unset($_SESSION['success']);
      }
    }

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('frequencia.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);

        return $template->render([
          'admin' => $_SESSION['access_admin'] ?? NULL,
          'nome' => $_SESSION['access']['username'] ?? $_SESSION['access_admin']['username'] ?? NULL,
          'date' => date("Y-m-d", time()),
          'success' => $this->success
        ]);
    }

    //Função que realiza a frequência e insere no banco.
    public function write() {
     $faltososId = $_POST['check'];
     $hash_admin = $_SESSION['access_admin']['hash'];
     $pdo = Connection::getConnection();

     $stmt = $pdo->prepare("SELECT * FROM monitores WHERE id = ?");

     foreach ($faltososId as $id) {
          $stmt->execute(array($id));
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $pdo->prepare(
            "INSERT INTO faltas (nome, matricula, date_write, author_hash)
             VALUES (?, ?, ?, ?)")->execute(array(
              $row['nome'], $row['matricula'], date("Y-m-d", time()), $hash_admin));
     }
            $_SESSION['success'] = ['msg' => "Frequência registrada com sucesso.", 'contador' => 1];
            header('Location: ../frequencia');
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
    //     $this->imgs[$key] = $row;
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
