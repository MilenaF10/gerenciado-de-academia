<?php

require __DIR__ . '/connect.php';

session_start();

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
$stmt->bindParam(':id', $_GET['key']);
$stmt->execute();
$data = $stmt->fetchAll();

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
    <div class="details-container">
        <div class="header">
            <h1><?php echo $data[0]['task_name']; ?></h1>
        </div>
        <div class="row">
            <div class="details">
                <dl>
                    <dt>Descrição do Exercicio </dt>
                    <dd><?php echo $data[0]['task_description'] ?></dd>
                    <dt>Data do Exercicio </dt>
                    <dd><?php echo $data[0]['task_date'] ?></dd>
                </dl>
            </div>
            <div class="image">
                <img src="uploads/<?php echo $data[0]['task_image'] ?>" alt="imagem da execução">
            </div>
        </div>
        <div class="footer">
            <p>Desenvolvido por Milena F.</p>
        </div>

    </div>

</body>

</html>