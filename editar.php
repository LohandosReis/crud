<?php
// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

// Pega o ID do usuário passado na URL (ex: editar.php?id=3)
$id = $_GET['id'];

// Cria uma query SQL para buscar os dados do usuário com o ID específico
$query = "SELECT * FROM usuarios WHERE id=$id";

// Executa a query no banco
$resultado = mysqli_query($conexao, $query);

// Converte o resultado em um array associativo (facilita pegar os dados)
$usuario = mysqli_fetch_assoc($resultado);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <!-- Link para o arquivo CSS que vai deixar o formulário estilizado -->
    <link rel="stylesheet" href="style-editar.css">
</head>

<body>

    <div class="container">
        <h1>Editar Usuário</h1>

        <!-- Formulário que envia os dados para atualizar.php via POST -->
        <form action="atualizar.php?id=<?php echo $id; ?>" method="post">
            <!-- Campo oculto para passar o ID do usuário -->
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

            <!-- Campo para editar o nome, já preenchido com o valor atual -->
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome']; ?>" required>
            <br>

            <!-- Campo para editar o email, já preenchido com o valor atual -->
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>" required>
            <br>

            <!-- Campo para editar a idade, já preenchido com o valor atual -->
            <label for="idade">Idade:</label>
            <input type="text" name="idade" id="idade" value="<?php echo $usuario['idade']; ?>">
            <br>

            <!-- Botão para enviar o formulário -->
            <button type="submit" class="btn">Atualizar</button>

            <!-- Link para voltar para a página principal -->
            <a href="index.php" class="btn-voltar">Voltar</a>
        </form>
    </div>

</body>

</html>