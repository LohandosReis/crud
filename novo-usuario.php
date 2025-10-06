<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Usuário</title>
    <!-- Link para o CSS externo (se tiver) -->
    <link rel="stylesheet" href="style-novo-usuario.css">
</head>

<body>
    <!-- Formulário para adicionar usuário -->
    <div class="container">
        <h1>Adicionar Novo Usuário</h1>

        <!-- Formulário que envia os dados para criar.php via POST -->
        <form action="criar.php" method="post">

            <!-- Campo para inserir o nome -->
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
            <br>

            <!-- Campo para inserir o email -->
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <br>

            <!-- Campo para inserir a idade (opcional) -->
            <label for="idade">Idade:</label>
            <input type="number" name="idade" id="idade">
            <br>

            <!-- Botão para enviar o formulário -->
            <button type="submit" class="btn">Salvar</button>

            <!-- Link para voltar para a página principal -->
            <a href="index.php" class="btn-voltar">Voltar</a>
        </form>
    </div>

</body>

</html>