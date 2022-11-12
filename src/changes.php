<?php
session_start();

$msgError = $_SESSION['in_pass'] ?? null;
$successMsg = $_SESSION['onSuccess'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudar Senha</title>
    <!-- Bootstrap CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- My Custom CSS and JS file -->
    <link href="../styles/manager-style.css" rel="stylesheet">
    <script src="../js/frames.js"></script>
    <script src="../js/my-algorithm-rotation.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>

    <!-- Font Awesome LIB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/fontawesome.min.js" integrity="sha512-j3gF1rYV2kvAKJ0Jo5CdgLgSYS7QYmBVVUjduXdoeBkc4NFV4aSRTi+Rodkiy9ht7ZYEwF+s09S43Z1Y+ujUkA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <div id="superior-bar">
        <ul>
            <li class="list-group-item">
                <i>
                    Olá:
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

    <form class="formPChange text-center" method="POST" action="pass-changer.php">

    <?php
      if($msgError != null) {
        echo "<div style='width: 30%;' class='alert alert-danger mx-auto'>"
              .$msgError . "</div>";
              $_SESSION['in_pass'] = null;
      } elseif ($successMsg != null) {
        echo "<div style='width: 30%;' class='alert alert-success mx-auto'>"
              .$successMsg . "</div>";
              $_SESSION['onSuccess'] = null;
      }
      ?>

        <div class="form-group text-white">
            <label for="atual">
                Sua senha atual: <br>
                <input required class="form-control" type="password" name="atualPass" id="atual" maxlength="17">
            </label><br><br>
            <label for="newPass1">
                Informe sua nova senha: <br>
                <input required class="form-control" type="password" name="newPass1" id="newPass1" maxlength="17">
            </label><br><br>
            <label for="newPass2">
                Confirme sua nova senha: <br>
                <input required class="form-control" type="password" name="newPass2" id="newPass2" maxlength="17">
            </label><br><br>
            <input class="btn btn-primary" type="submit" value="Salvar">
        </div>
    </form>

    <div id="modalSpin" class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Salvando senha...</h4>
                </div>
                <div class="modal-body mx-auto d-block">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;">
                            <span class="visually-hidden"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(".formPChange").submit(() => {
        $(".modal").modal("show");
        setTimeout(function() {
            console.log("...");
        }, 1000);
    });
</script>

</html>