<?php

class CadastroController {
    //Classe responsável por ler os dados do PDF e cadastrar todos os alunos da escola no banco de dados.

    // Monta uma tabela com os alunos do PDF selecionado 
    public function visualizar() {
        error_reporting(0);

        if(isset($_FILES['pdfalunos'])) {      
            $alunos = $this->readSIGEpdf($_FILES['pdfalunos']);
            $turma = $alunos[0]['turma'];
            
            echo <<<TABLE
                <table border='1' style="margin:auto; width:40rem;">
                 <thead>
                  <tr>                 
                    <td colspan='5' style='text-transform: uppercase;'>
                      <p align='center'><img width='85rem;' src='/Sistema Monitoria/assets/img/eeepjas-icone.svg'><br>
                        <b> EEEP Dr. José Alves Da Silveira </b> <br>
                        <b style='text-decoration: underline;'>Turma: $turma</b>
                      </p>
                    </td>
                   </tr> 
                    <th>Nº</th>
                    <th>Matrícula</th>
                    <th>Nome</th>
                  </thead>
                <tbody>                      
                TABLE;

            foreach ($alunos as $i => $aluno) {
                ++$i;
                $mat = $aluno['matricula'];
                $nome = $aluno['nome_aluno'];
                echo <<<TABLEROW
                    <tr>
                        <th>$i</th>
                        <td>$mat</th>
                        <td>$nome</td>
                    </tr>
                TABLEROW;
            }
            echo '</tbody>';
            echo '</table>';
        }
    }

    // public function cadAluno() {
    //     $pdo = Connection::getConnection();
    //     $alunosF = $this->readSIGEpdf();
        
    //     $statement = $pdo->prepare("INSERT INTO alunos (matricula, nome, turma) VALUES (?, ?, ?)");
    //     foreach ($alunosF as $newAluno) {
    //         // $statement->execute(array($newAluno['matricula'], $newAluno['nome_aluno'], $newAluno['turma']));
    //     }
    //    header('Location: /Sistema Monitoria/home/');
    // }


    // Faz a leitura do pdf de alunos e coloca os dados em uma matriz.
    private function readSIGEpdf($file) {
        $parser = new \Smalot\PdfParser\Parser();
        $path = $file['tmp_name'];
        $name = $file['name'];

        $values = [];

        $pdf = $parser->parseFile($path);
        $dataPdf = $pdf->getPages()[0]->getDataTm();
        $dataPdf = array_slice($dataPdf, 11);
        unset($dataPdf[4]);
        array_push($values, array_column($dataPdf, 1));
        array_unshift($values[0], explode(".pdf", $name)[0]);

        return $this->mapArray($values);
    }

    // Mapeia matriz de alunos e devolve como uma outra matriz organizada
    private function mapArray($alunos_array) {
        $alunos = array();
        $i = 0;

        foreach ($alunos_array as $aluno) {
            $turma = $aluno[0];
            array_shift($aluno);
            foreach ($aluno as $a) {
               if(str_contains($a, " ") && !str_contains($a, " - ") && !str_contains($a, ". ")) {
                   $nome = $a;
               } 
               if (strlen($a) == 7) {
                   $alunos[$i]['nome_aluno'] = $nome;
                   $alunos[$i]['matricula'] = $a;
                   $alunos[$i]['turma'] = $turma;
               }
               $i++;
            }
            
        }
        return array_values($alunos);
    }
}
