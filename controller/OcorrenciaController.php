<?php

class OcorrenciaController {
     private $success;
     private $turmas;

     public function __construct() {
      $this->success = $_SESSION['success'] ?? null;
      $this->turmas = $_SESSION['turmas'] ?? null;

      if ($this->success) {
        $_SESSION['success']['contador']++;
        if ($this->success['contador'] >= 2) unset($_SESSION['success']);
    }
     }

    public function onCreate() {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('ocorrencia.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);

        return $template->render([
          'admin' => $_SESSION['access_admin'] ?? NULL,
          'nome' => $_SESSION['access']['username'] ?? $_SESSION['access_admin']['username'] ?? NULL,
          'date' => date("Y-m-d", time()),
          'sucesso' => $this->success,
          'turmas' => $this->turmas
        ]);
    }

    public function save() {
       $local = $_POST['local'];
       $turma = $_POST['turma'];
       $aluno = $_POST['aluno'];
       $level = $_POST['level'];
       $key = $_SESSION['access']['matricula'] ?? $_SESSION['access_admin']['hash'];
       $observacao = trim($_POST['obs']);

      if(empty($observacao)) die("erro :/ impossível deixar observações em branco <br> <a href='/Sistema Monitoria/ocorrencia'>Voltar</a>");

      $pdo = Connection::getConnection();

      if ($level === "Ocorrência") {
      $stmt = $pdo->prepare("INSERT INTO ocorrencias (local, turma, aluno, observation, author, date_write)
                            VALUES (?, ?, ?, ?, ?, NOW())");  
      $stmt->execute(array($local, $turma, $aluno, $observacao, $key));
      $_SESSION['success'] = ['msg' => "Ocorrência registrada com sucesso.", 'contador' => 1];
      header('Location: /Sistema Monitoria/ocorrencia');
      die;
    }

      $stmt = $pdo->prepare("INSERT INTO observacoes (local, observation, author, date_write)
                            VALUES (?, ?, ?, NOW())");
      $stmt->execute(array($local, $observacao, $key));                    
      $_SESSION['success'] = ['msg' => "Observação registrada com sucesso.", 'contador' => 1];
      header('Location: /Sistema Monitoria/ocorrencia');
    }
}