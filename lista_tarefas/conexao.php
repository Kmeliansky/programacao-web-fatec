<?php
session_start(); 
$servidor = "localhost";
$usuario = "root";  
$senha = "";        
$banco = "lista_tarefas_db";


$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>
