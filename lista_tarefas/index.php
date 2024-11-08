<?php
include 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Adicionar nova tarefa
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome_tarefa'])) {
    $nome_tarefa = $_POST['nome_tarefa'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO tarefas (usuario_id, nome_tarefa, descricao) VALUES ('$usuario_id', '$nome_tarefa', '$descricao')";
    $conexao->query($sql);
}

// Concluir tarefa
if (isset($_GET['concluir'])) {
    $id_tarefa = $_GET['concluir'];
    $sql = "UPDATE tarefas SET status='concluida' WHERE id='$id_tarefa' AND usuario_id='$usuario_id'";
    $conexao->query($sql);
}

// Excluir tarefa
if (isset($_GET['excluir'])) {
    $id_tarefa = $_GET['excluir'];
    $sql = "DELETE FROM tarefas WHERE id='$id_tarefa' AND usuario_id='$usuario_id'";
    $conexao->query($sql);
}

// Buscar todas as tarefas do usuário logado
$resultado = $conexao->query("SELECT * FROM tarefas WHERE usuario_id = '$usuario_id' ORDER BY data_criacao DESC");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Lista de Tarefas de <?php echo $_SESSION['nome_usuario']; ?></h2>
        <a href="logout.php" class="btn btn-danger float-right">Sair</a>
        <a href="consultar.php" class="btn btn-info mb-3">Consultar Tarefas</a>


        <!-- Formulário para adicionar nova tarefa -->
        <form method="POST" action="" class="mb-4">
            <div class="form-group">
                <input type="text" class="form-control" name="nome_tarefa" placeholder="Nome da Tarefa" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="descricao" placeholder="Descrição da Tarefa" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Tarefa</button>
        </form>

        <!-- Lista de tarefas -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tarefa</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($tarefa = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $tarefa['nome_tarefa']; ?></td>
                        <td><?php echo $tarefa['descricao']; ?></td>
                        <td><?php echo ucfirst($tarefa['status']); ?></td>
                        <td>
                            <?php if ($tarefa['status'] == 'pendente') { ?>
                                <a href="?concluir=<?php echo $tarefa['id']; ?>" class="btn btn-success btn-sm">Concluir</a>
                            <?php } ?>
                            <a href="editar.php?id=<?php echo $tarefa['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="?excluir=<?php echo $tarefa['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
