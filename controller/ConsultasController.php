<?php

class ConsultasController {
    private $turmas;
    private $ocorrencias;
    private $observacoes;
    private $monitores_faltosos;
    private $responsavel;
    private $data_envio;

    public function __construct() {
        HomeController::getTurmas();
        $this->turmas = $_SESSION['turmas'] ?? NULL;
    }

    public function onCreate(): string {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('consulta.html', [
          'cache' => '/path/to/compilation_cache',
          'auto_reload' => true
        ]);

        return $template->render([
            'admin' => $_SESSION['access_admin'] ?? NULL,
            'nome' => $_SESSION['access']['username'] ?? $_SESSION['access_admin']['username'] ?? NULL,
            'turmas' => $this->turmas,
            'max_date' => date("Y-m-d")
        ]);
    }

    public function consultar(): void {
        $pdo = Connection::getConnection();
        $this->ocorrencias = $this->getOcorrencias($pdo, $_POST['data-hj'], $_POST['turma']);
        $this->observacoes = $this->getObservacoes($pdo, $_POST['data-hj']);
        $this->monitores_faltosos = $this->getFaltas($pdo, $_POST['data-hj']);

        echo "<pre>";
        print_r([$this->ocorrencias, $this->observacoes, $this->monitores_faltosos]);
    }

    private function getOcorrencias(PDO $conn, string $data, string $turma): array {
         $statement = $conn->prepare("SELECT * FROM ocorrencias WHERE date_write LIKE '%$data%' AND turma = ?");
         $statement->execute(array($turma));

         return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getObservacoes(PDO $conn, string $data): array {
         $statement = $conn->prepare("SELECT * FROM observacoes WHERE date_write LIKE '%$data%'");
         $statement->execute();

         return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getFaltas(PDO $conn, string $data): array {
        $statement = $conn->prepare("SELECT nome FROM faltas WHERE date_write = ?");
        $statement->execute(array($data));

        return array_column($statement->fetchAll(PDO::FETCH_ASSOC), "nome");
    }
    
}