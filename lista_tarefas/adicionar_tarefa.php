<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_tarefa = $_POST['nome_tarefa'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO tarefas (nome_tarefa, descricao) VALUES ('$nome_tarefa', '$descricao')";
    if ($conexao->query($sql) === TRUE) {
        header("Location: index.php");  
    } else {
        echo "Erro ao adicionar tarefa: " . $conexao->error;
    }
}
?>
