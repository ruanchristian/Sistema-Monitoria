<?php

class CadastroController {
    //Classe responsável por ler os dados do PDF e cadastrar todos os alunos da escola no banco de dados.

    public function cadAluno() {
        $pdo = Connection::getConnection();
        $alunosF = $this->readSIGEpdf();
        
        $statement = $pdo->prepare("INSERT INTO alunos (matricula, nome, turma) VALUES (?, ?, ?)");
        foreach ($alunosF as $newAluno) {
            // Tirar o comentário dessa linha caso precisar cadastrar novamente.
            // $statement->execute(array($newAluno['matricula'], $newAluno['nome_aluno'], $newAluno['turma']));
        }
       header('Location: /Sistema Monitoria/home/');
    }

    private function readSIGEpdf() {
        $parser = new \Smalot\PdfParser\Parser();
        $path = "/home/christian/Downloads/alunos/";
        $dir = scandir($path);
        $values = [];

        foreach ($dir as $key => $file) {
            if ($key < 2) continue;

            $pdf = $parser->parseFile($path . $file);
            $dataPdf = $pdf->getPages()[0]->getDataTm();
            $dataPdf = array_slice($dataPdf, 11);
            unset($dataPdf[4]);
            array_push($values, array_column($dataPdf, 1));
            array_unshift($values[$key - 2], explode(".pdf", $file)[0]);
        }
        return $this->mapArray($values);
    }

    private function mapArray($arr) {
        $alunos = array();
        $i = 0;

        foreach ($arr as $k => $aluno) {
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
