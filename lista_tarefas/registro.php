<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_usuario = $_POST['nome_usuario'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome_usuario, email, senha) VALUES ('$nome_usuario', '$email', '$senha')";

    if ($conexao->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Erro ao registrar usuário: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Registrar</h2>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" class="form-control" name="nome_usuario" placeholder="Nome de Usuário" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="E-mail" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>
</html>
