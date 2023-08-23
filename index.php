<?php

require __DIR__ . '/connect.php';

session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = array();
}


if (isset($_GET['clear'])) {
    unset($_SESSION['tasks']);
    unset($_GET['clear']);
}

$stmt = $conn->prepare("SELECT * FROM tasks");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com">
    <link href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap">
    <title>Academia Tudo Tech</title>
</head>

<body>
    <header class="cabecalho">
        <img src="img/logo.png" alt="logo" class="logo">
        <h1 class="titulo_principal"> Academia Tudo Tech </h1>

    </header>
    <div class="conteiner">
        <?php
        if (isset($_SESSION['success'])) {

        ?>
            <div class="alert-success"> <?php echo $_SESSION['success'] ?> </div>
        <?php
            unset($_SESSION['success']);
        }
        ?>
          <?php
        if (isset($_SESSION['error'])) {

        ?>
            <div class="alert-error"> <?php echo $_SESSION['error'] ?> </div>
        <?php
            unset($_SESSION['error']);
        }
        ?>

        <div class="header">
            <h2>Gerenciador </h2>
        </div>
        <div class="form">
            <form action="task.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="insert" value="insert">
                <label for="task_name">Exercicio:</label>
                <input type="text" name="task_name" placeholder="Nome do exercicio">
                <label for="task_description">Descrição:</label>
                <input type="text" name="task_description" placeholder="Descrição do exercicio">
                <label for="task_date">Data</label>
                <input type="date" name="task_date">
                <label for="task_image">Imagem:</label>
                <input type="file" name="task_image">
                <button type="submit">Cadastrar</button>
            </form>
            <?php
            if (isset($_SESSION['message'])) {
                echo "<p style='color: #369515';> " . $_SESSION['message'] . "</p>";
                unset($_SESSION['message']);
            }

            ?>
        </div>
        <div class="separator">

        </div>
        <div class="list-tasks">
            <?php
            echo "<ul>";

            foreach ($stmt->fetchAll() as $task) {
                echo "<li>
                             <a href='details.php?key=" . $task['id'] . "'> " . $task['task_name'] . " </a>
                             <button type='button' class='btn-clear' onclick='deletar" . $task['id'] . "()'> Remover </button>
                             <script>
                             function deletar" . $task['id'] . "(){
                                if ( confirm('Confirmar remoção?') ) {
                                    window.location = 'http://localhost/projeto/gerenciador-academia/task.php?key=" . $task['id'] . ";
                                }
                                return false;
                             }


                             </script>
                        
                        </li>";
            }




            echo "</ul>";


            ?>
            <form action="" method="get">
                <input type="hidden" name="clear" value="clear">
                <button type="submit" class="btn-clear">Limpar exercicios</button>
            </form>
        </div>
        <div class="footer">
            <p>Desenvolvido por Milena Fagundes</p>
        </div>
    </div>
</body>

</html>