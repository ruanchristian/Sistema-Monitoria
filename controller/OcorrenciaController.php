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
          'nome' => $_SESSION['access']['username'] ?? "Unknown Source",
          'date' => date("Y-m-d", time()),
          'sucesso' => $this->success
        ]);
    }

    public function save() {
       $local = $_POST['local'];
       $turma = $_POST['turma'] ?? NULL;
       $aluno = $_POST['aluno'] ?? NULL;
       $observacao = trim($_POST['obs']);

      if(empty($observacao)) die("erro :/ impossível deixar observações em branco <br> <a href='/Sistema Monitoria/ocorrencia'>Voltar</a>");

      $pdo = Connection::getConnection();
      $stmt = $pdo->prepare("INSERT INTO ocorrencias (local, turma, aluno, observation, author, date_write)
                            VALUES (?, ?, ?, ?, ?, NOW())");  
      $stmt->execute(array($local, $turma, $aluno, $observacao, $_SESSION['access']['matricula']));

      $_SESSION['success'] = ['msg' => "Sua observação foi enviada", 'contador' => 1];
      header('Location: /Sistema Monitoria/ocorrencia');
    }
}