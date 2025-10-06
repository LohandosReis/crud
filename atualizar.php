<?php
// atualizar.php (seguro)

// Inclui o arquivo de conexão com o banco de dados.
// Isso permite usar a variável $conexao para acessar o banco.
include "conexao.php";

// Verifica se o formulário foi enviado via método POST
// Isso garante que o código só execute quando os dados forem enviados.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Pega o ID enviado pelo formulário e garante que seja um número inteiro
    // Se não tiver valor, assume 0
    $id = intval($_POST['id'] ?? 0);

    // Pega o nome enviado, remove espaços no início e no fim
    $nome = trim($_POST['nome'] ?? '');

    // Pega o email enviado, remove espaços no início e no fim
    $email = trim($_POST['email'] ?? '');

    // Pega a idade enviada. Se estiver vazio, coloca NULL, caso contrário converte para inteiro
    $idade = $_POST['idade'] !== '' ? intval($_POST['idade']) : null;

    // Valida se o ID é válido (maior que 0)
    if ($id <= 0) {
        echo "ID inválido."; // Mostra mensagem de erro
        exit; // Para a execução do script
    }

    // Valida se o nome e email foram preenchidos
    if ($nome === '' || $email === '') {
        echo "Nome e email são obrigatórios."; // Mensagem de erro
        exit; // Para a execução
    }

    // Prepara a query SQL para atualizar os dados do usuário
    // Os "?" são parâmetros que serão substituídos depois
    $stmt = mysqli_prepare($conexao, "UPDATE usuarios SET nome = ?, email = ?, idade = ? WHERE id = ?");

    // Verifica se a preparação da query deu certo
    if (!$stmt) {
        echo "Erro na preparação: " . mysqli_error($conexao); // Mostra o erro
        exit; // Para a execução
    }

    // Associa os valores do formulário aos "?" da query
    // "ssii" significa: string, string, inteiro, inteiro (tipo dos parâmetros)
    mysqli_stmt_bind_param($stmt, "ssii", $nome, $email, $idade, $id);

    // Executa a query preparada
    $exec = mysqli_stmt_execute($stmt);

    // Se a execução deu certo, fecha a query e redireciona para index.php
    if ($exec) {
        mysqli_stmt_close($stmt);
        header("Location: index.php"); // Redireciona o usuário
        exit();
    } else {
        // Se deu erro na execução, mostra a mensagem de erro
        echo "Erro ao atualizar: " . mysqli_error($conexao);
    }

    // Fecha a query preparada (garantia de limpeza de recursos)
    mysqli_stmt_close($stmt);
}
