<?php
include_once('power-session.php');
date_default_timezone_set("America/Fortaleza");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.M.L - Chamada</title>
    <!-- Bootstrap CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <!-- My Custom CSS and JS file -->
    <link rel="stylesheet" href="../styles/manager-style.css">
    <link rel="stylesheet" href="../styles/responsivo.css">
    <link rel="stylesheet" href="../styles/chamada.css">
    <script src="../js/frames.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>

    <!-- Font Awesome LIB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/fontawesome.min.js" integrity="sha512-j3gF1rYV2kvAKJ0Jo5CdgLgSYS7QYmBVVUjduXdoeBkc4NFV4aSRTi+Rodkiy9ht7ZYEwF+s09S43Z1Y+ujUkA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <div id="superior-bar">
        <ul class="userfield">
            <li class="list-group-item">
                <i class="d-inline-block">
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

    <div class="text-center">
        <i id="iconCheck" class="fas fa-check"></i>
        <h5 class="text-white d-inline text-decoration-underline">Frequência - Chamada</h5>
        <div class="container">
            <div class="row mb-3 mt-2 mx-auto">
                <div class="col-md">
                    <div class="form-floating">
                        <input disabled type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" id="dateField">
                        <label for="floatingInputGrid">Data</label>
                    </div>
                </div>
                <div class="col2 col-md">
                    <div class="form-floating">
                        <select class="form-select text-truncate" id="selectTurma">
                            <optgroup label="1º Séries">
                            <optgroup label="1º Séries">
                                <option value="1º A - Administração">1° A - ADMINISTRAÇÃO</option>
                                <option value="1º B - Edificações">1° B - EDIFICAÇÕES</option>
                                <option value="1º C - Informática">1° C - INFORMÁTICA</option>
                                <option value="1º D - Nutrição">1° D - NUTRIÇÃO</option>
                            </optgroup>
                            <optgroup label="2º Séries">
                                <option value="2º A - Edificações">2° A - EDIFICAÇÕES</option>
                                <option value="2º B - Informática">2° B - INFORMÁTICA</option>
                                <option value="2º C - Logistíca">2° C - LOGÍSTICA</option>
                                <option value="2º D - Nutrição">2° D - NUTRIÇÃO</option>
                            </optgroup>
                            </optgroup>
                        </select>
                        <label for="selectTurma">Selecione a turma</label>
                    </div>
                </div>
            </div>
        </div>
        <button id="btnSearchCurrent" class="btn btn-dark btn-sm">
            <i class="fas fa-search"></i>
            Buscar Alunos
        </button>
    </div>
    <hr>

    <div class="d-flex mx-auto d-block" style="width: 25%;" id="error"></div>

    <div style="visibility: hidden;" class="cardAlunos card w-75 mx-auto d-block">
        <div class="card-body">
            <h4>Lista de alunos (demonstração)</h4>
            <hr>
            <p class="card-text"></p>
            <button class="sendAll btn btn-success mx-auto d-block">
                <i class="fas fa-upload"></i>
                Enviar frequência
            </button>
        </div>
    </div>

    <div id="modalSpin" class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Aguarde...</h5>
                </div>
                <div class="modal-body mx-auto d-block">
                    <div class="d-flex justify-content-center">
                        <div style="width: 3rem; height: 3rem;" class="spinner-border">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="">
        <div id="passConfirm" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Confirme sua senha:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body mx-auto d-block">
                        <div class="d-flex justify-content-center">
                            <input required maxlength="17" class="form-control" data-ng-trim="false" name="pass" type="password" id="passF" placeholder="Insira sua senha">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button class="btn btn-primary">Enviar tudo</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

<script>
    var selectField = document.getElementById('selectTurma');

    $('#btnSearchCurrent').click(() => {
        $('#modalSpin').modal('show');
        setTimeout(function() {
            $('#modalSpin').modal('hide');
            criarRelacao(selectField.value);
        }, 500);
    });

    $('.sendAll').click(() => {
        $('#passConfirm').modal('show');
    });
</script>

</html>