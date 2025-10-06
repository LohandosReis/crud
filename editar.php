<?php
include "conexao.php";

$id = $_GET['id']; // Pega o ID da URL

// Busca os dados atuais do usuario para preencher o formulário
$query = "SELECT * FROM usuarios WHERE id=$id";
$resultado = mysqli_query($conexao, $query);
$usuario = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
        body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 500px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 5px;
        color: #555;
    }

    input[type="text"],
    input[type="email"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .btn {
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #218838;
    }
</style>
<body>

<div class="container">
    <h1>Editar Usuário</h1>
    <form action="atualizar.php?id=<?php echo $id; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome']; ?>" required>
    <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>" required>
<br>
        <label for="idade">Idade:</label>
        <input type="text" name="idade" id="idade" value="<?php echo $usuario['idade']; ?>">
<br>
        <button type="submit" class="btn">Atualizar</button>
         <a href="index.php" class="btn-voltar">Voltar</a>
    </form>
</div>

</body>
</html>