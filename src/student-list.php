<?php
include_once('power-session.php');
require_once('init.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.M.L - Todos os Alunos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- My Custom CSS and JS file -->
    <link href="../styles/manager-style.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/responsivo.css">
    <script src="../js/frames.js"></script>

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

    <form action="student-list.php">
        <div class="selectField text-center">
            <p class="fs-2 text-white text-decoration-underline">Buscar alunos</p>
            <label class="text-white" for="mySelect">
                Selecione a turma:
            </label>
            <select class="mx-auto d-block" name="select" id="mySelect">
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
            </select><br>
            <button name="button" class="btn btn-dark" type="submit">
                Buscar
            </button>
        </div>
    </form>
</body>

</html>

<?php
$turma = $_GET['select'] ?? null;
$manager = $conn->query("SELECT * FROM alunos WHERE turma = '{$turma}' ORDER BY nome ASC");

if (isset($_GET['button']) && $manager->fetch_row() != null) : ?>
    <hr>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>Turma</th>
            </tr>
        </thead>
        <tbody>
            <!--- Adicionar francielly ao banco de dados de Monitores !-->
            <?php while ($row = $manager->fetch_array()) : ?>
                <?php
                $res = $conn->query("SELECT * FROM monitores WHERE matricula = '{$row['matricula']}'");
                if ($res->fetch_row() != null) : ?>
                    <tr>
                        <th> <?php echo $row["matricula"]; ?> </th>
                        <td> <?php echo $row["nome"]; ?> <i class="fas fa-crown"></i> </td>
                        <td> <?php echo $row["turma"]; ?> </td>
                    </tr>
                <?php continue; endif; ?>
                <tr>
                    <th> <?php echo $row["matricula"]; ?> </th>
                    <td> <?php echo $row["nome"]; ?> </td>
                    <td> <?php echo $row["turma"]; ?> </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

<?php endif; $conn->close(); ?>