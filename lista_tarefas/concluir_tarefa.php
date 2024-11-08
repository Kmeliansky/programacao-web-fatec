<?php
include 'conexao.php';

$id = $_GET['id'];
$sql = "UPDATE tarefas SET status='concluida' WHERE id=$id";

if ($conexao->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Erro ao atualizar tarefa: " . $conexao->error;
}
?>
