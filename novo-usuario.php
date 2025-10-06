<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Usuário</title>
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
    <!-- Formulário para adicionar usuário -->
    <div class="container">
        <h1>Adicionar Novo Usuário</h1>
        <form action="criar.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <br>
            <label for="idade">Idade:</label>
            <input type="number" name="idade" id="idade">
            <br>
            <button type="submit" class="btn">Salvar</button>
            <a href="index.php" class="btn-voltar">Voltar</a>
        </form>
    </div>

</body>

</html>