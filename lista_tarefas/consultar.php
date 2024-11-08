<?php
include 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Busca todas as tarefas do usuário logado
$sql = "SELECT * FROM tarefas WHERE usuario_id = '$usuario_id'";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Tarefas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Consulta de Tarefas</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Voltar para a Página Principal</a>

        <!-- Tabela de consulta de tarefas -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Tarefa</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Data de Criação</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($tarefa = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $tarefa['id']; ?></td>
                        <td><?php echo $tarefa['nome_tarefa']; ?></td>
                        <td><?php echo $tarefa['descricao']; ?></td>
                        <td><?php echo $tarefa['status']; ?></td>
                        <td><?php echo $tarefa['data_criacao']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
