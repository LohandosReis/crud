<?php
// criar.php (seguro)

// Inclui o arquivo de conexão com o banco de dados
// Assim podemos usar a variável $conexao para acessar o banco
include "conexao.php";

// Verifica se o formulário foi enviado via método POST
// Isso garante que o código só execute quando os dados forem enviados
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Pega o nome enviado pelo formulário e remove espaços no início/fim
    $nome = trim($_POST['nome'] ?? '');

    // Pega o email enviado pelo formulário e remove espaços no início/fim
    $email = trim($_POST['email'] ?? '');

    // Pega a idade enviada. Se estiver vazia, coloca NULL, caso contrário converte para inteiro
    $idade = $_POST['idade'] !== '' ? intval($_POST['idade']) : null;

    // Valida se o nome e email foram preenchidos
    if ($nome === '' || $email === '') {
        echo "Nome e email são obrigatórios."; // Mostra mensagem de erro
        exit; // Para a execução do script
    }

    // Prepara a query SQL para inserir os dados na tabela 'usuarios'
    // Os "?" são marcadores que serão substituídos pelos valores reais depois
    $stmt = mysqli_prepare($conexao, "INSERT INTO usuarios (nome, email, idade) VALUES (?, ?, ?)");

    // Verifica se a preparação da query deu certo
    if (!$stmt) {
        echo "Erro na preparação: " . mysqli_error($conexao); // Mostra o erro
        exit; // Para a execução
    }

    // Associa os valores do formulário aos "?" da query
    // "ssi" significa: string, string, inteiro (tipo dos parâmetros)
    mysqli_stmt_bind_param($stmt, "ssi", $nome, $email, $idade);

    // Executa a query preparada
    $exec = mysqli_stmt_execute($stmt);

    // Se a execução deu certo, fecha a query e redireciona para index.php
    if ($exec) {
        mysqli_stmt_close($stmt);
        header("Location: index.php"); // Redireciona o usuário para a página principal
        exit();
    } else {
        // Se deu erro na execução, mostra a mensagem de erro
        echo "Erro ao inserir: " . mysqli_error($conexao);
    }

    // Fecha a query preparada (libera recursos)
    mysqli_stmt_close($stmt);
}
