<?php
include_once('power-session.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.M.L - Início</title>
    <!-- Bootstrap CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- My Custom CSS and JS file -->
    <link href="../styles/manager-style.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/responsivo.css">
    <link href="../styles/cronograma.css" rel="stylesheet">
    <script src="../js/frames.js"></script>
    <script src="../js/my-algorithm-rotation.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>

    <!-- lib PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <!-- Font Awesome LIB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/fontawesome.min.js" integrity="sha512-j3gF1rYV2kvAKJ0Jo5CdgLgSYS7QYmBVVUjduXdoeBkc4NFV4aSRTi+Rodkiy9ht7ZYEwF+s09S43Z1Y+ujUkA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <div id="superior-bar">
        <ul>
            <li class="list-group-item">
                <i>
                    Bem vindo(a):
                </i>
                <i>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo $_SESSION['user'];
                    } else {
                        echo "Unknown Source";
                    }
                    ?>
                </i>
            </li>
        </ul>
    </div>

    <?php
    include('template-menu.html');
    ?>

    <div class="infos text-center">
        <h2>Sistema de Monitoria dos Laboratórios</h2>
        <small>Verificar monitoria semanal</small><br>
        <select id="selectField">
            <option value="s-1">Semana 1</option>
            <option value="s-2">Semana 2</option>
            <option value="s-3">Semana 3</option>
        </select><br><br>
        <button data-bs-toggle="modal" data-bs-target="#myModal" id="viewInfoBtn" class="btn btn-dark">
            Verificar
        </button><br>
    </div>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Verifique o cronograma</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="c26 doc-content">
                        <p class="c15">
                            <img src="../img/eeepjas-icon.png" style="width: 120px; height: fit-content">
                        </p>
                        <p class="c15"><span class="c17">Alunos Monitores do dia</span></p>
                        <p class="c15"><span id="cron" class="c20">Cronograma</span></p>
                        <p class="c14"><span class="c20"></span></p><a id="t.8c706dbf1a5943b7d5c03587dcd8ad326b92248c"></a><a id="t.0"></a>
                        <table class="c19"></table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button id="pdfDownload" type="button" class="btn btn-primary">Fazer download em PDF</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalSpin" class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Baixando o pdf...</h5>
                </div>
                <div class="modal-body mx-auto d-block">
                    <div class="d-flex justify-content-center">
                        <div style="width: 3rem; height: 3rem;" class="spinner-border"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    let btn = document.getElementById('viewInfoBtn');
    let selectReference = document.getElementById('selectField');
    let userField = document.getElementById('userAcc');

    const body = document.querySelector(".c26");

    $('#pdfDownload').click(() => {
        $('#modalSpin').modal('show');
        $('#myModal').modal('hide');
        setTimeout(function() {
            $('#modalSpin').modal('hide');
            let options = {
                margin: 1,
                filename: 'Cronograma.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };
            html2pdf().set(options).from(body).save();
        }, 600);
    });

    btn.addEventListener('click', () => {
        rotation(selectReference.value);
    })
</script>

</html>