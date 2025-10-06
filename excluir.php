<?php
include 'conexao.php';

// Pega o ID da URL
$id = $_GET['id'];

// Query para deletar o registro
$query = "DELETE FROM usuarios WHERE id=$id";

if (mysqli_query($conexao, $query)) {
    // Redireciona para a página inicial com mensagem de sucesso (opcional)
    header("Location: index.php");
    exit();
} else {
    echo "Erro ao deletar: " . mysqli_error($conexao);
}

mysqli_close($conexao);
?>