<?php

include "conexao.php";

$nome = "Marcos";
$email = "marcos@email.com";
$idade = 25;

$query = "INSERT INTO usuarios (nome, email, idade) VALUES ('$nome', '$email', '$idade')";

if(mysqli_query($conexao, $query)) {
    header("Location: index.php");
    exit;
} else {
    echo "erro ao inserir!" . mysqli_error($conexao);
}



?>