<?php
include 'conexao.php';

$id = $_GET['id'];
$sql = "DELETE FROM tarefas WHERE id=$id";

if ($conexao->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Erro ao excluir tarefa: " . $conexao->error;
}
?>
