<?php
include 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Verifica se o ID da tarefa foi passado como parâmetro
if (isset($_GET['id'])) {
    $id_tarefa = $_GET['id'];

    // Busca a tarefa a ser editada no banco de dados
    $resultado = $conexao->query("SELECT * FROM tarefas WHERE id = '$id_tarefa' AND usuario_id = '$usuario_id'");
    $tarefa = $resultado->fetch_assoc();

    // Verifica se a tarefa existe e pertence ao usuário logado
    if (!$tarefa) {
        echo "Tarefa não encontrada ou você não tem permissão para editá-la.";
        exit();
    }
}

// Atualiza a tarefa no banco de dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_tarefa = $_POST['nome_tarefa'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE tarefas SET nome_tarefa = '$nome_tarefa', descricao = '$descricao' WHERE id = '$id_tarefa' AND usuario_id = '$usuario_id'";
    $conexao->query($sql);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Editar Tarefa</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Voltar para Lista de Tarefas</a>

        <!-- Formulário de edição de tarefa -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="nome_tarefa">Nome da Tarefa</label>
                <input type="text" class="form-control" id="nome_tarefa" name="nome_tarefa" value="<?php echo $tarefa['nome_tarefa']; ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3"><?php echo $tarefa['descricao']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
