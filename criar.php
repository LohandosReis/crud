<?php

include "conexao.php";

// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];


    // Insere os dados na tabela usuarios 
    $query = "INSERT INTO usuarios (nome, email, idade) VALUES ('$nome', '$email', '$idade')";

    if (mysqli_query($conexao, $query)) {
        // Redireciona para a página inicial após a inserção
        header("Location: index.php");
        exit();
    } else {
        echo "Erro: " . $query . "<br>" . mysqli_error($conexao);
    }
    mysqli_close($conexao);
}



?>