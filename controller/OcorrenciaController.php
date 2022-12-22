<?php

class OcorrenciaController {
     private $success;

     public function __construct() {
      $this->success = $_SESSION['success'] ?? null;

      if($this->success && $_SESSION['success']['contador'] == 1) unset($_SESSION['success']);
     }

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('ocorrencia.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);

        return $template->render([
          'admin' => $_SESSION['access']['accept'] ?? NULL,
          'nome' => $_SESSION['access']['username'] ?? "Unknown Source",
          'date' => date("Y-m-d", time()),
          'sucesso' => $this->success
        ]);
    }

    public function save() {
       $local = $_POST['local'];
       $turma = $_POST['turma'];
       $aluno = $_POST['aluno'];
       $level = $_POST['level'];
       $key = $_SESSION['access']['matricula'] ?? ord($_SESSION['access']['username']);
       $observacao = trim($_POST['obs']);

      if(empty($observacao)) die("erro :/ impossível deixar observações em branco <br> <a href='/Sistema Monitoria/ocorrencia'>Voltar</a>");

      $pdo = Connection::getConnection();

      if ($level === "Ocorrência") {
      $stmt = $pdo->prepare("INSERT INTO ocorrencias (local, turma, aluno, observation, author, date_write)
                            VALUES (?, ?, ?, ?, ?, NOW())");  
      $stmt->execute(array($local, $turma, $aluno, $observacao, $key));
      $_SESSION['success'] = ['msg' => "Ocorrência registrada com sucesso.", 'contador' => 1];
      header('Location: /Sistema Monitoria/ocorrencia');
      return;
      }

        $stmt = $pdo->prepare("INSERT INTO observacoes (local, observation, author, date_write)
                            VALUES (?, ?, ?, NOW())");
        $stmt->execute(array($local, $observacao, $key));                    
        $_SESSION['success'] = ['msg' => "Observação registrada com sucesso.", 'contador' => 1];
        header('Location: /Sistema Monitoria/ocorrencia');
    }
}