<?php
// excluir.php (seguro)

// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

// Verifica se o ID foi passado na URL
// Se não tiver ID, redireciona para a página principal
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// Converte o ID passado na URL para número inteiro
// Isso ajuda a evitar problemas de segurança
$id = intval($_GET['id']);

// Prepara uma query segura para deletar o usuário pelo ID
$stmt = mysqli_prepare($conexao, "DELETE FROM usuarios WHERE id = ?");

// Verifica se a preparação da query deu certo
if (!$stmt) {
    echo "Erro na preparação: " . mysqli_error($conexao); // Mostra erro
    exit;
}

// Associa o valor do ID ao parâmetro da query
// "i" significa que o parâmetro é inteiro
mysqli_stmt_bind_param($stmt, "i", $id);

// Executa a query preparada
$exec = mysqli_stmt_execute($stmt);

// Se a execução deu certo, fecha a query e redireciona para index.php
if ($exec) {
    mysqli_stmt_close($stmt);
    header("Location: index.php"); // Redireciona para a página principal
    exit();
} else {
    // Se deu erro na execução, mostra mensagem de erro
    echo "Erro ao deletar: " . mysqli_error($conexao);
}

// Fecha a query preparada (garante que os recursos sejam liberados)
mysqli_stmt_close($stmt);
