<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    $id_hidden = $_POST['id'];

    $query = "UPDATE usuarios SET nome='$nome', email='$email', idade='$idade' WHERE id=$id_hidden";

    if (mysqli_query($conexao, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conexao);
    }
}


?>